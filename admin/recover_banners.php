<?php
// Banner Recovery Script
include dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/admin/includes/db.php';

$base_dir = dirname(__DIR__); // c:\xampp\htdocs\noc_new

function getDirContents($dir, &$results = array())
{
    $files = scandir($dir);
    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            if (pathinfo($path, PATHINFO_EXTENSION) === 'php') {
                $results[] = $path;
            }
        } else if ($value != "." && $value != ".." && $value !== 'admin' && $value !== 'includes' && $value !== '.git' && $value !== '.gemini' && $value !== '.vscode') {
            getDirContents($path, $results);
        }
    }
    return $results;
}

echo "Scanning for files with banner calls...\n <br>";
$all_files = getDirContents($base_dir);

$files_to_recover = [];

foreach ($all_files as $file) {
    $content = file_get_contents($file);
    if (preg_match("/render_banner\(\\\$pdo,\s*'([^']+)'\)/", $content, $matches)) {
        $files_to_recover[] = [
            'file' => $file,
            'id' => $matches[1]
        ];
    }
}

echo "Found " . count($files_to_recover) . " files needing recovery.\n <br>";

foreach ($files_to_recover as $item) {
    $id = $item['id'];
    $file = $item['file'];

    // Check if ID exists
    $stmt = $pdo->prepare("SELECT id FROM banners WHERE page_identifier = ?");
    $stmt->execute([$id]);
    if ($stmt->fetch()) {
        continue;
    }

    // Determine defaults
    // Default Skincare values
    $title = 'Formülasyonunuzu Bulun';
    $desc = 'Tüm ürünlerimiz, cildinizin doğal durumunu iyileştirmek ve belirli sorunları hedeflemek amacıyla özel olarak formüle edilmiştir.';
    $img_desktop = 'assets/images/noc-skin-banner3.png';
    $img_mobile = 'assets/images/noc-new-banner3.png';
    $btn_text = 'Kendi Tedavi Programınızı Oluşturun';
    $btn_url = '../regimen-builder';
    $shop_text = 'Tüm Cilt Bakım Ürünlerini İncele';
    $shop_url = 'skincare/skincare-products';

    // Customize based on ID
    if (strpos($id, 'body-hair') !== false) {
        $title = 'Vücut ve Saç İçin Formüle Edilmiştir';
        $desc = 'Hem saç hem de vücut için günlük sorunlara yönelik formüle edilmiş ürünleri keşfedin.';
        $img_desktop = 'assets/images/noc-skin-banner4.png';
        $img_mobile = 'assets/images/noc-skin-banner4.png';
        $btn_text = '';
        $btn_url = '';
        $shop_text = 'Şimdi Alışveriş Yapın';
        $shop_url = 'https://theordinary.com/en-us/category/body-hair/all-body-hair';
    } else {
        // Attempt to customize title for other pages
        // e.g. skincare-suncare -> Suncare
        $parts = explode('-', $id);
        $last_part = end($parts);
        if ($last_part !== 'skincare') {
            $formatted_title = ucwords(str_replace('-', ' ', $last_part));
            // Keep generic images but update title to be slightly more relevant
            // Actually, static banners usually had the generic title. Let's keep generic title for safety unless it's a specific known page.
            if ($last_part == 'suncare')
                $title = 'Güneş Bakımı';
            // etc... leaving as generic is safer than wrong guesses.
            // But let's set the main category pages explicitly if they match
            if ($id == 'noc-skincare')
                $title = 'Formülasyonunuzu Bulun';
        }
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO banners (
            page_identifier, title, description, button_text, button_url, 
            shop_link_text, shop_link_url, image_desktop, image_mobile
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $id,
            $title,
            $desc,
            $btn_text,
            $btn_url,
            $shop_text,
            $shop_url,
            $img_desktop,
            $img_mobile
        ]);
        echo "Recovered: $id\n <br>";
    } catch (PDOException $e) {
        echo "Error recovering $id: " . $e->getMessage() . "\n <br>";
    }
}

echo "Recovery Complete.";
?>