<?php
// Assuming run from root: php admin/seed_categories_v2.php
require_once 'admin/includes/db.php';
require_once 'config.php';

$categories = [
    "En çok satanlar",
    "Yeni çıkanlar",
    "Yaşlanma Karşıtı & Sıkılaştırma",
    "Kırışıklık & İnce Çizgi Bakımı",
    "Leke Karşıtı & Cilt Tonu Eşitleme",
    "Gözenek Sıkılaştırma & Cilt Dokusu",
    "Sebum Dengeleme & Akne Eğilimli Ciltler",
    "Hassasiyet & Kızarıklık Karşıtı Bakım",
    "Nemlendirme & Bariyer Güçlendirme",
    "Göz Çevresi Bakımı",
    "Anında Pürüzsüzlük & Canlı Görünüm",
    "Yorgun & Mat Ciltler İçin Bakım",
    "Gözenek Sıkılaştırıcı Serum",
    "Göz Çevresi Serum",
    "Leke Karşıtı & Aydınlatıcı & Gözenek Sıkılaştırıcı Serum",
    "Yaşlanma Karşıtı Serum",
    "Leke Karşıtı Serum",
    "Aydınlatıcı Serum",
    "Sebum Dengeleyici Serum",
    "Hassas Ciltler İçin Yüz Temizleme Köpüğü",
    "Cilt Canlandırıcı Tonik",
    "Peptit & Amino Asit Bazlı Aktifler",
    "Bitkisel & Biyoteknolojik Ekstraktlar",
    "Aydınlatıcı & Ton Eşitleyici Aktifler",
    "Nem & Bariyer Destekleyiciler",
    "Sebum & Mikrobiyom Destekleyiciler",
    "Anında Etki Sağlayan Aktifler",
    "Setler & Koleksiyonlar"
];

function slugify($text)
{
    // Basic slugify function for Turkish support
    $text = mb_strtolower($text, 'UTF-8');
    $text = str_replace(
        ['ı', 'ğ', 'ü', 'ş', 'ö', 'ç'],
        ['i', 'g', 'u', 's', 'o', 'c'],
        $text
    );
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

echo "Seeding Categories...\n";

// Optional: Clear existing categories
// $pdo->exec("TRUNCATE TABLE categories"); // Use with caution

foreach ($categories as $catName) {
    $slug = slugify($catName);

    // Check if exists
    $stmt = $pdo->prepare("SELECT id FROM categories WHERE slug = ?");
    $stmt->execute([$slug]);
    if ($stmt->fetch()) {
        echo "Skipping existing: $catName ($slug)\n";
        continue;
    }

    $stmtInsert = $pdo->prepare("INSERT INTO categories (name, slug, description, status) VALUES (?, ?, '', 1)");
    try {
        $stmtInsert->execute([$catName, $slug]);
        echo "Inserted: $catName ($slug)\n";
    } catch (PDOException $e) {
        echo "Error inserting $catName: " . $e->getMessage() . "\n";
    }
}
echo "Done.\n";
?>