<?php
require_once 'config.php';
require_once 'admin/includes/db.php';

// 1. Fetch Original HTML from DB
$slug = 'rejim-rehberi';
$stmt = $pdo->prepare("SELECT content FROM blog_posts WHERE slug = ?");
$stmt->execute([$slug]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$originalHtml = $row['content'];

// 2. Define Replacements (Original String -> PHP Echo)
// We need to be careful to match exact strings from the DB content.
// I will use some smarter replacement str_replace or regex.

$replacements = [
    // Main Title
    'Temel Bilgilere Dönüş:<br>Bir Rejim Nasıl Oluşturulur?' => "<?= s('main_title') ?>",
    'Temel Bilgilere Dönüş: Bir Rejim Nasıl Oluşturulur?' => "<?= s('main_title') ?>", // Variation
    'Temel Bilgilere Dönüş:<span class="d-none d-md-inline"> </span><br class="d-md-none">Bir Rejim Nasıl Oluşturulur?' => "<?= s('main_title') ?>", // Possible HTML variation

    // Header Logo
    'https://publicfiles10em.blob.core.windows.net/cdn/Images/Deciem/brands/logos/white/ORD-O-Icon.png' => "<?= s('header_logo_url') ?>",

    // Regimen Basics
    'Rejim Temelleri' => "<?= s('regimen_basics_title') ?>",
    // For long texts, we might matching start/end or use the text from extracting script.
    // However, exact match is safest for preserving structure.
    // If text is too long/complex, I might just replace the keys I know.

    // Images
    'https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-BodyImg-01?fmt=auto&$poi$&sm=aspect&w=260&aspect=1:1' => "<?= s('how_many_products_image') ?>",
    'https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-BodyImg-02?fmt=auto&$poi$&sm=aspect&w=650&aspect=65:36' => "<?= s('middle_right_image') ?>",
    'https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_01?fmt=auto&$poi$&sm=aspect&w=1550&aspect=4:1' => "<?= s('infographic_image') ?>",
    'https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-BodyImg-03?fmt=auto&$poi$&sm=aspect&w=260&aspect=1:1' => "<?= s('conflicting_products_image') ?>",
    'https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-BodyImg-04?fmt=auto&$poi$&sm=aspect&w=650&aspect=65:36' => "<?= s('middle_right_image_2') ?>",
    'https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-BodyImg-05?fmt=auto&$poi$&sm=aspect&w=260&aspect=1:1' => "<?= s('faq_image') ?>",

    // Titles
    'Kaç ürüne ihtiyacım var?' => "<?= s('how_many_products_title') ?>",
    'Adım 1: Hazırlık' => "<?= s('step1_title') ?>",
    'Adım 2: Tedavi' => "<?= s('step2_title') ?>",
    'Aynı formatta birden fazla ürün olması durumunda ne olur?' => "<?= s('multiple_products_title') ?>",
    'Çakışan Ürünler' => "<?= s('conflicting_products_title') ?>",
    'Adım 3: Koruma' => "<?= s('step3_title') ?>",
    'Rejim Oluşturma Hakkında Sıkça Sorulan Sorular' => "<?= s('faq_title') ?>",
];

$dynamicHtml = $originalHtml;
foreach ($replacements as $search => $replace) {
    $dynamicHtml = str_replace($search, $replace, $dynamicHtml);
}

// 3. Construct File Content with Original Head (from logs) and Footer
$headContent = <<<'EOT'
<?php 
include dirname(__DIR__) . '/config.php'; 
include BASE_PATH . '/admin/includes/db.php';

$slug = 'rejim-rehberi';
$stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE slug = ? AND status = 1");
$stmt->execute([$slug]);
$post = $stmt->fetch();

$sections = [];
if ($post) {
    $stmtSec = $pdo->prepare("SELECT section_key, section_value FROM blog_post_sections WHERE post_id = ?");
    $stmtSec->execute([$post['id']]);
    $sections = $stmtSec->fetchAll(PDO::FETCH_KEY_PAIR);
}
function s($key, $default = '') {
    global $sections;
    return isset($sections[$key]) && $sections[$key] !== '' ? $sections[$key] : $default;
}
if (!$post) { $post = ['meta_title' => 'Rejim Rehberi', 'meta_description' => '']; }
?>
<!DOCTYPE html>
<html lang="en" data-preferences="" data-contenturl="/on/demandware.store/Sites-deciem-us-Site/en_US/Page-GetContent">
<head>
    <!--[if gt IE 9]><!-->
    <script>//common/scripts.isml</script>
    <script defer="" type="text/javascript" src="<?= BASE_URL ?>/assets/js/jquery.min.js"></script>
    <script defer="" type="text/javascript" src="<?= BASE_URL ?>/assets/js/vendors.js"></script>
    <script defer="" type="text/javascript" src="<?= BASE_URL ?>/assets/js/js_main.js"></script>
    <script defer="" type="text/javascript" src="<?= BASE_URL ?>/assets/js/bv.js"></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/assets/js/main.js"></script>
    <script type="text/javascript">window.OrdergrooveTrackingUrl = "/on/demandware.store/Sites-deciem-us-Site/en_US/OrderGroove-PurchasePostTracking"</script>
    <script type="text/javascript">window.OrdergrooveLegacyOffers = false</script>
    <script type="text/javascript">window.SFRA = window.SFRA || {};</script>

    <!--<![endif]-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title><?= htmlspecialchars($post['meta_title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($post['meta_description']) ?>">
    <meta name="keywords" content="Skincare regimen">

    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/icons-font.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/global.css">
    
    <!-- SEO and Analytics meta tags skipped for brevity but should be here -->
</head>
<body>
    <?php include BASE_PATH . '/header.php'; ?>

    <div role="main" id="maincontent">
        <!-- Dyn Content -->
EOT;

$footerContent = <<<'EOT'
        <!-- End Dyn Content -->
    </div>

    <?php include BASE_PATH . '/footer.php'; ?>
</body>
</html>
EOT;

// Combine
$fullContent = $headContent . "\n" . $dynamicHtml . "\n" . $footerContent;

file_put_contents('blog/rejim-rehberi.php', $fullContent);
echo "File restored with dynamic variables.";

?>