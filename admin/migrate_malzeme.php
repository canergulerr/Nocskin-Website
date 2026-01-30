<?php
require_once dirname(__DIR__) . '/config.php';
require_once 'includes/db.php';

echo "Starting Migration for Malzeme Sozlugu...\n";

// 1. Create Post if not exists
$slug = 'malzeme-sozlugu';
$stmt = $pdo->prepare("SELECT id FROM blog_posts WHERE slug = ?");
$stmt->execute([$slug]);
$post = $stmt->fetch();

if (!$post) {
    echo "Creating 'malzeme-sozlugu' post...\n";
    $stmtIns = $pdo->prepare("INSERT INTO blog_posts (title, slug, content, meta_title, meta_description, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmtIns->execute([
        'Malzeme Sözlüğü',
        $slug,
        '', // Initial content empty as we use sections
        'Malzeme Sözlüğü | Noc',
        'Explore The Ordinary\'s ingredient glossary and uncover the technologies behind our science-led formulas for healthier, radiant skin.',
        1
    ]);
    $postId = $pdo->lastInsertId();
} else {
    echo "Post exists (ID: " . $post['id'] . ")\n";
    $postId = $post['id'];
}

// 2. Load HTML File
$htmlFile = BASE_PATH . '/blog/malzeme-sozlugu.php';
if (!file_exists($htmlFile)) {
    die("File not found: $htmlFile");
}
$htmlContent = file_get_contents($htmlFile);

// Filter out PHP tags to avoid parser errors if any (simple approach) or just load it
// DOMDocument behaves better with pure HTML.
$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML('<?xml encoding="utf-8" ?>' . $htmlContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
libxml_clear_errors();

$xpath = new DOMXPath($dom);

$data = [];

// 3. Extract Header Info
// Header Image (first layout2 picture img)
$headerImgNode = $xpath->query("(//div[contains(@class, 'layout2')]//img)[1]")->item(0);
$data['header_image'] = $headerImgNode ? $headerImgNode->getAttribute('src') : ''; // Or data-src? check file. File uses lazy loading usually.
// Check file: ... <img class="lazy" ... src="data:..." > <source data-srcset="...">
// We need the data-srcset or a high res url.
// Let's grab the biggest source? Or just a representative one.
// Actually, looking at file, source has data-srcset.
// Let's try to get the 1440px source set url roughly.
$sourceNode = $xpath->query("(//div[contains(@class, 'layout2')]//source[@media='(min-width: 1440px)'])[1]")->item(0);
if ($sourceNode) {
    $srcset = $sourceNode->getAttribute('data-srcset');
    $urls = explode(',', $srcset);
    $firstUrl = trim(explode(' ', trim($urls[0]))[0]);
    $data['header_image'] = $firstUrl;
}

// Intro Text
// layout4 -> text-block single-column
$introNode = $xpath->query("(//div[contains(@class, 'layout4')]//div[contains(@class, 'text-block')])[1]")->item(0);
$data['intro_text'] = $introNode ? trim($introNode->nodeValue) : '';

// 4. Extract Groups
// Groups are identified by h1/div class title-text or similar.
// "İçindekiler (A-F)"
$groups = [
    'ingredients_a_f' => 'İçindekiler (A-F)',
    'ingredients_g_l' => 'İçindekiler (G-L)',
    'ingredients_m_r' => 'İçindekiler (M-R)',
    'ingredients_s_z' => 'İçindekiler (S-Z)',
];

foreach ($groups as $key => $titleSearch) {
    echo "Processing Group: $titleSearch\n";
    $groupItems = [];

    // Find the title node
    // It could be h1 or div with class title-text containing the text
    $titleNode = $xpath->query("//*[contains(@class, 'title-text') and contains(text(), '$titleSearch')]")->item(0);

    if ($titleNode) {
        // The swiper carousel is usually in the same parent container or following sibling container.
        // Structure: .ampliance_layout .layout6 .Carousel
        //   .amp_partial -> title
        //   .amp_carousel -> .swiper-wrapper -> .swiper-slide

        // Go up to layout6 container
        $container = $titleNode->parentNode;
        while ($container && strpos($container->getAttribute('class'), 'ampliance_layout') === false) {
            $container = $container->parentNode;
        }

        if ($container) {
            $slides = $xpath->query(".//div[contains(@class, 'swiper-slide')]", $container);
            foreach ($slides as $slide) {
                $item = [];

                // Image
                $img = $xpath->query(".//img", $slide)->item(0);
                $item['image'] = '';
                if ($img) {
                    $item['image'] = $img->getAttribute('data-src') ?: $img->getAttribute('src');
                }

                // Title
                $nameNode = $xpath->query(".//div[contains(@class, 'event-name')]/span", $slide)->item(0);
                $item['title'] = $nameNode ? trim($nameNode->nodeValue) : '';

                // Subtitle
                $subNode = $xpath->query(".//div[contains(@class, 'event-subtitle')]//div[contains(@class, 'sub')]", $slide)->item(0);
                $item['subtitle'] = $subNode ? trim($subNode->nodeValue) : '';

                // Link
                $linkNode = $xpath->query(".//div[contains(@class, 'shop-cta')]//a", $slide)->item(0);
                $item['link'] = $linkNode ? $linkNode->getAttribute('href') : '';

                if ($item['title']) {
                    $groupItems[] = $item;
                }
            }
        }
    }

    echo "Found " . count($groupItems) . " items.\n";
    $data[$key] = json_encode($groupItems, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}

// 5. Insert into DB
$stmtInset = $pdo->prepare("INSERT INTO blog_post_sections (post_id, section_key, section_value, section_type) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE section_value = VALUES(section_value)");

foreach ($data as $k => $v) {
    $type = (strpos($k, 'ingredients') !== false) ? 'json' : ((strpos($k, 'image') !== false) ? 'image' : 'text');
    $stmtInset->execute([$postId, $k, $v, $type]);
}

echo "Migration Completed Successfully.\n";
?>