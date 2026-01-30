<?php
// Fix Banner Images & Text
include dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/admin/includes/db.php';

// Map IDs to specific images based on file listing
$mappings = [
    'skincare-aydinlatici-serum' => ['img' => 'noc-aydinlatici-serum-banner.png', 'title' => 'Aydınlatıcı Serum'],
    'skincare-cilt-canlandirici-tonik' => ['img' => 'noc-cilt-canlandirici-banner.png', 'title' => 'Cilt Canlandırıcı Tonik'],
    'skincare-goz-cevresi-serum' => ['img' => 'noc-goz-cevresi-serum-banner.png', 'title' => 'Göz Çevresi Serumu'],
    'skincare-gozenek-sikilastirici-serum' => ['img' => 'noc-gozenek-banner.png', 'title' => 'Gözenek Sıkılaştırıcı'],
    'skincare-leke-karsiti-aydinlatici-serum' => ['img' => 'leke-bakim-banner.png', 'title' => 'Leke Karşıtı Aydınlatıcı'],
    'skincare-leke-karsiti-serum' => ['img' => 'noc-leke-karsiti-banner.png', 'title' => 'Leke Karşıtı Serum'],
    'skincare-moisturizers' => ['img' => 'nemlendirici-banner.png', 'title' => 'Nemlendiriciler'],
    'skincare-sebum-dengeleyici-serum' => ['img' => 'noc-sebum-dengeleyici-banner.png', 'title' => 'Sebum Dengeleyici'],
    'skincare-yaslanma-karsiti-serum' => ['img' => 'noc-yaslanma-karsiti-banner.png', 'title' => 'Yaşlanma Karşıtı Serum'],
    'skincare-yuz-temizleme-kopugu' => ['img' => 'noc-yuz-temizleme-kopugu-banner.png', 'title' => 'Yüz Temizleme Köpüğü'],
    'best-sellers' => ['img' => 'banner_best-sellers_desktop_1766579798.png', 'mobile' => 'banner_best-sellers_mobile_1766579804.png', 'title' => 'Çok Satanlar'],
    'new' => ['img' => 'noc-new-banner.png', 'title' => 'Yeni Ürünler'],
    'ciltbakim-gozenek-sikilastirma' => ['img' => 'tikaniklik-banner.png', 'title' => 'Gözenek ve Tıkanıklık'],
    'ciltbakim-yaslanma-karsiti' => ['img' => 'noc-yaslanma-banner.png', 'title' => 'Yaşlanma Karşıtı'],
    'ciltbakim-leke-karsiti-cilt-tonu-esitleme' => ['img' => 'noc-leke-banner.png', 'title' => 'Leke Karşıtı Bakım'],
    'ciltbakim-nemlendirme-bariyer-guclendirme' => ['img' => 'doku-banner.png', 'title' => 'Nemlendirme ve Bariyer'],
    'ciltbakim-goz-cevresi-bakimi' => ['img' => 'goz-bakim-banner.png', 'title' => 'Göz Çevresi Bakımı'],
    'ciltbakim-sebum-dengeleme' => ['img' => 'noc-sebum-banner.png', 'title' => 'Sebum Dengeleme'],
    'ciltbakim-hassasiyet-kizariklik' => ['img' => 'doku-banner.png', 'title' => 'Hassasiyet ve Kızarıklık'], // Fallback or guess
    'ciltbakim-kirisiklik-ince-cizgi' => ['img' => 'noc-kirisiklik-banner.png', 'title' => 'Kırışıklık ve İnce Çizgiler']
];

foreach ($mappings as $id => $data) {
    if (!isset($data['img']))
        continue;

    $img_desktop = 'assets/images/' . $data['img'];
    $img_mobile = isset($data['mobile']) ? 'assets/images/' . $data['mobile'] : $img_desktop;
    $title = $data['title'];

    try {
        $stmt = $pdo->prepare("UPDATE banners SET image_desktop = ?, image_mobile = ?, title = ? WHERE page_identifier = ?");
        $stmt->execute([$img_desktop, $img_mobile, $title, $id]);

        if ($stmt->rowCount() > 0) {
            echo "Updated: $id\n <br>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage() . "\n <br>";
    }
}
echo "Fix Complete.";
?>