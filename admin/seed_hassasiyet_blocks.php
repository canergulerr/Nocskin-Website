<?php
require_once 'includes/db.php';

$pageIdentifier = 'hassasiyet-kizariklik';

// Clear existing blocks for this page to avoid duplicates on re-run
$stmt = $pdo->prepare("DELETE FROM page_sections WHERE page_identifier = ?");
$stmt->execute([$pageIdentifier]);

$blocks = [
    [
        'page_identifier' => $pageIdentifier,
        'sort_order' => 1,
        'title' => 'Neden Göz Serumuna İhtiyacınız Var?',
        'subtitle' => 'Göz çevrenizde kaz ayakları, koyu halkalar veya şişkinlik varsa, hangi göz serumlarının bu sorunları hedef alarak daha aydınlık ve daha az şişkin bir göz çevresi için yardımcı olduğunu öğrenin.',
        'image_url' => 'assets/images/noc-goz-bakim-yatay-1.png',
        'button_text' => 'Göz Serumları Hakkında Bilgi Edinin',
        'button_url' => '/on/demandware.store/Sites-deciem-us-Site/en_US/Page-Show?cid=the-ordinary-eye-serums',
        'status' => 1
    ],
    [
        'page_identifier' => $pageIdentifier,
        'sort_order' => 2,
        'title' => 'Daha Sağlıklı Görünümlü Kirpikler ve Kaşlar İçin.',
        'subtitle' => 'Kirpik ve kaşların görünümünü besleyen ve geliştiren peptitler.',
        'image_url' => 'assets/images/noc-goz-bakim-yatay-2.png',
        'button_text' => 'Kirpik Serumları Satın Alın',
        'button_url' => '/multi-peptide-lash-brow-serum-100111?pid=100111',
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

echo "Hassasiyet Kizariklik blocks seeded successfully.";
?>