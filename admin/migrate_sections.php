<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/includes/db.php';

// 1. Get the post
$slug = 'rejim-rehberi';
$stmt = $pdo->prepare("SELECT id, content FROM blog_posts WHERE slug = ?");
$stmt->execute([$slug]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    die("Post not found.");
}

$postId = $post['id'];
$html = $post['content'];

// 2. Parse HTML
$dom = new DOMDocument();
libxml_use_internal_errors(true);
// Hack for UTF-8
$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
libxml_clear_errors();

$xpath = new DOMXPath($dom);

// Helper to get text by searching for h2 title text
function getContentByTitle($xpath, $titleText)
{
    // Find h2 containing the text
    // Normalize spaces in xpath is tricky, trying simple contains
    $nodes = $xpath->query("//h2[contains(., '$titleText')]");
    if ($nodes->length > 0) {
        $h2 = $nodes->item(0);

        $parent = $h2->parentNode; // .d-flex flex-wrap flex-column
        // Find .text-content inside parent
        $textDivs = $xpath->query(".//div[contains(@class, 'text-content')]", $parent);
        if ($textDivs->length > 0) {
            $textDiv = $textDivs->item(0);
            // Try to get .amp_partial inner div first
            $innerDivs = $xpath->query(".//div[contains(@class, 'amp_partial')]", $textDiv);
            $target = ($innerDivs->length > 0) ? $innerDivs->item(0) : $textDiv;

            $html = '';
            foreach ($target->childNodes as $child) {
                $html .= $target->ownerDocument->saveHTML($child);
            }
            return trim($html);
        }
    }
    return '';
}

// Map of keys to title search strings
$sections = [
    'regimen_basics' => 'Rejim Temelleri',
    'how_many_products' => 'Kaç ürüne ihtiyacım var?',
    'step1' => 'Adım 1: Hazırlık',
    'step2' => 'Adım 2: Tedavi',
    'multiple_products' => 'Aynı formatta birden fazla', // partial match
    'conflicting_products' => 'Çakışan Ürünler',
    'step3' => 'Adım 3: Koruma',
    'faq' => 'Rejim Oluşturma Hakkında Sıkça Sorulan Sorular'
];

$data = [];

// Static/Manual Values first (Images & Main Title)
$data['header_logo_url'] = 'https://publicfiles10em.blob.core.windows.net/cdn/Images/Deciem/brands/logos/white/ORD-O-Icon.png';
$data['main_title'] = 'Temel Bilgilere Dönüş: Bir Rejim Nasıl Oluşturulur?';

// Images (Hardcoded as per user request to ensure accuracy, rather than parsing)
$data['how_many_products_image'] = 'https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-BodyImg-01?fmt=auto&$poi$&sm=aspect&w=260&aspect=1:1';
$data['middle_right_image'] = 'https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-BodyImg-02?fmt=auto&$poi$&sm=aspect&w=650&aspect=65:36';
$data['infographic_image'] = 'https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_01?fmt=auto&$poi$&sm=aspect&w=1550&aspect=4:1';
$data['conflicting_products_image'] = 'https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-BodyImg-03?fmt=auto&$poi$&sm=aspect&w=260&aspect=1:1';
$data['middle_right_image_2'] = 'https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-BodyImg-04?fmt=auto&$poi$&sm=aspect&w=650&aspect=65:36';
$data['faq_image'] = 'https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-BodyImg-05?fmt=auto&$poi$&sm=aspect&w=260&aspect=1:1';

// Dynamic Text Extraction
foreach ($sections as $key => $searchPhrase) {
    $text = getContentByTitle($xpath, $searchPhrase);

    // We store Title and Text separately if possible, but here key implies grouping.
    // Let's store title as the searchPhrase (or manual) and text as extracted.
    $data[$key . '_title'] = $searchPhrase;
    // Fix full titles manually if search was partial
    if ($key == 'multiple_products')
        $data[$key . '_title'] = "Aynı formatta birden fazla ürün olması durumunda ne olur?";

    $data[$key . '_text'] = $text;
}

// Insert into DB
$stmtInset = $pdo->prepare("INSERT INTO blog_post_sections (post_id, section_key, section_value, section_type) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE section_value = VALUES(section_value)");

foreach ($data as $key => $value) {
    if (empty($value))
        continue; // Skip empty

    $type = 'text';
    if (strpos($key, 'image') !== false || strpos($key, 'url') !== false) {
        $type = 'image';
    }

    $stmtInset->execute([$postId, $key, $value, $type]);
}

echo "Migration of sections completed.";

?>