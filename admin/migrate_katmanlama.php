<?php
require_once __DIR__ . '/includes/db.php';
require_once dirname(__DIR__) . '/config.php';

// 1. Create or Get Post
$slug = 'katmanlama-kilavuzu';
$stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE slug = ?");
$stmt->execute([$slug]);
$post = $stmt->fetch();

if (!$post) {
    $stmtIns = $pdo->prepare("INSERT INTO blog_posts (title, slug, content, status, created_at) VALUES (?, ?, ?, 1, NOW())");
    $stmtIns->execute(['Katmanlama Kılavuzu', $slug, '']);
    $postId = $pdo->lastInsertId();
    echo "Created post '$slug' (ID: $postId)<br>";
} else {
    $postId = $post['id'];
    echo "Found post '$slug' (ID: $postId)<br>";
}

// 2. Parse HTML Content
$htmlContent = file_get_contents(dirname(__DIR__) . '/blog/katmanlama-kilavuzu.php');

$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML($htmlContent);
libxml_clear_errors();

$xpath = new DOMXPath($dom);

// Helper to update section
function updateSection($pdo, $postId, $key, $value, $type = 'text')
{
    $stmt = $pdo->prepare("INSERT INTO blog_post_sections (post_id, section_key, section_value, section_type) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE section_value = VALUES(section_value), section_type = VALUES(section_type)");
    $stmt->execute([$postId, $key, $value, $type]);
    echo "Updated '$key'<br>";
}

// Extract Header
$headerNode = $xpath->query('//div[contains(@class, "layout1")]//span[contains(@class, "title-text")][1]')->item(0);
$headerTitle = $headerNode ? trim($headerNode->nodeValue) : '';

$subtitleNode = $xpath->query('//div[contains(@class, "layout1")]//span[contains(@class, "title-text")][2]')->item(0);
$headerSubtitle = $subtitleNode ? trim($subtitleNode->nodeValue) : '';

updateSection($pdo, $postId, 'header_title', $headerTitle);
updateSection($pdo, $postId, 'header_subtitle', $headerSubtitle);

// Extract Sections (layout4)
$sectionList = [];
$layout4Divs = $xpath->query('//div[contains(@class, "layout4")]');

echo "Found " . $layout4Divs->length . " layout4 sections.<br>";

foreach ($layout4Divs as $index => $div) {
    // Title
    $titleNode = $xpath->query('.//span[contains(@class, "title-text")]', $div)->item(0);
    $title = $titleNode ? trim($titleNode->nodeValue) : '';

    // Content (Paragraphs)
    $content = '';
    $paragraphs = $xpath->query('.//div[contains(@class, "text-field")]/p', $div);
    foreach ($paragraphs as $p) {
        $content .= "<p>" . trim($p->nodeValue) . "</p>\n";
    }

    // Images
    $img1Node = $xpath->query('.//div[contains(@class, "image-container")]/img', $div)->item(0);
    $img2Node = $xpath->query('.//div[contains(@class, "image-container")]/img', $div)->item(1);

    $img1 = '';
    if ($img1Node) {
        $img1 = $img1Node->getAttribute('data-src') ?: $img1Node->getAttribute('src') ?: '';
    }

    $img2 = '';
    if ($img2Node) {
        $img2 = $img2Node->getAttribute('data-src') ?: $img2Node->getAttribute('src') ?: '';
    }

    if ($title) {
        $sectionList[] = [
            'id' => uniqid('sec_'),
            'title' => $title,
            'content' => $content,
            'image_1' => $img1,
            'image_2' => $img2
        ];
    }
}

// Save Section List as JSON
if (!empty($sectionList)) {
    updateSection($pdo, $postId, 'section_list', json_encode($sectionList, JSON_UNESCAPED_UNICODE), 'json');
}

echo "Migration Complete. Converted to JSON Repeater format.";
?>