<?php
// 1. Configuration
$sourceFile = __DIR__ . '/../ciltbakim/original-goz-cevresi-serum.php';
$targetFile = __DIR__ . '/../ciltbakim/goz-cevresi-serum.php'; // Corrected path
$categorySlug = 'goz-cevresi-serum';

// 2. Read Source
if (!file_exists($sourceFile)) {
    die("Source file not found: $sourceFile\n");
}
$html = file_get_contents($sourceFile);

// 3. Extract Product Tile Template
// We look for a single product-grid-item to use as a template.
// The file has multiple, so we take the first one.
$pattern = '/<div class="product-grid-item">(.*?)<div class="js-product-error-msg"><\/div>\s*<\/div>\s*<\/div>\s*<\/div>/s';
if (preg_match($pattern, $html, $matches)) {
    $productTemplate = '<div class="product-grid-item">' . $matches[1] . '<div class="js-product-error-msg"></div></div></div></div>';
} else {
    // Fallback: try a simpler match if the structure is slightly different
    $pattern = '/<div class="product-grid-item">(.*?)<!-- END_dwmarker -->\s*<div class="js-product-error-msg"><\/div>\s*<\/div>\s*<\/div>\s*<\/div>/s';
    if (preg_match($pattern, $html, $matches)) {
        $productTemplate = '<div class="product-grid-item">' . $matches[1] . '<!-- END_dwmarker --><div class="js-product-error-msg"></div></div></div></div>';
    } else {
        die("Could not extract product template.\n");
    }
}

// 4. Extract Interrupter Tile Template (if exists)
$interrupterHTML = '';
$interrupterPattern = '/<\?php if \(!empty\(\$pageSections\)\):.*?<\?php endif; \?>/s';
if (preg_match($interrupterPattern, $html, $matches)) {
    $interrupterHTML = $matches[0];
}

// 5. Prepare New Loop Logic
$loopCode = <<<'PHP'
<?php
// Dynamic Grid Logic
$insertedInterrupter = false;

// Capture Interrupter HTML using Output Buffering to handle mixed PHP/HTML
ob_start();
?>
%INTERRUPTER%
<?php
$interrupterHTML = ob_get_clean();

if (!empty($products)):
    foreach ($products as $index => $product):
        $shouldInsert = false;
        // Logic: Insert after 1st item (index 0) if only 1 item, or after 2nd item (index 1) if >= 2 items
        if (count($products) == 1 && $index == 0) $shouldInsert = true;
        if (count($products) >= 2 && $index == 1) $shouldInsert = true;
?>
%PRODUCT_TEMPLATE%
<?php 
        if ($shouldInsert && !empty($interrupterHTML)): 
?>
            <div class="pb-4 grid-interrupter-tile-wrapper" style="grid-column: span 2;">
                <?= $interrupterHTML ?>
            </div>
            <?php $insertedInterrupter = true; ?>
<?php 
        endif; 
    endforeach; 

    // Fallback: if not inserted (e.g. products loop logic change), append it
    if (!$insertedInterrupter && !empty($interrupterHTML) && count($products) > 0): 
?>
        <div class="pb-4 grid-interrupter-tile-wrapper" style="grid-column: span 2;">
            <?= $interrupterHTML ?>
        </div>
<?php 
    endif;
endif; 
?>
PHP;

// 6. Template replacements
$template = $productTemplate;
// Ensure padding class exists
if (strpos($template, 'product-grid-item pb-4') === false) {
    // echo "Adding pb-4 class to template...\n";
    $template = str_replace('product-grid-item', 'product-grid-item pb-4', $template);
}

// Product Link Handling
// Replace static href with dynamic slug
$hrefStr = "href=\"<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars(\$product['slug']) ?>\"";
$template = preg_replace('/href=\"[^\"]*product\.php\?slug=[^\"]*\"/', $hrefStr, $template); // Prioritize if already dynamic
$template = preg_replace('/href=\"[^\"]*\/\/[^\/]+\d+\"/', $hrefStr, $template); // Match typical static links like /glucoside-foaming-face-cleanser-100616
$template = preg_replace('/href=\"<?= BASE_URL ?>\/[^\"]+\d+\"/', $hrefStr, $template); // Match mixed links

// Image handling - Use dynamic image path logic
// Replace <picture> block with single <img> 
// We want to replace the whole <picture>...</picture> block or just the img src inside if simpler.
$imgPattern = '/<img class="tile-image lazy.*?>/s';
$newImgTag = '<img class="tile-image lazy" src="<?= (strpos($product[\'image\'], \'http\') === 0) ? $product[\'image\'] : BASE_URL . \'/assets/images/products/\' . $product[\'image\'] ?>" alt="<?= htmlspecialchars($product[\'name\']) ?>" title="<?= htmlspecialchars($product[\'name\']) ?>">';

// Replace the picture tag completely if it exists
if (strpos($template, '<picture>') !== false) {
    $template = preg_replace('/<picture>.*?<\/picture>/s', $newImgTag, $template);
} else {
    $template = preg_replace($imgPattern, $newImgTag, $template);
}


// Name and Title replacement
// Find <h2>...<a ...>Name</a>...</h2>
$nameLinkPattern = '/<h2 class="pdp-link">\s*<a class="link product-link".*?>.*?<\/a>\s*<\/h2>/s';
$newNameLink = '<h2 class="pdp-link"><a class="link product-link" href="<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars($product[\'slug\']) ?>"><?= htmlspecialchars($product[\'name\']) ?></a></h2>';
$template = preg_replace($nameLinkPattern, $newNameLink, $template);

// Bazaar Rating Link
// Replace href to #bazaar-rating
$ratingLinkStr = "href=\"<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars(\$product['slug']) ?>#bazaar-rating\"";
$template = preg_replace('/href=\"[^\"]*#bazaar-rating\"/', $ratingLinkStr, $template);

// Price Replacement
// Look for <span class="value" ...>...</span>
$pricePattern = '/<span class="value" content="[\d\.]+">\s*\$[\d\.]+ USD\s*<\/span>/s';
$priceReplacement = '<span class="value" content="<?= htmlspecialchars($product[\'price\']) ?>">$<?= htmlspecialchars($product[\'price\']) ?> USD</span>';
$template = preg_replace($pricePattern, $priceReplacement, $template);

// Data Attributes (pid, id, etc)
// Simplistic replacement for data-pid="...". 
$template = preg_replace('/data-pid="[\d]+"/', 'data-pid="<?= $product[\'id\'] ?>"', $template);
// JSON in data-gtm-enhanced-ecommerce
$template = preg_replace('/data-gtm-enhanced-ecommerce="{.*?}"/', 'data-gtm-enhanced-ecommerce="{&quot;id&quot;:&quot;<?= $product[\'id\'] ?>&quot;,&quot;name&quot;:&quot;<?= htmlspecialchars($product[\'name\']) ?>&quot;,&quot;brand&quot;:&quot;The Ordinary&quot;,&quot;price&quot;:&quot;<?= $product[\'price\'] ?>&quot;}"', $template);


// 7. Inject Template into Loop Code
$loopCode = str_replace('%PRODUCT_TEMPLATE%', $template, $loopCode);
$loopCode = str_replace('%INTERRUPTER%', $interrupterHTML, $loopCode); // Inject the captured interrupter logic

// 8. Reconstruct Full HTML
// Header Logic
$header = <<<'PHP'
<?php
require_once __DIR__ . '/../admin/includes/db.php';
require_once __DIR__ . '/../includes/banner_helper.php'; 
require_once __DIR__ . '/../includes/page_content_helper.php';

$categorySlug = 'goz-cevresi-serum';
$fallbackCatId = 20;

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

$finalHtml = $header . $html;

// CSS Injection
$cssInjection = <<<'CSS'
<style>
    /* Hide specific elements */
    .filter-bar,
    .result-container,
    .filter-sort-container,
    .grid-footer, 
    .search-results-count,
    .refinement-bar {
        display: none !important;
    }

    /* Force Grid Layout */
    .product-grid {
        display: grid !important;
        grid-template-columns: <?= $gridTemplateColumns ?> !important;
        gap: 40px !important; /* Increased gap */
        width: 100% !important;
        margin: 0 auto !important;
    }
    
    .product-grid-item {
        max-width: 100% !important;
        flex: 0 0 auto !important;
        width: auto !important;
    }

    /* Adjust for Interrupter */
    .grid-interrupter-tile-wrapper {
        grid-column: span 2; /* Span 2 columns */
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .grid-interrupter-tile {
        width: 100%;
        height: 100%;
    }

    /* Responsive adjustments */
    @media (max-width: 1200px) {
        .product-grid {
            grid-template-columns: repeat(3, 1fr) !important;
            gap: 20px !important;
        }
    }
    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr) !important;
             gap: 15px !important;
        }
    }
</style>
CSS;
$finalHtml = str_replace('</head>', $cssInjection . '</head>', $finalHtml);


// Inject Loop into Grid
$startMarker = '<div class="row product-grid js-product-grid"';
$endMarker = '<div class="recently-viewed-section"';

$startPos = strpos($finalHtml, $startMarker);
$endPos = strpos($finalHtml, $endMarker);

if ($startPos !== false && $endPos !== false) {
    $startTagEnd = strpos($finalHtml, '>', $startPos) + 1;
    $before = substr($finalHtml, 0, $startTagEnd);
    $after = substr($finalHtml, $endPos);

    $finalHtml = $before . $loopCode . '</div>' . $after;

} else {
    echo "Could not find grid markers!\n";
}

// 9. Save
file_put_contents($targetFile, $finalHtml);
echo "Generated $targetFile\n";