<?php
require_once __DIR__ . '/includes/db.php';

$postId = 3;

// 1. Fetch all existing individual keys
$stmt = $pdo->prepare("SELECT section_key, section_value FROM blog_post_sections WHERE post_id = ?");
$stmt->execute([$postId]);
$allData = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

// 2. Build the correct JSON list
$sectionList = [];

for ($i = 1; $i <= 6; $i++) {
    $titleKey = "section_{$i}_title";
    $contentKey = "section_{$i}_content";
    $img1Key = "section_{$i}_image_1";
    $img2Key = "section_{$i}_image_2";

    $title = $allData[$titleKey] ?? '';
    $content = $allData[$contentKey] ?? '';
    $img1 = $allData[$img1Key] ?? '';
    $img2 = $allData[$img2Key] ?? '';

    // Filter out PHP tag garbage
    if (strpos($title, '<?=') !== false || strpos($title, '<?php') !== false)
        $title = '';
    if (strpos($content, '<?=') !== false || strpos($content, '<?php') !== false)
        $content = '';
    if (strpos($img1, '<?=') !== false || strpos($img1, '<?php') !== false)
        $img1 = '';
    if (strpos($img2, '<?=') !== false || strpos($img2, '<?php') !== false)
        $img2 = '';

    // If completely empty, we can still add it as a placeholder to maintain 6 sections
    // Or we can add it empty.
    $sectionList[] = [
        'id' => uniqid('sec_'),
        'title' => $title,
        'content' => $content,
        'image_1' => $img1,
        'image_2' => $img2
    ];
}

// 3. Save detailed info about what was recovered
echo "<pre>";
print_r($sectionList);
echo "</pre>";

$json = json_encode($sectionList, JSON_UNESCAPED_UNICODE);
$stmtUpdate = $pdo->prepare("INSERT INTO blog_post_sections (post_id, section_key, section_value, section_type) VALUES (?, 'section_list', ?, 'json') ON DUPLICATE KEY UPDATE section_value = VALUES(section_value)");
$stmtUpdate->execute([$postId, $json]);

echo "Recovered usable data into section_list.";
?>