<?php
$file = __DIR__ . '/../category.php';
$baseFile = __DIR__ . '/../ciltbakim/original-leke-karsiti-aydinlatici-serum.php';

if (!file_exists($baseFile))
    die("Original base file not found.");
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

\$pStmt = \$pdo->prepare("SELECT p.* FROM products p JOIN product_categories pc ON p.id = pc.product_id WHERE pc.category_id = ? ORDER BY p.id DESC");
\$pStmt->execute([\$category['id']]);
\$products = \$pStmt->fetchAll(PDO::FETCH_ASSOC);
?>
PHP;

$content = preg_replace('/<\?php require_once.*?page_content_helper\.php\'; \?>/s', $headerPHP, $content, 1);
$content = str_replace("<?php include dirname(__DIR__) . '/config.php'; ?>", "", $content);

// 2. Extract Interrupter (Same as v3)
$interrupterStart = strpos($content, '<div class="grid-interrupter-tile"');
$interrupterEnd = strpos($content, '<!-- CQuotient Activity Tracking', $interrupterStart);
$interrupterEnd = strrpos(substr($content, 0, $interrupterEnd), '</div>') + 6;
$interrupterHTML = substr($content, $interrupterStart, $interrupterEnd - $interrupterStart);


// 3. Define the Grid Loop Replacement (v4 - STRICT)
// We need to exactly mimic the HTML structure of the original item.
// Let's grab a sample item from the passed content? 
// The first item starts at line ~2586 in original.
// It has `div class="product-grid-item ..."`
// Let's use the exact structure we saw in `view_file` for original lines 2729-2875.

// Markers for Grid
$startMarker = '<div class="row product-grid js-product-grid"';
$startPos = strpos($content, $startMarker);
$tagEndPos = strpos($content, '>', $startPos);
$contentStart = $tagEndPos + 1;
$endMarker = '<div class="recently-viewed-section">';
$endMarkerPos = strpos($content, $endMarker);
$lastDiv = strrpos(substr($content, 0, $endMarkerPos), '</div>');
$secondLastDiv = strrpos(substr($content, 0, $lastDiv), '</div>');
$contentEnd = $secondLastDiv;

$newContent = <<<PHP
<?php 
\$interrupterHTML = <<<HTML
{$interrupterHTML}
HTML;
?>

<?php if (empty(\$products)): ?>
    <div class="col-12"><p class="text-center">Bu kategoride henüz ürün bulunmamaktadır.</p></div>
<?php else: ?>
    <?php 
    \$interrupterShown = false;
    foreach (\$products as \$index => \$product): 
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
                        
                        <a class="wishlistTile js-wishlist-container addProductWishlist" href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Wishlist-AddProduct.json" title="Wishlist" data-pid="<?= \$product['id'] ?>">
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
                            data-url="#"
                            data-toggle="modal" data-target="#quickViewModal" 
                            title="Quick View for <?= htmlspecialchars(\$product['name']) ?>"
                            aria-label="Quick View for <?= htmlspecialchars(\$product['name']) ?>">
                            <span class="quickview-btn-icon"></span>
                            <span class="quickview-btn">Hızlı Bakış</span>
                        </button>
                    </div>

                    <div class="tile-body">
                         <div class="am-pm"><span class="icon-am"></span><span class="icon-pm"></span></div>
                        <h2 class="pdp-link">
                            <a class="link product-link" href="<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars(\$product['slug']) ?>">
                                <?= htmlspecialchars(\$product['name']) ?>
                            </a>
                        </h2>
                    </div>

                    <div class="tile-body-footer">
                        <div class="ratings">
                           <div class="bazaar-container">
                                <a class="bazaar-link" href="#"></a>
                                <div data-bv-show="inline_rating" data-bv-productid="<?= \$product['id'] ?>" data-bv-seo="false"></div>
                           </div>
                        </div>
                        <h3 class="title-descriptor">
                            <div class="title-descriptor-value"><?= htmlspecialchars(\$product['volume'] ?? '') ?></div>
                        </h3>
                    </div>
                </div>

                <!-- STRICT ORIGINAL STRUCTURE RESTORED -->
                <div class="js-product-add-to-basket">
                     <div class="attributes product_tile-attributes js-product_tile_attributes ">
                        <div class="product_price_and_size">
                            <div class="size_wrap">
                                <div class="d-block d-md-none">
                                    <select class="js-attribute-value_link size">
                                        <option value=""><?= htmlspecialchars(\$product['volume'] ?? 'Standard') ?></option>
                                    </select>
                                </div>
                                <div class="d-none d-md-block">
                                    <div class="attribute-values product_tile-attributes_value product-variation" data-attr="size">
                                        <div class="attribute-value-container ">
                                            <button data-url="#" data-attr-value="std" class="js-attribute-value_link attribute-value_link item product_tile-attributes_link size selected selectable">
                                                <span data-attr-value="std" class="size-value swatch-rectangle swatch-value selected selectable">
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
                                        <span class="sales ">
                                            <span class="value" content="<?= \$product['price'] ?>">
                                                $<?= htmlspecialchars(\$product['price']) ?> USD
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="adding_to_cart">
                            <div class="adding_to_cart-inner">
                                <input type="hidden" class="js-add-to-cart-url" value="/on/demandware.store/Sites-deciem-us-Site/en_US/Cart-AddProduct">
                                <input type="hidden" class="waitlist-plp-label" name="waitlist-plp-label" value="Out of Stock">

                                <div class="add_to_cart_footer js-add_to_cart_footer">
                                    <button class="btn btn-block js-tile-add-to-cart-btn js-back-in-stock " 
                                        data-available="true" 
                                        data-pid="<?= \$product['id'] ?>"
                                        data-stock-notification-url="#">
                                        
                                        <span class="sr-only label-addtocart">Add to Cart</span>
                                        <span class="label-outofstock position-relative d-none">Out of Stock</span>
                                        
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END STRICT STRUCTURE -->

                <div class="js-product-error-msg"></div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php if (!\$interrupterShown) echo \$interrupterHTML; ?>
<?php endif; ?>
<!-- Grid Footer -->
<div class="col-12 grid-footer js-grid-footer">
     <input type="hidden" class="permalink" value="<?= BASE_URL ?>/category.php?slug=<?= htmlspecialchars(\$slug) ?>">
     <input type="hidden" class="category-id" value="<?= htmlspecialchars(\$category['slug']) ?>">
</div>
PHP;

$newFileContent = substr_replace($content, $newContent, $contentStart, $contentEnd - $contentStart);
if (file_put_contents($file, $newFileContent)) {
    echo "Successfully updated category.php (v4) with STRICT product tile structure.";
} else {
    echo "Failed to update category.php";
}
?>