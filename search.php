<?php
require_once __DIR__ . '/admin/includes/db.php';
include __DIR__ . '/config.php';
include __DIR__ . '/includes/wp_shims.php';
require_once __DIR__ . '/includes/banner_helper.php';
require_once __DIR__ . '/includes/page_content_helper.php';

$query = $_GET['q'] ?? '';
$products = [];

if (!empty($query)) {
    // Search in name, summary, and description
    $stmt = $pdo->prepare("
        SELECT * FROM products 
        WHERE status = '1' 
        AND (name LIKE ? OR short_description LIKE ? OR description LIKE ?)
        ORDER BY id DESC
    ");
    $searchTerm = "%{$query}%";
    $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en" data-preferences="" data-contenturl="/on/demandware.store/Sites-deciem-us-Site/en_US/Page-GetContent">

<head>
    <!--[if gt IE 9]><!-->
    <script>//common/scripts.isml</script>
    <script defer="" type="text/javascript"
        src="<?= BASE_URL ?>/assets/js/jquery.min.js"></script>
    <script defer="" type="text/javascript"
        src="<?= BASE_URL ?>/assets/js/vendors.js"></script>
    <script defer="" type="text/javascript"
        src="<?= BASE_URL ?>/assets/js/js_main.js"></script>
    <script defer="" type="text/javascript"
        src="<?= BASE_URL ?>/assets/js/bv.js"></script>

    <!--<![endif]-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Search Results for "<?= htmlspecialchars($query) ?>" | Noc</title>

    <meta name="description" content="Search results for <?= htmlspecialchars($query) ?>">

    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/icons-font.css">
    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/global.css">
    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/productSearch.css">
    <style>
        /* CRITICAL: Matches index.php padding to prevent header overlap */
        @media (min-width: 1024px) {
            div.page {
                padding-top: 140px !important;
                /* Increased slightly to account for extra title space */
            }
        }

        @media (max-width: 1023px) {
            div.page {
                padding-top: 100px !important;
            }
        }

        .theordinary-logo img {
            max-width: 200px;
            height: auto;
        }

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

        /* LAYOUT FIXES */
        .search-results-container,
        .search-results_items-side,
        .product-grid {
            width: 100% !important;
            max-width: 100% !important;
            flex: 0 0 100% !important;
        }
    </style>
</head>

<body data-brand="theordinary">
    <div class="page js-page" data-action="Search-Show" data-querystring="" data-country-redirect="">

        <?php include __DIR__ . '/header.php'; ?>

        <div role="main" id="maincontent">

            <div class="container text-center pt-4 pb-4">
                <h1 style="font-weight: bold; font-size: 2rem;">Şunu arattınız: "<?= htmlspecialchars($query) ?>"</h1>
            </div>

            <main id="main" role="main" class="clearfix">
                <div class="plp-search-section">
                    <div class="result-container-wrapper">
                        <div class="container-fluid pl-5 pr-5">

                            <?php if (empty($products)): ?>
                                <div class="row mb-5">
                                    <div class="col-12 text-center">
                                        <p>No products found matching your search. Please try a different keyword.</p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="row product-grid js-product-grid" itemtype="http://schema.org/SomeProducts"
                                    itemid="#product" data-total-count="<?= count($products) ?>">
                                    <?php if (empty($products)): ?>
                                        <div class="col-12" style="grid-column: 1 / -1;">
                                            <p class="text-center">Ürün bulunamadı.</p>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($products as $index => $product): ?>
                                            <div class="product-grid-item pb-4">
                                                <div class="product" data-pid="<?= $product['id'] ?>" data-available="true">





                                                    <div class="product-tile product-detail js-product-tile js-gtm-product-data js-pid-<?= $product['id'] ?>  "
                                                        data-pid="<?= $product['id'] ?>" data-available="true"
                                                        data-gtm-enhanced-ecommerce="{&quot;id&quot;:&quot;769915234053&quot;,&quot;name&quot;:&quot;Glycolic Acid 7% Exfoliating Toner&quot;,&quot;brand&quot;:&quot;The Ordinary&quot;,&quot;variant&quot;:&quot;100ml &quot;,&quot;price&quot;:&quot;8.70&quot;,&quot;siteID&quot;:&quot;deciem-us&quot;,&quot;localeID&quot;:&quot;en_US&quot;}">
                                                        <!-- dwMarker="product" dwContentID="80fb7f5942f5e73cf80b5a84fa" -->
                                                        <div class="tile-container">












                                                            <input type="hidden" class="wishlist-fill-heart-grid-url"
                                                                id="wishlistUrl-grid"
                                                                value="/on/demandware.store/Sites-deciem-us-Site/en_US/Wishlist-WishlistFillIcon"
                                                                encoding="off">


                                                            <div class="image-container">













                                                                <div class="bestseller-tag">Bestseller</div>






                                                                <div class="plp-award-tag">
                                                                    <img src="<?= (strpos($product['awards_image'], 'http') === 0) ? $product['awards_image'] : BASE_URL . '/assets/uploads/products/' . $product['awards_image'] ?>"
                                                                        title="Women's Health Skincare Awards 2022"
                                                                        alt="Women's Health Skincare Awards 2022 - Best Toner"
                                                                        style="width: 100%; height: auto;">
                                                                </div>






                                                                <a class="wishlistTile js-wishlist-container addProductWishlist"
                                                                    href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Wishlist-AddProduct.json"
                                                                    title="Wishlist" data-pid="<?= $product['id'] ?>">
                                                                    <span class="fa-stack fa-lg wishlist-product-heart"
                                                                        data-pid="<?= $product['id'] ?>">
                                                                        <i class="fa fa-circle fa-inverse fa-stack-2x"></i>
                                                                        <i class="fa icon-heart fa-stack-1x"></i>
                                                                    </span>
                                                                </a>


                                                                <a class="product-link"
                                                                    href="<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars($product['slug']) ?>">
                                                                    <picture>


                                                                        <img class="tile-image lazy"
                                                                            src="<?= (strpos($product['image'], 'http') === 0) ? $product['image'] : BASE_URL . '/assets/images/products/' . $product['image'] ?>"
                                                                            alt="<?= htmlspecialchars($product['name']) ?>"
                                                                            title="<?= htmlspecialchars($product['name']) ?>">
                                                                    </picture>
                                                                </a>



                                                                <button
                                                                    class="quickview js-quickview hidden-md-down btn btn-primary btn-block"
                                                                    data-url="/on/demandware.store/Sites-deciem-us-Site/en_US/Product-ShowQuickView?pid=769915234053"
                                                                    data-toggle="modal" data-target="#quickViewModal"
                                                                    title="Quick View for Glycolic Acid 7% Exfoliating Toner"
                                                                    aria-label="Quick View for Glycolic Acid 7% Exfoliating Toner">
                                                                    <span class="quickview-btn-icon"></span>

                                                                    <span class="quickview-btn">
                                                                        Quick view
                                                                    </span>
                                                                </button>

                                                            </div>




                                                            <div class="tile-body">

                                                                <div class="am-pm">



                                                                    <span class="icon-pm"></span>


                                                                </div>


                                                                <h2 class="pdp-link">
                                                                    <a class="link product-link"
                                                                        href="<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars($product['slug']) ?>"><?= htmlspecialchars($product['name']) ?></a>
                                                                </h2>


                                                            </div>
                                                            <div class="tile-body-footer">

                                                                <div class="ratings">







                                                                    <div class="bazaar-container">
                                                                        <a class="bazaar-link"
                                                                            href="<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars($product['slug']) ?>#bazaar-rating"></a>
                                                                        <div data-bv-show="inline_rating" data-bv-productid="100418"
                                                                            data-bv-redirect-url="/en-us/glycolic-acid-7-exfoliating-toner-100418"
                                                                            data-bv-seo="false"></div>
                                                                    </div>






                                                                </div>
                                                                <h3 class="title-descriptor">

                                                                    <div class="title-descriptor-value">Evens Texture &amp; Tone,
                                                                        Radiance</div>

                                                                </h3>
                                                            </div>
                                                        </div>






                                                        <div class="js-product-add-to-basket">



                                                            <div
                                                                class="attributes product_tile-attributes js-product_tile_attributes ">








                                                                <div class="product_price_and_size">

                                                                    <div class="size_wrap">

                                                                        <div class="d-block d-md-none">
                                                                            <select class="js-attribute-value_link size">


                                                                                <option
                                                                                    value="https://theordinary.com/on/demandware.store/Sites-deciem-us-Site/en_US/Product-Variation?dwvar_100418_size=&amp;pid=100418&amp;quantity=1">
                                                                                    100ml
                                                                                </option>



                                                                                <option
                                                                                    value="https://theordinary.com/on/demandware.store/Sites-deciem-us-Site/en_US/Product-Variation?dwvar_100418_size=int240ml&amp;pid=100418&amp;quantity=1">
                                                                                    240ml
                                                                                </option>


                                                                            </select>
                                                                        </div>
                                                                        <div class="d-none d-md-block">

                                                                            <div class="attribute-values product_tile-attributes_value product-variation"
                                                                                data-attr="size">




                                                                                <div class="attribute-value-container ">
                                                                                    <button
                                                                                        data-url="https://theordinary.com/on/demandware.store/Sites-deciem-us-Site/en_US/Product-Variation?dwvar_100418_size=&amp;pid=100418&amp;quantity=1"
                                                                                        data-attr-value="int100ml" class="js-attribute-value_link attribute-value_link item product_tile-attributes_link
                    size
                    selected
                    selectable">
                                                                                        <span data-attr-value="int100ml" class="
                            size-value
                            swatch-rectangle
                            swatch-value
                            2.0
                            selected
                            selectable
                            ">
                                                                                            100ml
                                                                                        </span>


                                                                                    </button>
                                                                                </div>





                                                                                <div class="attribute-value-container ">
                                                                                    <button
                                                                                        data-url="https://theordinary.com/on/demandware.store/Sites-deciem-us-Site/en_US/Product-Variation?dwvar_100418_size=int240ml&amp;pid=100418&amp;quantity=1"
                                                                                        data-attr-value="int240ml" class="js-attribute-value_link attribute-value_link item product_tile-attributes_link
                    size
                    
                    selectable">
                                                                                        <span data-attr-value="int240ml" class="
                            size-value
                            swatch-rectangle
                            swatch-value
                            2.0
                            
                            selectable
                            ">
                                                                                            240ml
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



                                                                                    <span class="value"
                                                                                        content="<?= htmlspecialchars($product['price']) ?>">

                                                                                        $<?= htmlspecialchars($product['price']) ?>
                                                                                        USD


                                                                                    </span>
                                                                                </span>
                                                                            </span>

                                                                        </div>



                                                                    </div>



                                                                </div>









                                                                <div class="adding_to_cart">
                                                                    <div class="adding_to_cart-inner">

                                                                        <input type="hidden" class="js-add-to-cart-url"
                                                                            value="/on/demandware.store/Sites-deciem-us-Site/en_US/Cart-AddProduct">
                                                                        <input type="hidden" class="waitlist-plp-label"
                                                                            name="waitlist-plp-label" value="Out of Stock">

                                                                        <div class="add_to_cart_footer js-add_to_cart_footer">
                                                                            <button
                                                                                class="btn btn-block js-tile-add-to-cart-btn js-back-in-stock "
                                                                                data-available="true"
                                                                                data-pid="<?= $product['id'] ?>"
                                                                                data-stock-notification-url="/on/demandware.store/Sites-deciem-us-Site/en_US/StockNotification-Show?pid=769915234053">


                                                                                <span class="sr-only label-addtocart">Add to
                                                                                    Cart</span>

                                                                                <span
                                                                                    class="label-outofstock position-relative d-none">Out
                                                                                    of Stock</span>

                                                                            </button>
                                                                        </div>


                                                                    </div>
                                                                </div>







                                                            </div>






                                                        </div>






                                                        <!-- END_dwmarker -->
                                                        <div class="js-product-error-msg"></div>
                                                    </div>



                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <!-- Grid Footer -->
                                    <div class="col-12 d-none">
                                        <input type="hidden" class="permalink"
                                            value="<?= BASE_URL ?>/category.php?slug=<?= htmlspecialchars($slug) ?>">
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </main>
        </div>

        <?php include __DIR__ . '/footer.php'; ?>
    </div>
</body>

</html>