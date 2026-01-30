<?php
require_once 'includes/db.php';

$pageIdentifier = 'noc-ciltbakimi';

// Delete existing blocks
$stmt = $pdo->prepare("DELETE FROM page_sections WHERE page_identifier = ?");
$stmt->execute([$pageIdentifier]);

$blocks = [
    [
        'title' => 'Adım 1: Hazırlık',
        'subtitle' => 'Cildi tedavilerin faydalarına hazırlamak ve hazırlamak için kullanılan ürünler.',
        'image_url' => 'https://cdn.media.amplience.net/i/deciem/Shop-by-step-img2?fmt=auto&$poi$&sm=aspect&w=500&aspect=4:3',
        'button_text' => 'Tümünü Gör',
        'button_url' => 'skincare/shop-by-step/prep',
        'sort_order' => 1
    ],
    [
        'title' => 'Adım 2: Tedavi',
        'subtitle' => 'Hedeflenen formüller kullanarak belirli cilt sorunlarına çözüm bulun.',
        'image_url' => 'https://cdn.media.amplience.net/i/deciem/Shop-by-step-img1?fmt=auto&$poi$&sm=aspect&w=500&aspect=4:3',
        'button_text' => 'Tümünü Gör',
        'button_url' => 'skincare/shop-by-step/treat',
        'sort_order' => 2
    ],
    [
        'title' => 'Adım 3: Mühürleme',
        'subtitle' => 'Nem dengesini korumak, bakımlarımızın faydalarını muhafaza etmek ve cildi korumak için ürünler.',
        'image_url' => 'https://cdn.media.amplience.net/i/deciem/Shop-by-step-img3?fmt=auto&$poi$&sm=aspect&w=500&aspect=4:3',
        'button_text' => 'Tümünü Gör',
        'button_url' => 'skincare/shop-by-step/seal',
        'sort_order' => 3
    ],
    [
        'title' => 'Geri dönüş gerçek. Ciltteki sonuç da öyle.',
        'subtitle' => 'Cildinizin en sevdiği fondöteni stoklayın.',
        'image_url' => 'deciem/_vid/ord-serumfoundation-web-homepage-slot5050_desktop/925907d9-f5bd-4071-8124-6420f66664ce/video/d38ed675-f752-4fd6-959a-77f367003823.mp4',
        'button_text' => 'Gölgemi Bul',
        'button_url' => 'serum-foundation-100445',
        'sort_order' => 4
    ],
    [
        'title' => 'Noc markasının içerikleri.',
        'subtitle' => '"İçindekiler" kitabı ürünlerimiz hakkında değil, onların içindekiler hakkında.',
        'image_url' => 'on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw0c092563/theordinary/50-50-images/2025-08-07-CTB-MHM-09-50-50.jpg',
        'button_text' => 'Kitabı Keşfedin',
        'button_url' => 'ingredients-book-100735',
        'sort_order' => 5
    ]
];

$sql = "INSERT INTO page_sections (page_identifier, title, subtitle, image_url, button_text, button_url, status, sort_order, created_at) 
        VALUES (:page_identifier, :title, :subtitle, :image_url, :button_text, :button_url, 1, :sort_order, NOW())";
$stmt = $pdo->prepare($sql);

foreach ($blocks as $block) {
    try {
        $stmt->execute([
            ':page_identifier' => $pageIdentifier,
            ':title' => $block['title'],
            ':subtitle' => $block['subtitle'],
            ':image_url' => $block['image_url'],
            ':button_text' => $block['button_text'],
            ':button_url' => $block['button_url'],
            ':sort_order' => $block['sort_order']
        ]);
        echo "Inserted block: " . $block['title'] . "\n";
    } catch (PDOException $e) {
        echo "Error inserting " . $block['title'] . ": " . $e->getMessage() . "\n";
    }
}

echo "Seeding completed for $pageIdentifier.\n";
?>