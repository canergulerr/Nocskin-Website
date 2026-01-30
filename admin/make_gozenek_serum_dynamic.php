<?php
// admin/make_gozenek_serum_dynamic.php

// 1. Configuration
$sourceFile = __DIR__ . '/../ciltbakim/original-gozenek-sikilastirici-serum.php'; // The template
$targetFile = __DIR__ . '/../ciltbakim/gozenek-sikilastirici-serum.php';
$categorySlug = 'gozenek-sikilastirici-serum'; // DB Slug
$fallbackCatId = 18; // DB ID

// 2. Read Source
if (!file_exists($sourceFile)) {
    die("Source file not found: $sourceFile");
}
$html = file_get_contents($sourceFile);

// 3. Remove Byte Order Mark if present
$html = preg_replace('/^\xEF\xBB\xBF/', '', $html);

// 4. Extract Product Template
// Capture first product item
$productTemplateRegex = '/<div class="product-grid-item.*?(?:<div class="js-product-error-msg"><\/div>\s*<\/div>\s*<\/div>\s*<\/div>)/s';
preg_match($productTemplateRegex, $html, $templateMatch);

// Fallback regex if first one fails
if (empty($templateMatch)) {
    preg_match('/<div class="product-grid-item.*?>(.*?)<\/div>\s*<\/div>\s*<\/div>/s', $html, $templateMatch);
}

if (empty($templateMatch)) {
    $productTemplate = '<div class="product-grid-item pb-4"><div class="product">Template Extraction Failed</div></div>';
} else {
    $productTemplate = $templateMatch[0];
}

// 5. Build Dynamic PHP String
$phpHeader = <<<'PHP'
<?php
require_once __DIR__ . '/../../admin/includes/db.php';
require_once __DIR__ . '/../../includes/banner_helper.php'; 
require_once __DIR__ . '/../../includes/page_content_helper.php';

$categorySlug = 'gozenek-sikilastirici-serum';
$fallbackCatId = 18;

// Fetch Category ID
$stmt = $pdo->prepare("SELECT id FROM categories WHERE slug = ?");
$stmt->execute([$categorySlug]);
$cat = $stmt->fetch(PDO::FETCH_ASSOC);
$catId = $cat ? $cat['id'] : $fallbackCatId;

// Fetch Products
$products = [];
if ($catId) {
    $stmt = $pdo->prepare("
        SELECT p.* 
        FROM products p
        JOIN product_categories pc ON p.id = pc.product_id
        WHERE pc.category_id = ?
    ");
    $stmt->execute([$catId]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Dynamic Grid Logic
$gridTemplateColumns = 'repeat(4, 1fr)'; 
if (count($products) == 1) {
    $gridTemplateColumns = 'repeat(3, 1fr)'; 
}
?>
PHP;

// 6. Template replacements
$template = $productTemplate;
$template = str_replace('product-grid-item', 'product-grid-item pb-4', $template);

// Using Double Quoted strings with escaped $ for replacement, to avoid single quote confusion.
$hrefStr = "href=\"<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars(\$product['slug']) ?>\"";
$template = preg_replace('/href="[^"]*product\.php\?slug=[^"]*"/', $hrefStr, $template);

$nameLinkStr = "<a class=\"link product-link\" href=\"<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars(\$product['slug']) ?>\"><?= htmlspecialchars(\$product['name']) ?></a>";
$template = preg_replace('/<a class="link product-link"[^>]*>.*?<\/a>/s', $nameLinkStr, $template);

$pidStr = "data-pid=\"<?= \$product['id'] ?>\"";
$template = preg_replace('/data-pid="[^"]*"/', $pidStr, $template);

$jsPidStr = "js-pid-<?= \$product['id'] ?>";
$template = preg_replace('/js-pid-\d+/', $jsPidStr, $template);

$priceDispStr = "$<?= htmlspecialchars(\$product['price']) ?> USD";
$template = preg_replace('/\$[\d\.,]+ USD/', $priceDispStr, $template);

$priceMetaStr = "content=\"<?= htmlspecialchars(\$product['price']) ?>\"";
$template = preg_replace('/content="[\d\.,]+"/', $priceMetaStr, $template);

$imgSrcStr = "src=\"<?= (strpos(\$product['image'], 'http') === 0) ? \$product['image'] : BASE_URL . '/assets/images/products/' . \$product['image'] ?>\"";
$template = preg_replace('/src="[^"]*"/ i', $imgSrcStr, $template);

$imgDataSrcStr = "data-src=\"<?= (strpos(\$product['image'], 'http') === 0) ? \$product['image'] : BASE_URL . '/assets/images/products/' . \$product['image'] ?>\"";
$template = preg_replace('/data-src="[^"]*"/ i', $imgDataSrcStr, $template);


// 7. Loop Logic
$loopContent = <<<'PHP'
<?php if (empty($products)): ?>
    <div class="col-12" style="grid-column: 1 / -1;"><p class="text-center">Ürün bulunamadı.</p></div>
<?php else: ?>
    <?php foreach ($products as $index => $product): ?>
PHP;
$loopContent .= "\n" . $template . "\n";
$loopContent .= <<<'PHP'
    <?php endforeach; ?>
<?php endif; ?>
<!-- Grid Footer -->
<div class="col-12 d-none">
     <input type="hidden" class="permalink" value="<?= BASE_URL ?>/category.php?slug=<?= htmlspecialchars($slug) ?>">
</div>
PHP;

// 8. Inject and Clean Source
$cssInjection = <<<'CSS'
<style>
    /* Hide specific elements */
    .filter-bar,
    .result-container,
    .filter-sort-container,
    .refinement-bar,
    .refinement-group-header,
    .refinements {
        display: none !important;
    }

    #regimen-step {
        display: none !important;
    }

    .sort-col {
        display: none !important;
    }

    /* LAYOUT FIXES - CSS GRID */
    .search-results-container,
    .search-results_items-side,
    .product-grid {
        width: 100% !important;
        max-width: 100% !important;
        flex: 0 0 100% !important;
    }

    /* Dynamic Grid Layout */
    [data-brand=theordinary] .product-grid {
        display: grid !important;
        grid-template-columns: 
            <?= $gridTemplateColumns ?>
            !important;
        gap: 15px;
    }
    
    .product-grid-item {
        width: 100%;
        max-width: 100%;
    }
</style>
CSS;

$finalHtml = preg_replace('/^<\?php.*?\?>/s', '', $html);
$finalHtml = preg_replace('/<div class="filter-bar.*?<\/div>\s*<\/div>/s', '', $finalHtml);

// Inject Loop into Grid
$newGridBlock = '<div class="row product-grid js-product-grid" itemtype="http://schema.org/SomeProducts" itemid="#product" data-total-count="<?= count($products) ?>">' . $loopContent . '</div>';
$finalHtml = preg_replace('/<div class="row product-grid.*?<div class="recently-viewed-section"/s', $newGridBlock . '<div class="recently-viewed-section"', $finalHtml);

// Inject Header and CSS
$finalHtml = $phpHeader . "\n" . $finalHtml;
$finalHtml = str_replace('</head>', $cssInjection . '</head>', $finalHtml);

// 9. Write Target
file_put_contents($targetFile, $finalHtml);
echo "Generated $targetFile";
?>
