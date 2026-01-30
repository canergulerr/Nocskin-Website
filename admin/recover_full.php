<?php
require_once __DIR__ . '/includes/db.php';
require_once dirname(__DIR__) . '/config.php';

$originalFile = dirname(__DIR__) . '/blog/original-katmanlama-kilavuzu.php';

if (!file_exists($originalFile)) {
    die("Error: $originalFile not found.");
}

// 1. Parse HTML Content
$htmlContent = file_get_contents($originalFile);

$dom = new DOMDocument();
libxml_use_internal_errors(true);
// Use a hack to handle UTF-8 correctly with loadHTML
$dom->loadHTML('<?xml encoding="utf-8" ?>' . $htmlContent);
libxml_clear_errors();

$xpath = new DOMXPath($dom);

$postId = 3; // Katmanlama Kılavuzu ID

// Helper to update individual sections (optional, but good for backup) and section_list
function updateSection($pdo, $postId, $key, $value, $type = 'text')
{
    $stmt = $pdo->prepare("INSERT INTO blog_post_sections (post_id, section_key, section_value, section_type) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE section_value = VALUES(section_value), section_type = VALUES(section_type)");
    $stmt->execute([$postId, $key, $value, $type]);
}

// Extract Header
$headerNode = $xpath->query('//div[contains(@class, "layout1")]//span[contains(@class, "title-text")][1]')->item(0);
$headerTitle = $headerNode ? trim($headerNode->nodeValue) : '';

$subtitleNode = $xpath->query('//div[contains(@class, "layout1")]//span[contains(@class, "title-text")][2]')->item(0);
$headerSubtitle = $subtitleNode ? trim($subtitleNode->nodeValue) : '';

updateSection($pdo, $postId, 'header_title', $headerTitle);
updateSection($pdo, $postId, 'header_subtitle', $headerSubtitle);
echo "Updated Header: $headerTitle / $headerSubtitle<br>";

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
    // Select p tags inside text-block or text-field
    $paragraphs = $xpath->query('.//div[contains(@class, "text-block")]/p | .//div[contains(@class, "text-field")]/p', $div);
    foreach ($paragraphs as $p) {
        // Get inner HTML of p tag
        $innerHtml = '';
        foreach ($p->childNodes as $child) {
            $innerHtml .= $p->ownerDocument->saveHTML($child);
        }
        $content .= "<p>" . trim($innerHtml) . "</p>\n";
    }

    // Images
    // image-block-1 (Image 1 - usually desktop left)
    $img1Node = $xpath->query('.//div[contains(@class, "image-block-1")]//img', $div)->item(0);
    $img1 = '';
    if ($img1Node) {
        $img1 = $img1Node->getAttribute('data-src') ?: $img1Node->getAttribute('src') ?: '';
    }

    // image-block-2 (Image 2 - usually desktop right)
    $img2Node = $xpath->query('.//div[contains(@class, "image-block-2")]//img', $div)->item(0);
    $img2 = '';
    if ($img2Node) {
        $img2 = $img2Node->getAttribute('data-src') ?: $img2Node->getAttribute('src') ?: '';
    }

    // Normalize image URLs if needed (e.g., if they are relative)
    // Assuming they are fine as is from the file.

    if ($title || $content) {
        echo "Found Section: $title<br>";
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
    echo "Updated section_list with " . count($sectionList) . " items.<br>";
}

echo "Full Recovery Complete.";
?>