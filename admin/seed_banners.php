<?php
require_once 'includes/db.php';

$banners = [
    [
        'page_identifier' => 'skincare',
        'image_desktop' => 'assets/images/noc-skin-banner3.png',
        'image_mobile' => 'assets/images/noc-new-banner3.png',
        'title' => 'Formülasyonunuzu Bulun',
        'description' => 'Tüm ürünlerimiz, cildinizin doğal durumunu iyileştirmek ve belirli sorunları hedeflemek amacıyla özel olarak formüle edilmiştir.',
        'button_text' => 'Kendi Tedavi Programınızı Oluşturun',
        'button_url' => '../regimen-builder',
        'shop_link_text' => 'Tüm Cilt Bakım Ürünlerini İncele',
        'shop_link_url' => 'skincare/skincare-products'
    ],
    [
        'page_identifier' => 'body-hair',
        'image_desktop' => 'assets/images/noc-skin-banner4.png',
        'image_mobile' => 'assets/images/noc-skin-banner4.png',
        'title' => 'Vücut ve Saç İçin Formüle Edilmiştir',
        'description' => 'Hem saç hem de vücut için günlük sorunlara yönelik formüle edilmiş ürünleri keşfedin.',
        'button_text' => '',
        'button_url' => '',
        'shop_link_text' => 'Şimdi Alışveriş Yapın',
        'shop_link_url' => 'https://theordinary.com/en-us/category/body-hair/all-body-hair'
    ]
];

try {
    $stmt = $pdo->prepare("INSERT INTO banners (
        page_identifier, image_desktop, image_mobile, title, description, 
        button_text, button_url, shop_link_text, shop_link_url
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    foreach ($banners as $banner) {
        $stmt->execute([
            $banner['page_identifier'],
            $banner['image_desktop'],
            $banner['image_mobile'],
            $banner['title'],
            $banner['description'],
            $banner['button_text'],
            $banner['button_url'],
            $banner['shop_link_text'],
            $banner['shop_link_url']
        ]);
    }
    echo "Banners seeded successfully.";
} catch (PDOException $e) {
    echo "Error seeding banners: " . $e->getMessage();
}
?>