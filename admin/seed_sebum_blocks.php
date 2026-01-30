<?php
require_once 'includes/db.php';

$pageIdentifier = 'sebum-dengeleme';

// Clear existing blocks for this page to avoid duplicates on re-run
$stmt = $pdo->prepare("DELETE FROM page_sections WHERE page_identifier = ?");
$stmt->execute([$pageIdentifier]);

$blocks = [
    [
        'page_identifier' => $pageIdentifier,
        'sort_order' => 1,
        'title' => 'Kuru & Susuz Cildi Nemlendirin',
        'subtitle' => 'Nemlendirme, sağlıklı bir cilt için kilit bir faktördür. İyi beslenmiş ve nemli bir cilde kavuşmak için, bakım rutininize eklemeniz gereken temel ürünleri belirliyoruz.',
        'image_url' => 'assets/images/noc-kuruluk-yatay-1.png',
        'button_text' => 'Hidrasyon Hakkında Bilgiyi Okuyun',
        'button_url' => '/on/demandware.store/Sites-deciem-us-Site/en_US/Page-Show?cid=the-science-of-hydration',
        'status' => 1
    ],
    [
        'page_identifier' => $pageIdentifier,
        'sort_order' => 2,
        'title' => 'Anında Dolgunlaştırıcı Nemlendirme.',
        'subtitle' => 'Seramidler, 5 çeşit hyaluronik asit ve provitamin B5 ile formüle edilmiştir.',
        'image_url' => 'assets/images/noc-kuruluk-yatay-2.png',
        'button_text' => 'Hyaluronik Asit Satın Alın',
        'button_url' => '/hyaluronic-acid-2-b5-serum-with-ceramides-100637?pid=100637',
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

echo "Sebum Dengeleme blocks seeded successfully.";
?>