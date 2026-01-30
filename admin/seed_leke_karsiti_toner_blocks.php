<?php
require_once 'includes/db.php';

$page_identifier = 'leke-karsiti-aydinlatici-serum';

// Delete existing blocks for this page to avoid duplicates
$stmt = $pdo->prepare("DELETE FROM page_sections WHERE page_identifier = :page_identifier");
$stmt->execute([':page_identifier' => $page_identifier]);

// Insert new block
$sql = "INSERT INTO page_sections (page_identifier, title, subtitle, image_url, button_text, button_url, sort_order, status) VALUES (:page_identifier, :title, :subtitle, :image_url, :button_text, :button_url, :sort_order, 1)";
$stmt = $pdo->prepare($sql);

$blocks = [
    [
        'title' => 'Esans mı, Tonik mi? Aradaki Farkı Öğrenin',
        'subtitle' => 'Esans ve toniklerin nasıl çalıştığını, faydalarını ve hangisinin cilt bakım rutininize en uygun olduğunu öğrenin.',
        'image_url' => 'assets/images/essence-vs-toner-blog-gridbreaker.jpg',
        'button_text' => 'Daha Fazla Oku',
        'button_url' => '/on/demandware.store/Sites-deciem-us-Site/en_US/Page-Show?cid=essence-vs-toner',
        'sort_order' => 1
    ]
];

foreach ($blocks as $block) {
    $stmt->execute([
        ':page_identifier' => $page_identifier,
        ':title' => $block['title'],
        ':subtitle' => $block['subtitle'],
        ':image_url' => $block['image_url'],
        ':button_text' => $block['button_text'],
        ':button_url' => $block['button_url'],
        ':sort_order' => $block['sort_order']
    ]);
}

echo "Leke Karsiti Aydinlatici Serum content seeded successfully.";
?>