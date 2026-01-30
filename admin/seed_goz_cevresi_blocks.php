<?php
require_once 'includes/db.php';

$pageIdentifier = 'goz-cevresi-bakimi';

// Clear existing blocks for this page to avoid duplicates on re-run
$stmt = $pdo->prepare("DELETE FROM page_sections WHERE page_identifier = ?");
$stmt->execute([$pageIdentifier]);

$blocks = [
    [
        'page_identifier' => $pageIdentifier,
        'sort_order' => 1,
        'title' => 'Cilt dokusunu pürüzsüzleştirir.',
        'subtitle' => 'Yüzeyel peeling etkisi. Cilt dokusunu pürüzsüzleştirir ve cilt tonunu gözle görülür şekilde eşitler.',
        'image_url' => 'on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dwe87e9970/theordinary/gridbreakers/2025-03-21-Always-On-Grid-Breakers-Glyc-Acid.jpg',
        'button_text' => 'Glikolik Asit Satın Al',
        'button_url' => '/glycolic-acid-7-exfoliating-toner-100418?pid=100418',
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

echo "Goz Cevresi Bakimi blocks seeded successfully.";
?>