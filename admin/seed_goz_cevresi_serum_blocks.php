<?php
require_once 'includes/db.php';

$pageIdentifier = 'goz-cevresi-serum';

// Clear existing blocks for this page to avoid duplicates on re-run
$stmt = $pdo->prepare("DELETE FROM page_sections WHERE page_identifier = ?");
$stmt->execute([$pageIdentifier]);

$blocks = [
    [
        'page_identifier' => $pageIdentifier,
        'sort_order' => 1,
        'title' => 'Temizlik Ürünleri 101: Size Uygun Ürünü Bulun',
        'subtitle' => 'Temizleyicilerin nasıl çalıştığını, neden önemli olduklarını ve cildiniz için en uygun olanı nasıl seçeceğinizi öğrenin.',
        'image_url' => 'assets/images/noc-goz-cevresi-serum-sag-banner.png',
        'button_text' => 'Temizlik Ürünleri Hakkında Bilgi Edinin',
        'button_url' => '/on/demandware.store/Sites-deciem-us-Site/en_US/Page-Show?cid=what-is-a-cleanser',
        'status' => 1
    ]
];

$insertStmt = $pdo->prepare("INSERT INTO page_sections (page_identifier, sort_order, title, subtitle, image_url, button_text, button_url, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

foreach ($blocks as $block) {
    $insertStmt->execute([
        $block['page_identifier'],
        $block['sort_order'],
        $block['title'],
        $block['subtitle'],
        $block['image_url'],
        $block['button_text'],
        $block['button_url'],
        $block['status']
    ]);
}

echo "Goz Cevresi Serum blocks seeded successfully.";
?>