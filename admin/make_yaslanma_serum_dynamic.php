<?php
// 1. Configuration
$sourceFile = __DIR__ . '/../ciltbakim/yaslanma-karsiti-serum.php'; // Edit in place
$targetFile = __DIR__ . '/../ciltbakim/yaslanma-karsiti-serum.php';
$categorySlug = 'yaslanma-karsiti-serum';
$fallbackCatId = 21;

// 2. Read Source
if (!file_exists($sourceFile)) {
    die("Source file not found: $sourceFile\n");
}
$html = file_get_contents($sourceFile);

// 3. Define Product Template (Hardcoded from goz-cevresi-serum for consistency)
$productTemplate = <<<'HTML'
<div class="product-grid-item pb-4">
    <div class="product" data-pid="<?= $product['id'] ?>" data-available="true">
        <div class="product-tile product-detail js-product-tile js-gtm-product-data js-pid-<?= $product['id'] ?>  "
            data-pid="<?= $product['id'] ?>" data-available="true"
            data-gtm-enhanced-ecommerce="{&quot;id&quot;:&quot;<?= $product['id'] ?>&quot;,&quot;name&quot;:&quot;<?= htmlspecialchars($product['name']) ?>&quot;,&quot;brand&quot;:&quot;The Ordinary&quot;,&quot;price&quot;:&quot;<?= $product['price'] ?>&quot;}">
            <div class="tile-container">
                <input type="hidden" class="wishlist-fill-heart-grid-url" id="wishlistUrl-grid"
                    value="/on/demandware.store/Sites-deciem-us-Site/en_US/Wishlist-WishlistFillIcon" encoding="off">
                <div class="image-container">
                    <a class="wishlistTile js-wishlist-container addProductWishlist"
                        href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Wishlist-AddProduct.json"
                        title="Wishlist" data-pid="<?= $product['id'] ?>">
                        <span class="fa-stack fa-lg wishlist-product-heart" data-pid="<?= $product['id'] ?>">
                            <i class="fa fa-circle fa-inverse fa-stack-2x"></i>
                            <i class="fa icon-heart fa-stack-1x"></i>
                        </span>
                    </a>
                    <a class="product-link" href="<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars($product['slug']) ?>">
                        <img class="tile-image lazy"
                            src="<?= (strpos($product['image'], 'http') === 0) ? $product['image'] : BASE_URL . '/assets/images/products/' . $product['image'] ?>"
                            alt="<?= htmlspecialchars($product['name']) ?>"
                            title="<?= htmlspecialchars($product['name']) ?>">
                    </a>
                    <button class="quickview js-quickview hidden-md-down btn btn-primary btn-block"
                        data-url="/on/demandware.store/Sites-deciem-us-Site/en_US/Product-ShowQuickView?pid=<?= $product['id'] ?>"
                        data-toggle="modal" data-target="#quickViewModal"
                        title="Quick View for <?= htmlspecialchars($product['name']) ?>"
                        aria-label="Quick View">
                        <span class="quickview-btn-icon"></span>
                        <span class="quickview-btn">Quick view</span>
                    </button>
                </div>
                <div class="tile-body">
                    <div class="am-pm">
                        <span class="icon-am"></span>
                        <span class="icon-pm"></span>
                    </div>
                    <h2 class="pdp-link"><a class="link product-link" href="<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars($product['slug']) ?>"><?= htmlspecialchars($product['name']) ?></a></h2>
                </div>
                <div class="tile-body-footer">
                    <div class="ratings">
                        <div class="bazaar-container">
                            <a class="bazaar-link" href="<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars($product['slug']) ?>#bazaar-rating"></a>
                            <div data-bv-show="inline_rating" data-bv-productid="<?= $product['id'] ?>" data-bv-seo="false"></div>
                        </div>
                    </div>
                    <h3 class="title-descriptor">
                        <div class="title-descriptor-value"><?= htmlspecialchars($product['summary'] ?? '') ?></div>
                    </h3>
                </div>
            </div>
            <div class="js-product-add-to-basket">
                <div class="product_price_and_size">
                     <div class="prices">
                        <div class="price">
                            <span class="product-prices">
                                <span class="sales">
                                    <span class="value" content="<?= htmlspecialchars($product['price']) ?>">$<?= htmlspecialchars($product['price']) ?> USD</span>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="adding_to_cart">
                    <div class="adding_to_cart-inner">
                         <div class="add_to_cart_footer js-add_to_cart_footer">
                            <button class="btn btn-block js-tile-add-to-cart-btn js-back-in-stock"
                                data-available="true" data-pid="<?= $product['id'] ?>">
                                <span class="sr-only label-addtocart">Add to Cart</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="js-product-error-msg"></div>
        </div>
    </div>
</div>
HTML;

// 4. Extract Interrupter (Empty by default for now, unless we want to copy logic)
// For now, we'll strip existing interrupters or just skip extraction since we are writing new logic.

// 5. Prepare New Loop Logic
$loopCode = <<<'PHP'
<?php
// Dynamic Grid Logic
$insertedInterrupter = false;

// Capture Interrupter HTML using Output Buffering
ob_start();
// Use correct ID
$contentBlocks = getPageContentBlocks($pdo, 'yaslanma-karsiti-serum');
if (!empty($contentBlocks)):
    $block = $contentBlocks[0];
?>
    <div class="grid-interrupter-tile" data-category="">
        <div class="grid-interrupter-slot-container">
            <div class="content-image">
                <img src="<?= BASE_URL ?>/<?= htmlspecialchars($block['image_url']) ?>" title="" alt="">
            </div>
            <div class="content-body">
                <div class="content-title"><?= htmlspecialchars($block['title']) ?></div>
                <div class="content-msg"><?= htmlspecialchars($block['subtitle']) ?></div>
                <div class="amp_partial general-cta">
                    <a class="btn-rounded-primary" href="<?= htmlspecialchars($block['button_url']) ?>"><?= htmlspecialchars($block['button_text']) ?></a>
                </div>
            </div>
        </div>
    </div>
<?php endif; 
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

    // Fallback
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

$loopCode = str_replace('%PRODUCT_TEMPLATE%', $productTemplate, $loopCode);

// 6. Header Logic (Already present in file? The user added it top. We need to make sure we don't duplicate or delete it)
// The user added a block at the top. We will Preserve it or Ensure it's correct.
// Actually, let's just make sure the file *starts* with the correct includes.
// The user's snippet shows:
/*
<?php
require_once __DIR__ . '/../admin/includes/db.php';
include __DIR__ . '/../config.php';
include __DIR__ . '/../includes/wp_shims.php';
require_once __DIR__ . '/../includes/banner_helper.php';
require_once __DIR__ . '/../includes/page_content_helper.php';
...
*/

// We will NOT overwrite the whole file header if it looks correct, but we WILL inject CSS fixes.

// 7. Inject Loop into Grid
// We need to find the Grid Container.
// Options:
// 1. <div class="row product-grid js-product-grid" ...>
// 2. <div class="product-grid ...">
// 3. Fallback: Before <div class="content-list-module">

$gridStartMarker = '<div class="row product-grid js-product-grid"';
$startPos = strpos($html, $gridStartMarker);

if ($startPos !== false) {
    // Found the grid div.
    // Find the closing div for the grid. This is tricky with nested divs.
    // We can assume the grid ends before "recently-viewed-section" or "content-list-module" or "grid-footer".

    $endMarker = '<div class="recently-viewed-section"';
    $endPos = strpos($html, $endMarker);

    if ($endPos === false) {
        $endMarker = '<div class="content-list-module"';
        $endPos = strpos($html, $endMarker);
    }

    if ($endPos !== false) {
        // We replace everything between startMarker (after the opening tag) and endMarker.
        // Identify the end of the opening tag.
        $startTagEnd = strpos($html, '>', $startPos) + 1;

        $before = substr($html, 0, $startTagEnd);
        $after = substr($html, $endPos);

        $finalHtml = $before . "\n" . $loopCode . "\n</div>\n" . $after; // Close the grid div
    } else {
        die("Could not find end marker for grid.\n");
    }
} else {
    // Grid not found? Maybe it's buried in filter garbage.
    // Let's look for ANY product-grid
    $startPos = strpos($html, 'product-grid');
    if ($startPos !== false) {
        die("Found 'product-grid' at pos $startPos but not the full string. Check file manually.\n");
    }
    die("Could not find product-grid marker.\n");
}

// 8. Inject CSS Fixes if not present
if (strpos($finalHtml, '.product-grid {') === false) {
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
    .product-grid {
        display: grid !important;
        grid-template-columns: <?= $gridTemplateColumns ?> !important;
        gap: 40px;
    }

    .product-grid-item {
        width: 100%;
        max-width: 100%;
    }
     .grid-interrupter-tile-wrapper {
        grid-column: span 2;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

</style>
CSS;
    $finalHtml = str_replace('<!--[if gt IE 9]><!-->', $cssInjection . "\n" . '<!--[if gt IE 9]><!-->', $finalHtml);
}

// 9. Save
file_put_contents($targetFile, $finalHtml);
echo "Updated $targetFile\n";
?>