<?php
require_once 'includes/db.php';

$pageIdentifier = 'leke-karsiti-aydinlatici-serum';

// Clear existing blocks for this page to avoid duplicates on re-run
$stmt = $pdo->prepare("DELETE FROM page_sections WHERE page_identifier = ?");
$stmt->execute([$pageIdentifier]);

$blocks = [
    [
        'page_identifier' => $pageIdentifier,
        'sort_order' => 1,
        'title' => 'Esans mı, Tonik mi? Aradaki Farkı Öğrenin',
        'subtitle' => 'Esans ve toniklerin nasıl çalıştığını, faydalarını ve hangisinin cilt bakım rutininize en uygun olduğunu öğrenin.',
        'image_url' => 'on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw7ece4d9c/theordinary/gridbreakers/essence-vs-toner-blog-gridbreaker.jpg',
        'button_text' => 'Daha Fazla Oku',
        'button_url' => '/on/demandware.store/Sites-deciem-us-Site/en_US/Page-Show?cid=essence-vs-toner',
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

echo "Leke Karsiti Serum blocks seeded successfully.";
?>