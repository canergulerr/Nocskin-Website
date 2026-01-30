<?php
$file = __DIR__ . '/../category.php';

// USE THE ORIGINAL FILE AS BASE to ensure clean slate
$baseFile = __DIR__ . '/../ciltbakim/original-leke-karsiti-aydinlatici-serum.php';

if (!file_exists($baseFile)) {
    die("Original base file not found.");
}

$content = file_get_contents($baseFile);

// 1. Inject Header PHP (Standard)
$headerPHP = <<<PHP
<?php
require_once __DIR__ . '/admin/includes/db.php';
include __DIR__ . '/config.php';
include __DIR__ . '/includes/wp_shims.php';
require_once __DIR__ . '/includes/banner_helper.php';
require_once __DIR__ . '/includes/page_content_helper.php';

\$slug = \$_GET['slug'] ?? '';
\$stmt = \$pdo->prepare("SELECT * FROM categories WHERE slug = ?");
\$stmt->execute([\$_GET['slug']]);
\$category = \$stmt->fetch(PDO::FETCH_ASSOC);

if (!\$category) {
    \$category = ['name' => 'Kategori Bulunamadı', 'description' => '', 'id' => 0, 'slug' => ''];
}

// Fetch products
\$pStmt = \$pdo->prepare("SELECT p.* FROM products p JOIN product_categories pc ON p.id = pc.product_id WHERE pc.category_id = ? ORDER BY p.id DESC");
\$pStmt->execute([\$category['id']]);
\$products = \$pStmt->fetchAll(PDO::FETCH_ASSOC);
?>
PHP;

// Replace top requires
$content = preg_replace('/<\?php require_once.*?page_content_helper\.php\'; \?>/s', $headerPHP, $content, 1);
$content = str_replace("<?php include dirname(__DIR__) . '/config.php'; ?>", "", $content); // Remove duplicate config if any

// 2. Identify and Preserve Interrupter Tile
// We need the HTML block for <div class="grid-interrupter-tile" ...> ... </div>
// We can extract it from the $content using regex or markers.
$interrupterStart = strpos($content, '<div class="grid-interrupter-tile"');
if ($interrupterStart === false)
    die("Interrupter tile not found in base.");

// Find closing div for interrupter.
// It contains nested divs, so we need to be careful.
// Structure:
// <div class="grid-interrupter-tile" ...>
//    <div class="grid-interrupter-slot-container">
//       ...
//    </div>
// </div>
// It seems fairly well isolated.
$interrupterEnd = strpos($content, '<!-- CQuotient Activity Tracking', $interrupterStart); // This comment follows it in original
if ($interrupterEnd !== false) {
    // Backtrack to last </div> before the comment
    $interrupterEnd = strrpos(substr($content, 0, $interrupterEnd), '</div>') + 6;
} else {
    // Fallback search
    die("Could not pinpoint end of interrupter tile.");
}

$interrupterHTML = substr($content, $interrupterStart, $interrupterEnd - $interrupterStart);
$interrupterPHP = '<?php echo $interrupterHTML; ?>';
// We will embed this HTML string into the PHP script logic.

// 3. Locate Product Grid Wrapper
// Start: <div class="row product-grid js-product-grid" ...>
$startMarker = '<div class="row product-grid js-product-grid"';
$startPos = strpos($content, $startMarker);
$tagEndPos = strpos($content, '>', $startPos);
$contentStart = $tagEndPos + 1;

// End: <div class="recently-viewed-section"> logic from before
$endMarker = '<div class="recently-viewed-section">';
$endMarkerPos = strpos($content, $endMarker);
$lastDiv = strrpos(substr($content, 0, $endMarkerPos), '</div>');
$secondLastDiv = strrpos(substr($content, 0, $lastDiv), '</div>');
$contentEnd = $secondLastDiv;

// 4. Construct the Smart Loop Content
// Note: We escape $interrupterHTML content to be safe in Heredoc
$interrupterHTMLEscaped = addslashes($interrupterHTML); // Only escape quotes? No, Heredoc is fine with HTML usually.
// But we are generating PHP code that contains this HTML string.
// So we should output it directly or assign it. 

$newContent = <<<PHP
<?php 
// Interrupter HTML Block
\$interrupterHTML = <<<HTML
{$interrupterHTML}
HTML;
?>

<?php if (empty(\$products)): ?>
    <div class="col-12">
        <p class="text-center">Bu kategoride henüz ürün bulunmamaktadır.</p>
    </div>
<?php else: ?>
    <?php 
    \$interrupterShown = false;
    \$totalProducts = count(\$products);
    
    foreach (\$products as \$index => \$product): 
        // Logic: Show Interrupter BEFORE the 3rd item (index 2)
        // OR if total < 2 and we are at the end? 
        // User said: "1 veya 2 adet ürün var ise... yerine ... yansıt".
        // If we have <= 2 items, we just show them. The interrupter was visually the 3rd block.
        // So if we have 1 item, we show Item 1, then Interrupter?
        // Let's stick to the rule: "solunda yer alan 2 adet ürün" (2 products to the left of interrupter).
        // So visually: P1, P2, Interrupter, P3...
        // So we yield Interrupter after P2 (index 1 is finished) or before P3 (index 2).
        
        if (\$index == 2) { 
            echo \$interrupterHTML; 
            \$interrupterShown = true;
        }
    ?>
    <div class="product-grid-item col-6 col-lg-4 pb-4">
        <div class="product" data-pid="<?= \$product['id'] ?>" data-available="true">
            <div class="product-tile product-detail js-product-tile" data-pid="<?= \$product['id'] ?>">
                <div class="tile-container">
                    <div class="image-container">
                         <?php if (!empty(\$product['price']) && \$product['price'] < 20): ?>
                            <!-- <div class="bestseller-tag">New</div> -->
                         <?php endif; ?>
                        
                         <a class="wishlistTile js-wishlist-container addProductWishlist" href="#" title="Wishlist" data-pid="<?= \$product['id'] ?>">
                            <span class="fa-stack fa-lg wishlist-product-heart" data-pid="<?= \$product['id'] ?>">
                                <i class="fa fa-circle fa-inverse fa-stack-2x"></i>
                                <i class="fa icon-heart fa-stack-1x"></i>
                            </span>
                        </a>

                        <a class="product-link" href="<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars(\$product['slug']) ?>">
                            <picture>
                                <img class="tile-image lazy" src="<?= BASE_URL ?>/assets/images/products/<?= htmlspecialchars(\$product['image']) ?>" alt="<?= htmlspecialchars(\$product['name']) ?>" title="<?= htmlspecialchars(\$product['name']) ?>" style="width: 100%; height: auto;">
                            </picture>
                        </a>

                        <button class="quickview js-quickview hidden-md-down btn btn-primary btn-block" 
                            data-toggle="modal" data-target="#quickViewModal" title="Quick View">
                            <span class="quickview-btn-icon"></span>
                            <span class="quickview-btn">Hızlı Bakış</span>
                        </button>
                    </div>

                    <div class="tile-body">
                         <div class="am-pm"></div>
                        <h2 class="pdp-link">
                            <a class="link product-link" href="<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars(\$product['slug']) ?>">
                                <?= htmlspecialchars(\$product['name']) ?>
                            </a>
                        </h2>
                    </div>

                    <div class="tile-body-footer">
                        <div class="ratings"></div>
                        <h3 class="title-descriptor">
                            <div class="title-descriptor-value"><?= htmlspecialchars(\$product['volume'] ?? '') ?></div>
                        </h3>
                    </div>
                </div>

                <div class="js-product-add-to-basket">
                    <div class="attributes product_tile-attributes js-product_tile_attributes">
                        <div class="product_price_and_size">
                            <div class="size_wrap">
                                 <div class="d-block d-md-none">
                                    <select class="js-attribute-value_link size">
                                        <option value=""><?= htmlspecialchars(\$product['volume'] ?? 'Standard') ?></option>
                                    </select>
                                </div>
                                <div class="d-none d-md-block">
                                    <div class="attribute-values product_tile-attributes_value product-variation">
                                        <div class="attribute-value-container">
                                            <button class="js-attribute-value_link attribute-value_link item product_tile-attributes_link size selected selectable">
                                                <span class="size-value swatch-rectangle swatch-value selected selectable">
                                                    <?= htmlspecialchars(\$product['volume'] ?? 'Standard') ?>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="prices">
                                <div class="price">
                                    <span class="product-prices">
                                        <span class="sales">
                                            <span class="value">
                                                $<?= htmlspecialchars(\$product['price']) ?> USD
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="adding_to_cart">
                            <div class="adding_to_cart-inner">
                                <div class="add_to_cart_footer js-add_to_cart_footer">
                                    <button class="btn btn-block js-tile-add-to-cart-btn js-back-in-stock" data-available="true" data-pid="<?= \$product['id'] ?>">
                                        <span class="sr-only label-addtocart">Add to Cart</span>
                                        <span class="label-outofstock position-relative d-none">Out of Stock</span>
                                         <span class="label-addtocart">Add to Cart</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="js-product-error-msg"></div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php 
        // If interrupter wasn't shown (e.g. less than 3 products), show it now at the end
        if (!\$interrupterShown) {
             echo \$interrupterHTML;
        }
    ?>
<?php endif; ?>
<!-- Grid Footer -->
<div class="col-12 grid-footer js-grid-footer">
     <input type="hidden" class="permalink" value="<?= BASE_URL ?>/category.php?slug=<?= htmlspecialchars(\$slug) ?>">
     <input type="hidden" class="category-id" value="<?= htmlspecialchars(\$category['slug']) ?>">
</div>
PHP;

$newFileContent = substr_replace($content, $newContent, $contentStart, $contentEnd - $contentStart);

// Write to category.php
if (file_put_contents($file, $newFileContent)) {
    echo "Successfully updated category.php (v3) with smart grid logic.";
} else {
    echo "Failed to update category.php";
}
?>