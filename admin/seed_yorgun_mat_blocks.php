<?php
require_once 'includes/db.php';

$pageIdentifier = 'yorgun-mat-ciltler';

// Clear existing blocks for this page to avoid duplicates on re-run
$stmt = $pdo->prepare("DELETE FROM page_sections WHERE page_identifier = ?");
$stmt->execute([$pageIdentifier]);

$blocks = [
    [
        'page_identifier' => $pageIdentifier,
        'sort_order' => 1,
        'title' => 'Cilt Bariyeri Eğitimi 101',
        'subtitle' => 'Cilt bariyerinin nasıl çalıştığını merak ediyor musunuz? Sağlıklı bir cilt bariyerini korumak için bilmeniz gereken her şeyi öğrenin.',
        'image_url' => 'on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw990e12ef/theordinary/gridbreakers/sbss-blog1-grid-breaker.jpg',
        'button_text' => 'Hassas Cilt Rehberi',
        'button_url' => '/on/demandware.store/Sites-deciem-us-Site/en_US/Page-Show?cid=how-to-soothe-sensitive-skin',
        'status' => 1
    ],
    [
        'page_identifier' => $pageIdentifier,
        'sort_order' => 2,
        'title' => 'Gelişmiş Nemlendirme.',
        'subtitle' => 'Ciltte bulunan lipitlerden ilham alan içeriklerle nemlendirmeyi destekleyin.',
        'image_url' => 'on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw5ffd416e/theordinary/gridbreakers/2025-03-21-Always-On-Grid-Breakers-NMF HA.jpg',
        'button_text' => 'NMF + HA Ürünlerini Satın Alın',
        'button_url' => '/natural-moisturizing-factors-ha-moisturizer-100435?pid=100435',
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

echo "Yorgun Mat Ciltler blocks seeded successfully.";
?>