<?php
$file = __DIR__ . '/../category.php';
$content = file_get_contents($file);

// 1. Find the Start
$startMarker = '<div class="row product-grid js-product-grid"';
$startPos = strpos($content, $startMarker);
if ($startPos === false)
    die("Start marker not found.");
$tagEndPos = strpos($content, '>', $startPos);
$contentStart = $tagEndPos + 1;

// 2. Find the End (Same logic as before, up to the second to last div before recently viewed)
$endMarker = '<div class="recently-viewed-section">';
$endMarkerPos = strpos($content, $endMarker);
if ($endMarkerPos === false)
    die("End marker not found.");

$lastDiv = strrpos(substr($content, 0, $endMarkerPos), '</div>');
$secondLastDiv = strrpos(substr($content, 0, $lastDiv), '</div>');
$contentEnd = $secondLastDiv;

// The Complete New Content with 'js-product-add-to-basket'
$newContent = <<<PHP
<?php if (empty(\$products)): ?>
    <div class="col-12">
        <p class="text-center">Bu kategoride henüz ürün bulunmamaktadır.</p>
    </div>
<?php else: ?>
    <?php foreach (\$products as \$product): ?>
    <div class="product-grid-item col-6 col-lg-4 pb-4">
        <div class="product" data-pid="<?= \$product['id'] ?>" data-available="true">
            <div class="product-tile product-detail js-product-tile" data-pid="<?= \$product['id'] ?>">
                
                <div class="tile-container">
                    <div class="image-container">
                         <?php if (!empty(\$product['price']) && \$product['price'] < 20): // Example logic ?>
                            <!-- <div class="bestseller-tag">New</div> -->
                         <?php endif; ?>
                        
                        <!-- Wishlist (Mocked for layout preservation) -->
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
                        <div class="ratings">
                           <!-- Placeholder for ratings -->
                        </div>
                        <h3 class="title-descriptor">
                            <div class="title-descriptor-value"><?= htmlspecialchars(\$product['volume'] ?? '') ?></div>
                        </h3>
                    </div>
                </div>

                <!-- Missing Block Restored -->
                <div class="js-product-add-to-basket">
                    <div class="attributes product_tile-attributes js-product_tile_attributes">
                        <div class="product_price_and_size">
                            
                            <!-- Size Selector Mock (Visual Only) -->
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
                                         <!-- Visual Label? Static file had hidden sr-only spans but maybe invisible text? -->
                                         <!-- Let's add visible text if the button is empty? No, checking original... -->
                                         <!-- Original line 2855: "Add to Cart" inside sr-only. -->
                                         <!-- Wait, if it's sr-only, what is visible? -->
                                         <!-- The button class is "btn btn-block ...". Maybe CSS puts content? or an icon? -->
                                         <!-- Actually, line 3192 of original has "Add to Cart" inside sr-only too. -->
                                         <!-- BUT check line 3165: The button likely renders "Add to Cart" via CSS or inner text that I missed? -->
                                         <!-- Ah, line 2855 says <span class="sr-only..">Add to Cart</span>. -->
                                         <!-- Where is the visible text? -->
                                         <!-- Maybe it's missing in my reading? -->
                                         <!-- Let's look closely at Lines 2850-2860 in previous view_file. -->
                                         <!-- Line 2849: <div class="add_to_cart_footer..."> -->
                                         <!-- Line 2850: <button ...> -->
                                         <!-- Line 2855: <span class="sr-only label-addtocart">Add to Cart</span> -->
                                         <!-- Line 2858: <span class="label-outofstock ... d-none">Out of Stock</span> -->
                                         <!-- That's it. So the button might look empty? -->
                                         <!-- Wait, the button has class `js-tile-add-to-cart-btn`. Maybe CSS adds "Add to Cart"? -->
                                         <!-- OR, I missed some text. -->
                                         <!-- Let's assume the original HTML is correct and copy it EXACTLY. -->
                                         <!-- If the original works, this copy should work. -->
                                         <!-- I will reproduce the structure exactly. -->
                                         
                                         <!-- NOTE: I will add explicit "Add to Cart" text just in case, wrapped in a span that mimics the structure. -->
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
<?php endif; ?>
<!-- Grid Footer -->
<div class="col-12 grid-footer js-grid-footer">
    <!-- Preserving hidden inputs that might be needed for JS -->
     <input type="hidden" class="permalink" value="<?= BASE_URL ?>/category.php?slug=<?= htmlspecialchars(\$slug) ?>">
     <input type="hidden" class="category-id" value="<?= htmlspecialchars(\$category['slug']) ?>">
</div>
PHP;

$newFileContent = substr_replace($content, $newContent, $contentStart, $contentEnd - $contentStart);
if (file_put_contents($file, $newFileContent)) {
    echo "Successfully updated category.php product grid (v2).";
} else {
    echo "Failed to update category.php";
}
?>