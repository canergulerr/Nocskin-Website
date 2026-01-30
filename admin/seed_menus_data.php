<?php include dirname(__DIR__) . '/config.php'; ?>
<?php
require_once 'includes/db.php';

try {
    // Clear existing menus
    $pdo->exec("TRUNCATE TABLE menus");

    // Helper function to insert menu
    function insertMenu($pdo, $title, $url, $parentId = NULL, $position = 0, $status = 1)
    {
        $stmt = $pdo->prepare("INSERT INTO menus (parent_id, title, url, position, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$parentId, $title, $url, $position, $status]);
        return $pdo->lastInsertId();
    }

    // 1. En Çok Satanlar
    insertMenu($pdo, 'En Çok Satanlar', '/en-us/category/best-sellers', NULL, 1);

    // 2. Yeni ve Öne Çıkanlar
    $p2 = insertMenu($pdo, 'Yeni ve Öne Çıkanlar', '/en-us/category/newfeatured', NULL, 2);
    insertMenu($pdo, 'Yeni Çıkanlar', '/en-us/category/new', $p2, 1);
    insertMenu($pdo, 'En Çok Satanlar', '/en-us/category/best-sellers', $p2, 2);
    insertMenu($pdo, 'Sevgi Dolu Veda', '/en-us/category/fond-farewell', $p2, 3);
    insertMenu($pdo, 'Tüm Ürünler', '/en-us/category/newfeatured#product-search-results', $p2, 4);

    // Gifts Submenu under Start
    $p2_gifts = insertMenu($pdo, 'Hediyeler', '#', $p2, 5); // Nested sub-category
    insertMenu($pdo, 'Hediye Setleri', '/en-us/category/gifts/gift-sets', $p2_gifts, 1);

    // 3. Cilt Bakımı
    $p3 = insertMenu($pdo, 'Cilt Bakımı', '/en-us/category/noc-skincare', NULL, 3);

    // Shop by Concern
    $p3_concern = insertMenu($pdo, 'İhtiyacına Göre Alışveriş Yapın', '#', $p3, 1);
    insertMenu($pdo, 'Yaşlanma Karşıtı & Sıkılaştırma', '/ciltbakim/yaslanma-karsiti', $p3_concern, 1);
    insertMenu($pdo, 'Kırışıklık & İnce Çizgi Bakımı', '/ciltbakim/kirisiklik-ince-cizgi', $p3_concern, 2);
    insertMenu($pdo, 'Leke Karşıtı & Cilt Tonu Eşitleme', '/ciltbakim/leke-karsiti-cilt-tonu-esitleme', $p3_concern, 3);
    insertMenu($pdo, 'Gözenek Sıkılaştırma & Cilt Dokusu', '/ciltbakim/gozenek-sikilastirma', $p3_concern, 4);
    insertMenu($pdo, 'Sebum Dengeleme & Akne Eğilimli Ciltler', '/ciltbakim/sebum-dengeleme', $p3_concern, 5);
    insertMenu($pdo, 'Hassasiyet & Kızarıklık Karşıtı Bakım', '/ciltbakim/hassasiyet-kizariklik', $p3_concern, 6);
    insertMenu($pdo, 'Nemlendirme & Bariyer Güçlendirme', '/ciltbakim/nemlendirme-bariyer-guclendirme', $p3_concern, 7);
    insertMenu($pdo, 'Göz Çevresi Bakımı', '/ciltbakim/goz-cevresi-bakimi', $p3_concern, 8);
    insertMenu($pdo, 'Anında Pürüzsüzlük & Canlı Görünüm', '/ciltbakim/aninda-puruzsuzluk', $p3_concern, 9);
    insertMenu($pdo, 'Yorgun & Mat Ciltler İçin Bakım', '/ciltbakim/yorgun-mat-ciltler', $p3_concern, 10);

    // Shop by Step
    $p3_step = insertMenu($pdo, 'Ürünlere Göre Alışveriş Yapın', '#', $p3, 2);
    insertMenu($pdo, 'Gözenek Sıkılaştırıcı Serum', '/en-us/category/skincare/gozenek-sikilastirici-serum', $p3_step, 1);
    insertMenu($pdo, 'Göz Çevresi Serum', '/en-us/category/skincare/goz-cevresi-serum', $p3_step, 2);
    insertMenu($pdo, 'Leke Karşıtı & Aydınlatıcı & Gözenek Sıkılaştırıcı Serum', '/en-us/category/skincare/leke-karsiti-aydinlatici-serum', $p3_step, 3);
    insertMenu($pdo, 'Yaşlanma Karşıtı Serum', '/en-us/category/skincare/yaslanma-karsiti-serum', $p3_step, 4);
    insertMenu($pdo, 'Leke Karşıtı Serum', '/en-us/category/skincare/leke-karsiti-serum', $p3_step, 5);
    insertMenu($pdo, 'Aydınlatıcı Serum', '/en-us/category/skincare/aydinlatici-serum', $p3_step, 6);
    insertMenu($pdo, 'Sebum Dengeleyici Serum', '/en-us/category/skincare/sebum-dengeleyici-serum', $p3_step, 7);
    insertMenu($pdo, 'Hassas Ciltler İçin Yüz Temizleme Köpüğü', '/en-us/category/skincare/yuz-temizleme-kopugu', $p3_step, 8);
    insertMenu($pdo, 'Cilt Canlandırıcı Tonik', '/en-us/category/skincare/cilt-canlandirici-tonik', $p3_step, 9);


    // Shop by Ingredients
    $p3_ing = insertMenu($pdo, 'Malzemelere Göre Alışveriş Yapın', '#', $p3, 3);
    insertMenu($pdo, 'Peptit & Amino Asit Bazlı Aktifler', '/ciltbakim/peptitler', $p3_ing, 1);
    insertMenu($pdo, 'Bitkisel & Biyoteknolojik Ekstraktlar', '/ciltbakim/bitkisel', $p3_ing, 2);
    insertMenu($pdo, 'Aydınlatıcı & Ton Eşitleyici Aktifler', '/ciltbakim/aydinlatici-ton-esitleyici', $p3_ing, 3);
    insertMenu($pdo, 'Nem & Bariyer Destekleyiciler', '/ciltbakim/nem-bariyer', $p3_ing, 4);
    insertMenu($pdo, 'Sebum & Mikrobiyom Destekleyiciler', '/ciltbakim/sebum-mikrobiyom', $p3_ing, 5);
    insertMenu($pdo, 'Anında Etki Sağlayan Aktifler', '/ciltbakim/aninda-etki', $p3_ing, 6);

    // 4. Vücut + Saç
    $p4 = insertMenu($pdo, 'Vücut + Saç', '/en-us/category/noc-body-hair', NULL, 4);
    insertMenu($pdo, 'Vücut Bakımı', '/en-us/category/body-hair/body-care', $p4, 1);
    insertMenu($pdo, 'Saç ve Saç Derisi Çözümleri', '/en-us/category/body-hair/hair-scalp-solutions', $p4, 2);
    insertMenu($pdo, 'Kirpik ve Kaş Bakımları', '/en-us/category/body-hair/lash-brow-treatment', $p4, 3);
    insertMenu($pdo, 'Dudak Bakımı', '/en-us/category/body-hair/lip-care', $p4, 4);

    // 5. Setler & Koleksiyonlar
    insertMenu($pdo, 'Setler & Koleksiyonlar', '/en-us/category/skincare/skincare-sets', NULL, 5);

    // 6. Noc Kütüphanesi
    $p6 = insertMenu($pdo, 'Noc Kütüphanesi', '/en-us/noc-blog', NULL, 6);
    insertMenu($pdo, 'Rejim Rehberi', '/en-us/blog/mastering-skincare-routine-guide', $p6, 1);
    insertMenu($pdo, 'Malzeme Sözlüğü', '/en-us/ingredient-glossary', $p6, 2);
    insertMenu($pdo, 'Katmanlama Kılavuzu', '/en-us/blog/skincare-layering-guide', $p6, 3);

    // 7. Periyodik Tablo
    insertMenu($pdo, 'Periyodik Tablo', '/en-us/the-periodic-fable', NULL, 7);

    // 8. Rejim Programımı Oluştur (Blue Button style usually handled by class in frontend, but we'll just add as link)
    insertMenu($pdo, 'Rejim Programımı Oluştur', '/en-us/regimen-builder', NULL, 8);

    echo "Default menus seeded successfully.";

} catch (PDOException $e) {
    echo "Error seeding menus: " . $e->getMessage();
}
?>
