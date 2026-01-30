<?php
include 'includes/db.php';

try {
    // Clear existing items to avoid duplicates during dev
    $pdo->exec("TRUNCATE TABLE slider_items");

    $items = [
        [
            'type' => 'video',
            'media_url' => 'assets/video/slider2.mp4',
            'title' => 'Doğal Işıltı,Derin Etki.',
            'subtitle' => 'Cildinizin doğal ışıltısını ortaya çıkaran, derinlemesine etkili besleyici formül. Her kullanımda daha pürüzsüz, daha canlı bir görünüm.',
            'button_text' => 'Işıltıyı Keşfet',
            'button_url' => 'en-us/noc-slowvember-coming-soon',
            'order_index' => 1
        ],
        [
            'type' => 'video',
            'media_url' => 'assets/video/slider.mp4',
            'title' => 'Bilimin Ritmiyle: Ultrasonik Sıkılaştırmada Periyodik Mükemmellik.',
            'subtitle' => 'Cildinizi bilimsel hassasiyetle sıkılaştırın. Ultrasonik teknoloji ile her dokunuşta eşsiz bir etki.',
            'button_text' => 'Bilimle Tanış',
            'button_url' => 'en-us/the-periodic-fable',
            'order_index' => 2
        ],
        [
            'type' => 'image',
            'media_url' => 'assets/images/NOC.png',
            'title' => 'Akıllı Analiz, Kusursuz Cilt.',
            'subtitle' => 'Yapay zeka destekli analiz ile cildinizin ihtiyaçlarını belirleyin ve size özel bakım programınızı keşfedin. Daha sağlıklı, daha ışıltılı bir cilt artık mümkün.',
            'button_text' => 'Akıllı Bakımı Başlat',
            'button_url' => 'en-us/regimen-builder',
            'order_index' => 3
        ]
    ];

    $sql = "INSERT INTO slider_items (type, media_url, title, subtitle, button_text, button_url, order_index, status) VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
    $stmt = $pdo->prepare($sql);

    foreach ($items as $item) {
        $stmt->execute([
            $item['type'],
            $item['media_url'],
            $item['title'],
            $item['subtitle'],
            $item['button_text'],
            $item['button_url'],
            $item['order_index']
        ]);
        echo "Inserted: " . $item['title'] . "<br>";
    }

    echo "Slider data seeded successfully.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>