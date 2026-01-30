<?php
require_once __DIR__ . '/includes/db.php';
require_once dirname(__DIR__) . '/config.php';

$postId = 3;
$htmlFile = dirname(__DIR__) . '/blog/original-katmanlama-kilavuzu.php';

if (!file_exists($htmlFile)) {
    die("Original file not found.");
}

$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTMLFile($htmlFile, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
libxml_clear_errors();

$xpath = new DOMXPath($dom);

// Helper to save section
function saveSection($pdo, $postId, $key, $value, $type = 'text')
{
    if ($value === null)
        $value = '';
    $stmt = $pdo->prepare("INSERT INTO blog_post_sections (post_id, section_key, section_value, section_type) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE section_value = VALUES(section_value), section_type = VALUES(section_type)");
    $stmt->execute([$postId, $key, $value, $type]);
}

// 1. Recover Header Image (Icon) from Layout 1
$headerImageNode = $xpath->query('//div[contains(@class, "layout1")]//div[contains(@class, "copy-block")]//img')->item(0);
$headerImage = $headerImageNode ? $headerImageNode->getAttribute('src') : '';
saveSection($pdo, $postId, 'header_image', $headerImage, 'image');

echo "Diff: Header Image: $headerImage<br>";

// 2. Recover Layout 4 Sections (1 to 6)
$layout4Divs = $xpath->query('//div[contains(@class, "ampliance_layout") and contains(@class, "layout4")]');

echo "Found " . $layout4Divs->length . " layout4 sections.<br>";

$i = 0;
foreach ($layout4Divs as $div) {
    $i++;
    // Title
    $titleNode = $xpath->query('.//h1[contains(@class, "title-block")]//span[contains(@class, "title-text")]', $div)->item(0);
    $title = $titleNode ? trim($titleNode->textContent) : '';

    // Content
    $contentNode = $xpath->query('.//div[contains(@class, "text-block")]', $div)->item(0);
    $content = '';
    if ($contentNode) {
        // Save inner HTML of content node
        $children = $contentNode->childNodes;
        foreach ($children as $child) {
            $content .= $div->ownerDocument->saveHTML($child);
        }
    }
    $content = trim($content);

    // Image 1 (Left/Top)
    $img1Node = $xpath->query('.//div[contains(@class, "image-block-1")]//img', $div)->item(0);
    $image1 = $img1Node ? $img1Node->getAttribute('src') : '';
    // Fix lazy loading src if needed (usually data-src or src)
    if (!$image1 && $img1Node)
        $image1 = $img1Node->getAttribute('data-src');

    // Image 2 (Right/Bottom)
    $img2Node = $xpath->query('.//div[contains(@class, "image-block-2")]//img', $div)->item(0);
    $image2 = $img2Node ? $img2Node->getAttribute('src') : '';
    if (!$image2 && $img2Node)
        $image2 = $img2Node->getAttribute('data-src');

    echo "Section $i: $title<br>";

    // Save to Granular Keys
    saveSection($pdo, $postId, "section_{$i}_title", $title, 'text');
    saveSection($pdo, $postId, "section_{$i}_content", $content, 'textarea');
    saveSection($pdo, $postId, "section_{$i}_image_1", $image1, 'image');
    saveSection($pdo, $postId, "section_{$i}_image_2", $image2, 'image');
}

echo "Granular Recovery Complete.";
?>