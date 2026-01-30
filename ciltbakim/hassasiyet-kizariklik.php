<?php
require_once __DIR__ . '/../admin/includes/db.php';
include __DIR__ . '/../config.php';
include __DIR__ . '/../includes/wp_shims.php';
require_once __DIR__ . '/../includes/banner_helper.php';
require_once __DIR__ . '/../includes/page_content_helper.php';

$slug = 'hassasiyet-kizariklik-karsiti-bakim';
$stmt = $pdo->prepare("SELECT * FROM categories WHERE slug = ?");
$stmt->execute([$slug]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    $category = ['id' => 13, 'slug' => $slug];
}

$pStmt = $pdo->prepare("SELECT p.* FROM products p JOIN product_categories pc ON p.id = pc.product_id WHERE pc.category_id = ? ORDER BY p.id DESC");
$pStmt->execute([$category['id']]);
$products = $pStmt->fetchAll(PDO::FETCH_ASSOC);

// Dynamic Grid Logic based on Users Design
// 1 Product -> repeat(3, 1fr) (Product 1fr, Content 2fr)
// 2+ Products -> repeat(4, 1fr) (Product 1fr, Product 1fr, Content 2fr)
$gridTemplateColumns = (count($products) == 1) ? 'repeat(3, 1fr)' : 'repeat(4, 1fr)';

// Fetch Page Sections
$pageIdentifier = 'hassasiyet-kizariklik-karsiti-bakim';
$pageSections = getPageContentBlocks($pdo, $pageIdentifier);
?>
<!-- Inject CSS for Banner Width and Hiding Elements -->
<style>
    /* Hide specific elements as requested */
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

    /* LAYOUT FIXES - CSS GRID IMPLEMENTATION */
    /* Force main grid container to be full width */
    .search-results_items-side {
        width: 100% !important;
        max-width: 100% !important;
        flex: 0 0 100% !important;
        padding: 0 !important;
    }

    /* Dynamic Grid Layout */
    [data-brand=theordinary] .product-grid {
        display: grid !important;
        grid-template-columns:
            <?= $gridTemplateColumns ?>
            !important;
        gap: 15px;
    }

    /* Ensure Interrupter spans 2 columns to satisfy 2/3 or 2/4 ratio implication */
    .grid-interrupter-tile {
        grid-column: span 2;
        min-width: 100%;
        display: flex;
        flex-direction: column;
    }

    /* Ensure Product Tiles fit */
    .product-grid-item {
        width: 100%;
        padding-left: 0;
        padding-right: 0;
    }
</style>
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
        src="<?= BASE_URL ?>/assets/js/search.js">
        </script>

    <script defer="" type="text/javascript"
        src="<?= BASE_URL ?>/assets/js/accordion.js">
        </script>

    <script defer="" type="text/javascript" src="<?= BASE_URL ?>/assets/js/bv.js">
    </script>






    <script type="text/javascript" src="<?= BASE_URL ?>/assets/js/main.js"></script>
    <script type="text/javascript">
        window.OrdergrooveTrackingUrl = "/on/demandware.store/Sites-deciem-us-Site/en_US/OrderGroove-PurchasePostTracking"
    </script>

    <script type="text/javascript">
        window.OrdergrooveLegacyOffers = false
    </script>




    <script type="text/javascript">
        window.SFRA = window.SFRA || {};
        window.SFRA.Constants = {};
        window.SFRA.Resources = { "regimentBeginButton": "Let's Begin", "regimentNextButton": "Next", "regimentBuilderText": "Regimen Builder", "regimenBuilderRecommendation": "Recommended for you based on your answers.", "commonFieldError": "This field is required.", "productShadeLabel": "Shade:", "viewMoreLabel": "View More", "viewLessLabel": "View Less", "giftcardDatePlaceHolder": "mm/dd/yyyy", "undoWishlistAction": "Undo", "regimentSaveResults": "Results saved", "regimentSavedResults": "Regimen Builder Results", "giftCardLabel": "Gift Card", "modelGuideAddedToCart": "✓ Added to Cart", "addToCartText": "Add to Cart", "modelGuidePregnancyText": "<p>While each ingredient has been tested and is considered safe for topical application, The Ordinary products have not been tested on people who are pregnant or breastfeeding. When pregnant or breastfeeding, it is recommended to avoid any skincare products with certain ingredients.</p><p>For extra care and support, if you're pregnant or breastfeeding, we recommend talking to your doctor or health care practitioner before starting any new skincare products and/or ingredients.</p>", "productConflict": "Avoid Using Together", "productConflictMsg": "These products should not be used together due to conflicting ingredients.", "productCaution": "Use Together With Caution", "productCautionMsg": "These products can be used together, but not in the same routine.", "productSafe": "Safe to Use Together", "productSafeMsg": "These formulations do not contain conflicting ingredients. You can layer them in the same skincare regimen. We recommend a patch test before adding a new product to your routine.", "buttonBackToCart": "Back to Cart", "buttonSelect": "Select", "buttonRemove": "Remove" };
        window.SFRA.Urls = { "wishlistAddProduct": "/on/demandware.store/Sites-deciem-us-Site/en_US/Wishlist-AddProduct", "wishlistRemoveProduct": "/on/demandware.store/Sites-deciem-us-Site/en_US/Wishlist-RemoveProduct", "accountShow": "/en-us/account", "wishlistShow": "/en-us/favourites", "regimenGetResults": "/on/demandware.store/Sites-deciem-us-Site/en_US/Regimen-GetRegimenDetails?cid=regimen-builder", "getProductInfo": "/on/demandware.store/Sites-deciem-us-Site/en_US/Product-GetProductInfo", "tileShow": "/on/demandware.store/Sites-deciem-us-Site/en_US/Tile-Show", "productShow": "/on/demandware.store/Sites-deciem-us-Site/en_US/Product-Show" };
        window.SFRA.SitePreferences = { "MODEL_GUIDE_API_URL": "https://model-guide-awbshzbmbag0gzbc.eastus-01.azurewebsites.net//api/v2/Chat/pdp-chat?", "BLACK_FRIDAY_ENABLED": false, "BLACK_FRIDAY_EXCLUDED_COUNTRIES": { "0": "JP", "1": "KR", "2": "HK" } };
    </script>


    <!--<![endif]-->
    <meta charset="UTF-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">


    <title>
        Hassasiyet & Kızarıklık Karşıtı Bakım | Noc
    </title>

    <meta name="description"
        content="The Ordinary's vegan facial cleansers are a great addition to your AM and PM skincare routine. Shop by specific skin concerns and active ingredients.">
    <meta name="keywords" content="face cleanser, gentle face cleanser, face cleanser for acne">







    <meta property="og:image"
        content="https://theordinary.com/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw665025d6/theordinary/homepage/slotA/heroes-slot-a-mobile.jpg">
    <meta property="og:title" content="The Ordinary | Clinical Formulations with Integrity">
    <meta property="og:description"
        content="The Ordinary is your destination for Skincare, Makeup, Hair, and Body solutions. Discover clinical formulations with integrity.">











    <link rel="preconnect" href="https://www.googletagmanager.com">

    <link rel="preconnect" href="<?= BASE_URL ?>/index.htm">

    <link rel="preconnect" href="https://www.gstatic.com">

    <link rel="preconnect" href="<?= BASE_URL ?>/about/analytics/index.htm">

    <link rel="preconnect" href="<?= BASE_URL ?>/index-1.htm">

    <link rel="preconnect" href="<?= BASE_URL ?>/index.htm.json">

    <link rel="preconnect" href="<?= BASE_URL ?>/index.htm-1.json">

    <link rel="preconnect" href="<?= BASE_URL ?>/index.htm-2.json">

    <link rel="preconnect" href="<?= BASE_URL ?>/index-2.htm">

    <link rel="preconnect" href="https://network.bazaarvoice.com">




    <link rel="dns-prefetch" href="https://www.googletagmanager.com">

    <link rel="dns-prefetch" href="<?= BASE_URL ?>/index.htm">

    <link rel="dns-prefetch" href="https://www.gstatic.com">

    <link rel="dns-prefetch" href="<?= BASE_URL ?>/about/analytics/index.htm">

    <link rel="dns-prefetch" href="<?= BASE_URL ?>/index-1.htm">

    <link rel="dns-prefetch" href="<?= BASE_URL ?>/index.htm.json">

    <link rel="dns-prefetch" href="<?= BASE_URL ?>/index.htm-1.json">

    <link rel="dns-prefetch" href="<?= BASE_URL ?>/index.htm-2.json">

    <link rel="dns-prefetch" href="<?= BASE_URL ?>/index-2.htm">

    <link rel="dns-prefetch" href="https://network.bazaarvoice.com">






    <!-- Favicon for ICO file format -->
    <link rel="icon"
        href="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dw111bf775/images/favicons/favicon-theordinary.ico"
        type="image/x-icon">

    <!-- Favicon for PNG file format -->
    <link rel="icon"
        href="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dw9d699b3f/images/favicons/favicon-theordinary.png"
        type="image/png">

    <!-- Apple Touch Icon (iOS Devices) -->
    <link rel="apple-touch-icon"
        href="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dw58e5b677/images/favicons/favicon-theordinary-apple-touch-icon.png">

    <!-- For different sizes and devices, you can specify multiple favicons -->
    <link rel="icon" sizes="32x32"
        href="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dwdf569b1d/images/favicons/favicon-theordinary-32x32.png">
    <link rel="icon" sizes="16x16"
        href="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dw99ff95b6/images/favicons/favicon-theordinary-16x16.png">

    <!-- Favicon for Safari Pinned Tab -->
    <link rel="mask-icon"
        href="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dwabed6e93/images/favicons/favicon-theordinary.svg"
        color="#000000">



    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/bootstrap.css">


    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/icons-font.css">


    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/global.css">



    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/productSearch.css">









    <link rel="canonical" href="facial-cleansers">






    <script src="<?= BASE_URL ?>/assets/js/widget.js" defer=""></script>


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
</style></head>

<body data-brand="theordinary">

    <div class="page js-page" data-action="Search-Show" data-querystring="cgid=theordinary-facialcleansers"
        data-country-redirect="">
        <div class="modal product giftcard-product" id="editGiftCardModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="icon-close close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <h5 class="modal-title">Your gift card details</h5>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>


        <?php include BASE_PATH . '/header.php'; ?>


        <div role="main" id="maincontent">









            <div class="add-to-wishlist-messages"></div>





            <div class="plp_breadcrumb_panel d-sm-block">


                <ol class="breadcrumb">



                    <li class="breadcrumb-item icon-right_chevron">

                        <a href="<?= BASE_URL ?>/the-ordinary/skincare/shop-by-step">İhtiyacına Göre Alışveriş Yapın</a>

                    </li>



                    <li class="breadcrumb-item ">

                        <span class="breadcrumb--current js-last-breadcrumbs">Hassasiyet & Kızarıklık Karşıtı Bakım</span>

                    </li>


                </ol>


            </div>


            <div class="plp-search-section">

                <div class="plp_promotions_slot">




































































































                    <?php render_banner($pdo, 'ciltbakim-hassasiyet-kizariklik'); ?>



































                </div>


                <div class="search-results_items-side tab-content plp-search-products">
                    <div class="search-results_tab-pane" id="product-search-results" role="list"
                        aria-labelledby="pagePlpTitle">

                        <div class="col-12 p-0 tab-pane active product-tab-pane">







                            <div class="filter-sort-container ">
                                <div class="filter-sort">
                                    <button type="button" class="filter-results btn-link js-filter-results filter-btn">
                                        Filters
                                        <span class="js-all-selected-filters-count"></span>
                                        <span class="icon-down_chevron"></span>
                                    </button>

                                    <button type="button"
                                        class="filter-sort-by btn-link js-filter-sort-button filter-btn">
                                        <span class="filter-sort-by--text js-filter-sort-by-text">
                                            Sort by
                                        </span>
                                        <span class="icon-down_chevron"></span>
                                    </button>

                                    <div class="sort-by-bar js-filter-sort-bar sort-body d-none">


                                        <div class="filter-header d-lg-none">
                                            <button type="reset" name="close-filter"
                                                class="btn-sort-by-close sort-close-icon icon-close d-lg-none"
                                                aria-label="Close filters menu">
                                            </button>
                                            <div class="header-bar-sort clearfix">
                                                <div class="result-count">
                                                    <span>
                                                        Sort by
                                                    </span>
                                                </div>
                                            </div>
                                        </div>


                                        <ul class="sort-order" aria-label="Sort By">

                                            <li class="sort-order-list">
                                                <a class="sort-order-link top-sellers  p-4 p-lg-0" data-id="top-sellers"
                                                    href="https://theordinary.com/on/demandware.store/Sites-deciem-us-Site/en_US/Search-UpdateGrid?cgid=theordinary-facialcleansers&prefn1=availableCountries&prefv1=US&srule=top-sellers&start=0&sz=3">
                                                    <i class="sort-order-link-icon"></i>
                                                    Bestsellers
                                                </a>
                                            </li>

                                            <li class="sort-order-list">
                                                <a class="sort-order-link best-matches  p-4 p-lg-0"
                                                    data-id="best-matches"
                                                    href="https://theordinary.com/on/demandware.store/Sites-deciem-us-Site/en_US/Search-UpdateGrid?cgid=theordinary-facialcleansers&prefn1=availableCountries&prefv1=US&srule=best-matches&start=0&sz=3">
                                                    <i class="sort-order-link-icon"></i>
                                                    Best Matches
                                                </a>
                                            </li>

                                            <li class="sort-order-list">
                                                <a class="sort-order-link price-low-to-high  p-4 p-lg-0"
                                                    data-id="price-low-to-high"
                                                    href="https://theordinary.com/on/demandware.store/Sites-deciem-us-Site/en_US/Search-UpdateGrid?cgid=theordinary-facialcleansers&prefn1=availableCountries&prefv1=US&srule=price-low-to-high&start=0&sz=3">
                                                    <i class="sort-order-link-icon"></i>
                                                    Rank by lowest price
                                                </a>
                                            </li>

                                            <li class="sort-order-list">
                                                <a class="sort-order-link price-high-to-low  p-4 p-lg-0"
                                                    data-id="price-high-to-low"
                                                    href="https://theordinary.com/on/demandware.store/Sites-deciem-us-Site/en_US/Search-UpdateGrid?cgid=theordinary-facialcleansers&prefn1=availableCountries&prefv1=US&srule=price-high-to-low&start=0&sz=3">
                                                    <i class="sort-order-link-icon"></i>
                                                    Rank by highest price
                                                </a>
                                            </li>

                                            <li class="sort-order-list">
                                                <a class="sort-order-link rating  p-4 p-lg-0" data-id="rating"
                                                    href="https://theordinary.com/on/demandware.store/Sites-deciem-us-Site/en_US/Search-UpdateGrid?cgid=theordinary-facialcleansers&prefn1=availableCountries&prefv1=US&srule=rating&start=0&sz=3">
                                                    <i class="sort-order-link-icon"></i>
                                                    Rating
                                                </a>
                                            </li>

                                        </ul>


                                        <div class="d-lg-none filter-footer">
                                            <button class="btn btn-primary btn-sort-by-close">
                                                <span>Apply</span>
                                            </button>
                                        </div>

                                    </div>


                                    <div class="refinement-bar d-none js-refinement-bar js-category-refinement-bar">
                                        <div class="filter-header d-lg-none">
                                            <button type="reset" name="close-filter"
                                                class="btn-filter-close btn-close-search filter-close-icon icon-close d-lg-none"
                                                aria-label="Close filters menu">
                                            </button>

                                            <div class="header-bar">
                                                <div class="result-count">
                                                    <span>
                                                        Filters
                                                        <span class="js-all-selected-filters-count"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="filter-bar mobile-filter-bar d-lg-none">


                                        </div>

                                        <div class="d-lg-none filter-footer js-filter-footer">

                                            <button class="btn btn-primary btn-filter-close">

                                                <span>Close Filters</span>

                                            </button>
                                        </div>

                                        <div class="refinements plp-search-refinements">




                                            <div class="refinement refinement-active-ingredient plp-search-refinement"
                                                data-id="active-ingredient">
                                                <div class="refinement-group-header">
                                                    <a class="title d-lg-none" data-toggle="collapse"
                                                        href="#active-ingredient" role="button" aria-expanded="true"
                                                        aria-controls="active-ingredient">
                                                        <span>Active Ingredient</span>
                                                    </a>
                                                    <span class="title d-none d-lg-block">Active Ingredient</span>
                                                </div>


                                                <div class="refinement-group-body category-refinement-group-body collapse  active show"
                                                    id="active-ingredient">









                                                    <ul class="values content list-group ">









                                                        <li class="list-group-item p-0 ">
                                                            <button
                                                                data-href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Search-ShowAjax?cgid=theordinary-facialcleansers&amp;prefn1=activeIngredient&amp;prefv1=Hydrators&amp;prefn2=availableCountries&amp;prefv2=US&amp;productRefineBar=true"
                                                                class="px-lg-0 filters_item
        ">

                                                                <i class="filters_item-icon"></i>


                                                                <span class="" aria-hidden="true">
                                                                    Hydrators
                                                                </span>

                                                                <span class="sr-only selected-assistive-text">

                                                                    Refine by Active Ingredient: Hydrators
                                                                </span>
                                                            </button>
                                                        </li>











                                                        <li class="list-group-item p-0 ">
                                                            <button
                                                                data-href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Search-ShowAjax?cgid=theordinary-facialcleansers&amp;prefn1=activeIngredient&amp;prefv1=Squalane&amp;prefn2=availableCountries&amp;prefv2=US&amp;productRefineBar=true"
                                                                class="px-lg-0 filters_item
        ">

                                                                <i class="filters_item-icon"></i>


                                                                <span class="" aria-hidden="true">
                                                                    Squalane
                                                                </span>

                                                                <span class="sr-only selected-assistive-text">

                                                                    Refine by Active Ingredient: Squalane
                                                                </span>
                                                            </button>
                                                        </li>



                                                    </ul>







                                                </div>
                                            </div>






                                            <div class="refinement refinement-preferences plp-search-refinement"
                                                data-id="preferences">
                                                <div class="refinement-group-header">
                                                    <a class="title d-lg-none" data-toggle="collapse"
                                                        href="#preferences" role="button" aria-expanded="false"
                                                        aria-controls="preferences">
                                                        <span>Preferences</span>
                                                    </a>
                                                    <span class="title d-none d-lg-block">Preferences</span>
                                                </div>


                                                <div class="refinement-group-body category-refinement-group-body collapse "
                                                    id="preferences">









                                                    <ul class="values content list-group ">









                                                        <li class="list-group-item p-0 ">
                                                            <button
                                                                data-href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Search-ShowAjax?cgid=theordinary-facialcleansers&amp;prefn1=availableCountries&amp;prefv1=US&amp;prefn2=properties&amp;prefv2=alcoholFree&amp;productRefineBar=true"
                                                                class="px-lg-0 filters_item
        ">

                                                                <i class="filters_item-icon"></i>


                                                                <span class="" aria-hidden="true">
                                                                    alcohol-free
                                                                </span>

                                                                <span class="sr-only selected-assistive-text">

                                                                    Refine by Preferences: alcohol-free
                                                                </span>
                                                            </button>
                                                        </li>











                                                        <li class="list-group-item p-0 ">
                                                            <button
                                                                data-href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Search-ShowAjax?cgid=theordinary-facialcleansers&amp;prefn1=availableCountries&amp;prefv1=US&amp;prefn2=properties&amp;prefv2=crueltyFree&amp;productRefineBar=true"
                                                                class="px-lg-0 filters_item
        ">

                                                                <i class="filters_item-icon"></i>


                                                                <span class="" aria-hidden="true">
                                                                    cruelty-free
                                                                </span>

                                                                <span class="sr-only selected-assistive-text">

                                                                    Refine by Preferences: cruelty-free
                                                                </span>
                                                            </button>
                                                        </li>











                                                        <li class="list-group-item p-0 ">
                                                            <button
                                                                data-href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Search-ShowAjax?cgid=theordinary-facialcleansers&amp;prefn1=availableCountries&amp;prefv1=US&amp;prefn2=properties&amp;prefv2=glutenFree&amp;productRefineBar=true"
                                                                class="px-lg-0 filters_item
        ">

                                                                <i class="filters_item-icon"></i>


                                                                <span class="" aria-hidden="true">
                                                                    gluten-free
                                                                </span>

                                                                <span class="sr-only selected-assistive-text">

                                                                    Refine by Preferences: gluten-free
                                                                </span>
                                                            </button>
                                                        </li>











                                                        <li class="list-group-item p-0 ">
                                                            <button
                                                                data-href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Search-ShowAjax?cgid=theordinary-facialcleansers&amp;prefn1=availableCountries&amp;prefv1=US&amp;prefn2=properties&amp;prefv2=oilFree&amp;productRefineBar=true"
                                                                class="px-lg-0 filters_item
        ">

                                                                <i class="filters_item-icon"></i>


                                                                <span class="" aria-hidden="true">
                                                                    oil-free
                                                                </span>

                                                                <span class="sr-only selected-assistive-text">

                                                                    Refine by Preferences: oil-free
                                                                </span>
                                                            </button>
                                                        </li>











                                                        <li class="list-group-item p-0 ">
                                                            <button
                                                                data-href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Search-ShowAjax?cgid=theordinary-facialcleansers&amp;prefn1=availableCountries&amp;prefv1=US&amp;prefn2=properties&amp;prefv2=siliconeFree&amp;productRefineBar=true"
                                                                class="px-lg-0 filters_item
        ">

                                                                <i class="filters_item-icon"></i>


                                                                <span class="" aria-hidden="true">
                                                                    silicone-free
                                                                </span>

                                                                <span class="sr-only selected-assistive-text">

                                                                    Refine by Preferences: silicone-free
                                                                </span>
                                                            </button>
                                                        </li>











                                                        <li class="list-group-item p-0 ">
                                                            <button
                                                                data-href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Search-ShowAjax?cgid=theordinary-facialcleansers&amp;prefn1=availableCountries&amp;prefv1=US&amp;prefn2=properties&amp;prefv2=vegan&amp;productRefineBar=true"
                                                                class="px-lg-0 filters_item
        ">

                                                                <i class="filters_item-icon"></i>


                                                                <span class="" aria-hidden="true">
                                                                    vegan
                                                                </span>

                                                                <span class="sr-only selected-assistive-text">

                                                                    Refine by Preferences: vegan
                                                                </span>
                                                            </button>
                                                        </li>



                                                    </ul>







                                                </div>
                                            </div>






                                            <div class="refinement refinement-concern plp-search-refinement"
                                                data-id="concern">
                                                <div class="refinement-group-header">
                                                    <a class="title d-lg-none" data-toggle="collapse" href="#concern"
                                                        role="button" aria-expanded="false" aria-controls="concern">
                                                        <span>Concern</span>
                                                    </a>
                                                    <span class="title d-none d-lg-block">Concern</span>
                                                </div>


                                                <div class="refinement-group-body category-refinement-group-body collapse "
                                                    id="concern">









                                                    <ul class="values content list-group ">









                                                        <li class="list-group-item p-0 ">
                                                            <button
                                                                data-href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Search-ShowAjax?cgid=theordinary-facialcleansers&amp;prefn1=availableCountries&amp;prefv1=US&amp;prefn2=skinConcern&amp;prefv2=Textural%20Irregularities&amp;productRefineBar=true"
                                                                class="px-lg-0 filters_item
        ">

                                                                <i class="filters_item-icon"></i>


                                                                <span class="" aria-hidden="true">
                                                                    Textural Irregularities
                                                                </span>

                                                                <span class="sr-only selected-assistive-text">

                                                                    Refine by Concern: Textural Irregularities
                                                                </span>
                                                            </button>
                                                        </li>











                                                        <li class="list-group-item p-0 ">
                                                            <button
                                                                data-href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Search-ShowAjax?cgid=theordinary-facialcleansers&amp;prefn1=availableCountries&amp;prefv1=US&amp;prefn2=skinConcern&amp;prefv2=Dryness&amp;productRefineBar=true"
                                                                class="px-lg-0 filters_item
        ">

                                                                <i class="filters_item-icon"></i>


                                                                <span class="" aria-hidden="true">
                                                                    Dryness
                                                                </span>

                                                                <span class="sr-only selected-assistive-text">

                                                                    Refine by Concern: Dryness
                                                                </span>
                                                            </button>
                                                        </li>











                                                        <li class="list-group-item p-0 ">
                                                            <button
                                                                data-href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Search-ShowAjax?cgid=theordinary-facialcleansers&amp;prefn1=availableCountries&amp;prefv1=US&amp;prefn2=skinConcern&amp;prefv2=Cleansing&amp;productRefineBar=true"
                                                                class="px-lg-0 filters_item
        ">

                                                                <i class="filters_item-icon"></i>


                                                                <span class="" aria-hidden="true">
                                                                    Cleansing
                                                                </span>

                                                                <span class="sr-only selected-assistive-text">

                                                                    Refine by Concern: Cleansing
                                                                </span>
                                                            </button>
                                                        </li>











                                                        <li class="list-group-item p-0 ">
                                                            <button
                                                                data-href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Search-ShowAjax?cgid=theordinary-facialcleansers&amp;prefn1=availableCountries&amp;prefv1=US&amp;prefn2=skinConcern&amp;prefv2=Barrier%20Support&amp;productRefineBar=true"
                                                                class="px-lg-0 filters_item
        ">

                                                                <i class="filters_item-icon"></i>


                                                                <span class="" aria-hidden="true">
                                                                    Barrier Support
                                                                </span>

                                                                <span class="sr-only selected-assistive-text">

                                                                    Refine by Concern: Barrier Support
                                                                </span>
                                                            </button>
                                                        </li>



                                                    </ul>







                                                </div>
                                            </div>






                                            <div class="refinement refinement-format plp-search-refinement"
                                                data-id="format">
                                                <div class="refinement-group-header">
                                                    <a class="title d-lg-none" data-toggle="collapse" href="#format"
                                                        role="button" aria-expanded="false" aria-controls="format">
                                                        <span>Format</span>
                                                    </a>
                                                    <span class="title d-none d-lg-block">Format</span>
                                                </div>


                                                <div class="refinement-group-body category-refinement-group-body collapse "
                                                    id="format">









                                                    <ul class="values content list-group ">









                                                        <li class="list-group-item p-0 ">
                                                            <button
                                                                data-href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Search-ShowAjax?cgid=theordinary-facialcleansers&amp;prefn1=availableCountries&amp;prefv1=US&amp;prefn2=format&amp;prefv2=Cream&amp;productRefineBar=true"
                                                                class="px-lg-0 filters_item
        ">

                                                                <i class="filters_item-icon"></i>


                                                                <span class="" aria-hidden="true">
                                                                    Cream
                                                                </span>

                                                                <span class="sr-only selected-assistive-text">

                                                                    Refine by Format: Cream
                                                                </span>
                                                            </button>
                                                        </li>











                                                        <li class="list-group-item p-0 ">
                                                            <button
                                                                data-href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Search-ShowAjax?cgid=theordinary-facialcleansers&amp;prefn1=availableCountries&amp;prefv1=US&amp;prefn2=format&amp;prefv2=Gel&amp;productRefineBar=true"
                                                                class="px-lg-0 filters_item
        ">

                                                                <i class="filters_item-icon"></i>


                                                                <span class="" aria-hidden="true">
                                                                    Gel
                                                                </span>

                                                                <span class="sr-only selected-assistive-text">

                                                                    Refine by Format: Gel
                                                                </span>
                                                            </button>
                                                        </li>











                                                        <li class="list-group-item p-0 ">
                                                            <button
                                                                data-href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Search-ShowAjax?cgid=theordinary-facialcleansers&amp;prefn1=availableCountries&amp;prefv1=US&amp;prefn2=format&amp;prefv2=Balm&amp;productRefineBar=true"
                                                                class="px-lg-0 filters_item
        ">

                                                                <i class="filters_item-icon"></i>


                                                                <span class="" aria-hidden="true">
                                                                    Balm
                                                                </span>

                                                                <span class="sr-only selected-assistive-text">

                                                                    Refine by Format: Balm
                                                                </span>
                                                            </button>
                                                        </li>



                                                    </ul>







                                                </div>
                                            </div>



                                        </div>

                                    </div>

                                </div>

                                <div class="result-container" data-has-filters="false">
                                    <div class="filter-result">
                                        <span class="result-num"> (<sup class="product-count">3</sup> Results )</span>
                                    </div>
                                    <div class="filter-bar ">



                                    </div>
                                </div>
                            </div>






                            <input type="hidden" name="wishlistEnabled" value="true" encoding="off">
                            <input type="hidden" class="wishlist-fill-heart-grid-url" id="wishlistUrl-grid"
                                value="/on/demandware.store/Sites-deciem-us-Site/en_US/Wishlist-WishlistFillIcon"
                                encoding="off">


                            <div class="row product-grid js-product-grid" itemtype="http://schema.org/SomeProducts"
                    itemid="#product" data-total-count="4">
                    <?php
                    // Capture Interrupter HTML using output buffering to allow PHP execution
                    ob_start();

                    // Note: Using 'leke-karsiti-aydinlatici-serum' as per user snippet, assuming this is correct for this specific block
                    // even though file is leke-karsiti-aydinlatici.
                    // If this block is specific to Leke Karsiti Serum content, then this ID is correct.
                    $contentBlocks = getPageContentBlocks($pdo, 'hassasiyet-kizariklik');

                    if (!empty($contentBlocks)):
                        $block = $contentBlocks[0];
                        ?>
                        <div class="grid-interrupter-tile" data-category="">
                            <div class="grid-interrupter-slot-container">

                                <div class="content-image">
                                    <img src="<?= BASE_URL ?>/<?= htmlspecialchars($block['image_url']) ?>" title="" alt="">
                                </div>

                                <div class="content-body">
                                    <div class="content-title">
                                        <?= htmlspecialchars($block['title']) ?>
                                    </div>

                                    <div class="content-msg">
                                        <?= htmlspecialchars($block['subtitle']) ?>
                                    </div>

                                    <div class="amp_partial general-cta">
                                        <a class="btn-rounded-primary"
                                            href="<?= htmlspecialchars($block['button_url']) ?>"><?= htmlspecialchars($block['button_text']) ?></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endif;
                    $interrupterHTML = ob_get_clean();
                    ?>

                    <?php if (empty($products)): ?>
                        <div class="col-12" style="grid-column: 1 / -1;">
                            <p class="text-center">Ürün bulunamadı.</p>
                        </div>
                        <div class="pb-4 grid-interrupter-tile-wrapper" style="grid-column: span 2;">
                            <?= $interrupterHTML ?>
                        </div>
                    <?php else: ?>
                        <?php
                        $insertedInterrupter = false;
                        foreach ($products as $index => $product):
                            // Logic:
                            // Case 1 Item: Insert at Index 0. (P1, Content)
                            // Case >= 2 Items: Insert at Index 1. (P1, P2, Content)
                    
                            $shouldInsert = false;
                            if (count($products) == 1 && $index == 0)
                                $shouldInsert = true;
                            if (count($products) >= 2 && $index == 1)
                                $shouldInsert = true;
                            ?>
                            <div class="product-grid-item pb-4">
                                <div class="product" data-pid="<?= $product['id'] ?>" data-available="true">





                                    <div class="product-tile product-detail js-product-tile js-gtm-product-data js-pid-<?= $product['id'] ?>  "
                                        data-pid="<?= $product['id'] ?>" data-available="true"
                                        data-gtm-enhanced-ecommerce="{&quot;id&quot;:&quot;<?= $product['id'] ?>&quot;,&quot;name&quot;:&quot;Multi-Active Delivery Essence&quot;,&quot;brand&quot;:&quot;The Ordinary&quot;,&quot;variant&quot;:&quot;100ml &quot;,&quot;price&quot;:&quot;12.00&quot;,&quot;siteID&quot;:&quot;deciem-us&quot;,&quot;localeID&quot;:&quot;en_US&quot;}">
                                        <!-- dwMarker="product" dwContentID="56437cd692c760eb9c29e24a1c" -->
                                        <div class="tile-container">












                                            <input type="hidden" class="wishlist-fill-heart-grid-url" id="wishlistUrl-grid"
                                                value="/on/demandware.store/Sites-deciem-us-Site/en_US/Wishlist-WishlistFillIcon"
                                                encoding="off">


                                            <div class="image-container">













                                                <div class="bestseller-tag">New</div>







                                                <a class="wishlistTile js-wishlist-container addProductWishlist"
                                                    href="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/Wishlist-AddProduct.json"
                                                    title="<?= htmlspecialchars($product['name']) ?>"
                                                    data-pid="<?= $product['id'] ?>">
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



                                                <button class="quickview js-quickview hidden-md-down btn btn-primary btn-block"
                                                    data-url="/on/demandware.store/Sites-deciem-us-Site/en_US/Product-ShowQuickView?pid=<?= $product['id'] ?>"
                                                    data-toggle="modal" data-target="#quickViewModal"
                                                    title="<?= htmlspecialchars($product['name']) ?>"
                                                    aria-label="Quick View for Multi-Active Delivery Essence">
                                                    <span class="quickview-btn-icon"></span>

                                                    <span class="quickview-btn">
                                                        Quick view
                                                    </span>
                                                </button>

                                            </div>




                                            <div class="tile-body">

                                                <div class="am-pm">


                                                    <span class="icon-am"></span>





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
                                                            href="<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars($product['slug']) ?>"></a>
                                                        <div data-bv-show="inline_rating"
                                                            data-bv-productid="<?= $product['id'] ?>"
                                                            data-bv-redirect-url="/en-us/multi-active-delivery-essence-<?= $product['id'] ?>"
                                                            data-bv-seo="false"></div>
                                                    </div>






                                                </div>
                                                <h3 class="title-descriptor">

                                                    <div class="title-descriptor-value">Smooths, Softens, Hydrates
                                                    </div>

                                                </h3>
                                            </div>
                                        </div>






                                        <div class="js-product-add-to-basket">



                                            <div class="attributes product_tile-attributes js-product_tile_attributes ">








                                                <div class="product_price_and_size">

                                                    <div class="size_wrap">

                                                        <div class="d-block d-md-none">
                                                            <select class="js-attribute-value_link size">


                                                                <option
                                                                    value="https://theordinary.com/on/demandware.store/Sites-deciem-us-Site/en_US/Product-Variation?dwvar_<?= $product['id'] ?>_size=&amp;pid=<?= $product['id'] ?>&amp;quantity=1">
                                                                    100ml
                                                                </option>


                                                            </select>
                                                        </div>
                                                        <div class="d-none d-md-block">

                                                            <div class="attribute-values product_tile-attributes_value product-variation"
                                                                data-attr="size">




                                                                <div class="attribute-value-container ">
                                                                    <button
                                                                        data-url="https://theordinary.com/on/demandware.store/Sites-deciem-us-Site/en_US/Product-Variation?dwvar_<?= $product['id'] ?>_size=&amp;pid=<?= $product['id'] ?>&amp;quantity=1"
                                                                        data-attr-value="int100ml" class="js-attribute-value_link attribute-value_link item product_tile-attributes_link
                    size
                    selected
                    selectable">
                                                                        <span data-attr-value="int100ml" class="
                            size-value
                            swatch-rectangle
                            swatch-value
                            1.0
                            selected
                            selectable
                            ">
                                                                            100ml
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

                                                                        $<?= htmlspecialchars($product['price']) ?> USD


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
                                                                data-available="true" data-pid="<?= $product['id'] ?>"
                                                                data-stock-notification-url="/on/demandware.store/Sites-deciem-us-Site/en_US/StockNotification-Show?pid=<?= $product['id'] ?>">


                                                                <span class="sr-only label-addtocart">Add to
                                                                    Cart</span>

                                                                <span class="label-outofstock position-relative d-none">Out
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
                            <?php if ($shouldInsert): ?>
                                <div class="pb-4 grid-interrupter-tile-wrapper" style="grid-column: span 2;">
                                    <?= $interrupterHTML ?>
                                </div>
                                <?php $insertedInterrupter = true; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if (!$insertedInterrupter): ?>
                            <div class="pb-4 grid-interrupter-tile-wrapper" style="grid-column: span 2;">
                                <?= $interrupterHTML ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!-- Grid Footer -->
                    <div class="col-12 d-none">
                        <input type="hidden" class="permalink"
                            value="<?= BASE_URL ?>/category.php?slug=<?= htmlspecialchars($slug) ?>">
                    </div>
                </div>
                <div class="recently-viewed-section">



                            <!-- =============== This snippet of JavaScript handles fetching the dynamic recommendations from the remote recommendations server
and then makes a call to render the configured template with the returned recommended products: ================= -->

                            <script>
                                (function () {
                                    // window.CQuotient is provided on the page by the Analytics code:
                                    var cq = window.CQuotient;
                                    var dc = window.DataCloud;
                                    var isCQ = false;
                                    var isDC = false;
                                    if (cq && ('function' == typeof cq.getCQUserId)
                                        && ('function' == typeof cq.getCQCookieId)
                                        && ('function' == typeof cq.getCQHashedEmail)
                                        && ('function' == typeof cq.getCQHashedLogin)) {
                                        isCQ = true;
                                    }
                                    if (dc && ('function' == typeof dc.getDCUserId)) {
                                        isDC = true;
                                    }
                                    if (isCQ || isDC) {
                                        var recommender = '[[&quot;einstein-viewed-recently&quot;]]';
                                        var slotRecommendationType = decodeHtml('RECOMMENDATION');
                                        // removing any leading/trailing square brackets and escaped quotes:
                                        recommender = recommender.replace(/\[|\]|&quot;/g, '');
                                        var separator = '|||';
                                        var slotConfigurationUUID = 'beb3e5842b7c4ff655f23e0166';
                                        var contextAUID = decodeHtml('theordinary-facialcleansers');
                                        var contextSecondaryAUID = decodeHtml('');
                                        var contextAltAUID = decodeHtml('');
                                        var contextType = decodeHtml('');
                                        var anchorsArray = [];
                                        var contextAUIDs = contextAUID.split(separator);
                                        var contextSecondaryAUIDs = contextSecondaryAUID.split(separator);
                                        var contextAltAUIDs = contextAltAUID.split(separator);
                                        var contextTypes = contextType.split(separator);
                                        var slotName = decodeHtml('recently-viewed-slot');
                                        var slotConfigId = decodeHtml('recently-viewed-facialcleansers-plp');
                                        var slotConfigTemplate = decodeHtml('slots/recommendation/einsteinRecommendation_Carousel.isml');
                                        if (contextAUIDs.length == contextSecondaryAUIDs.length) {
                                            for (i = 0; i < contextAUIDs.length; i++) {
                                                anchorsArray.push({
                                                    id: contextAUIDs[i],
                                                    sku: contextSecondaryAUIDs[i],
                                                    type: contextTypes[i],
                                                    alt_id: contextAltAUIDs[i]
                                                });
                                            }
                                        } else {
                                            anchorsArray = [{ id: contextAUID, sku: contextSecondaryAUID, type: contextType, alt_id: contextAltAUID }];
                                        }
                                        var urlToCall = '/on/demandware.store/Sites-deciem-us-Site/en_US/CQRecomm-Start';
                                        var params = null;
                                        if (isCQ) {
                                            params = {
                                                userId: cq.getCQUserId(),
                                                cookieId: cq.getCQCookieId(),
                                                emailId: cq.getCQHashedEmail(),
                                                loginId: cq.getCQHashedLogin(),
                                                anchors: anchorsArray,
                                                slotId: slotName,
                                                slotConfigId: slotConfigId,
                                                slotConfigTemplate: slotConfigTemplate,
                                                ccver: '1.03'
                                            };
                                        }
                                        // console.log("Recommendation Type - " + slotRecommendationType + ", Recommender Selected - " + recommender);
                                        if (isDC && slotRecommendationType == 'DATA_CLOUD_RECOMMENDATION') {
                                            // Set DC variables for API call
                                            dcIndividualId = dc.getDCUserId();
                                            dcUrl = dc.getDCPersonalizationPath();
                                            if (dcIndividualId && dcUrl && dcIndividualId != '' && dcUrl != '') {
                                                // console.log("Fetching CDP Recommendations");
                                                var productRecs = {};
                                                productRecs[recommender] = getCDPRecs(dcUrl, dcIndividualId, recommender);
                                                cb(productRecs);
                                            }
                                        } else if (isCQ && slotRecommendationType != 'DATA_CLOUD_RECOMMENDATION') {
                                            if (cq.getRecs) {
                                                cq.getRecs(cq.clientId, recommender, params, cb);
                                            } else {
                                                cq.widgets = cq.widgets || [];
                                                cq.widgets.push({
                                                    recommenderName: recommender,
                                                    parameters: params,
                                                    callback: cb
                                                });
                                            }
                                        }
                                    };
                                    function decodeHtml(html) {
                                        var txt = document.createElement("textarea");
                                        txt.innerHTML = html;
                                        return txt.value;
                                    }
                                    function cb(parsed) {
                                        var arr = parsed[recommender].recs;
                                        if (arr && 0 < arr.length) {
                                            var filteredProductIds = '';
                                            for (i = 0; i < arr.length; i++) {
                                                filteredProductIds = filteredProductIds + 'pid' + i + '=' + encodeURIComponent(arr[i].id) + '&';
                                            }
                                            filteredProductIds = filteredProductIds.substring(0, filteredProductIds.length - 1);//to remove the trailing '&'
                                            var formData = 'auid=' + encodeURIComponent(contextAUID)
                                                + '&scid=' + slotConfigurationUUID
                                                + '&' + filteredProductIds;
                                            var request = new XMLHttpRequest();
                                            request.open('POST', urlToCall, true);
                                            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                            request.onreadystatechange = function () {
                                                if (this.readyState === 4) {
                                                    // Got the product data from DW, showing the products now by changing the inner HTML of the DIV:
                                                    var divId = 'cq_recomm_slot-' + slotConfigurationUUID;
                                                    document.getElementById(divId).innerHTML = this.responseText;
                                                    //find and evaluate scripts in response:
                                                    var scripts = document.getElementById(divId).getElementsByTagName('script');
                                                    if (null != scripts) {
                                                        for (var i = 0; i < scripts.length; i++) {//not combining script snippets on purpose
                                                            var srcScript = document.createElement('script');
                                                            srcScript.text = scripts[i].innerHTML;
                                                            srcScript.asynch = scripts[i].asynch;
                                                            srcScript.defer = scripts[i].defer;
                                                            srcScript.type = scripts[i].type;
                                                            srcScript.charset = scripts[i].charset;
                                                            document.head.appendChild(srcScript);
                                                            document.head.removeChild(srcScript);
                                                        }
                                                    }
                                                }
                                            };
                                            request.send(formData);
                                            request = null;
                                        }
                                    };
                                })();
                            </script>
                            <!-- The DIV tag id below is unique on purpose in case there are multiple recommendation slots on the same .isml page: -->
                            <div id="cq_recomm_slot-beb3e5842b7c4ff655f23e0166"></div>
                            <!-- ====================== snippet ends here ======================== -->


                        </div>



                        <div class="col-12 p-0 tab-pane content-tab-pane">
                            <div class="content-grid js-content-grid" id="content-search-results-pane" role="tabpanel"
                                aria-labelledby="articles-tab">
                                <div id="content-search-results" class="content-grid-header"></div>
                            </div>

                            <div class="search_blog_slot">

















































































                                <div class="ampliance_layout divider"
                                    style="--desktopMarginTop: px; --desktopMarginBottom: 64px; --mobileMarginTop: px; --mobileMarginBottom: 40px; --bgColor: transparent;">
                                    <hr style="--color: #E1DED9;">
                                </div>
















































































































                                <div class="ampliance_layout divider"
                                    style="--desktopMarginTop: 0px; --desktopMarginBottom: 64px; --mobileMarginTop: 0px; --mobileMarginBottom: 40px; --bgColor: transparent;">
                                    <hr style="--color: visibility: hidden;">
                                </div>






































                                <div class="content-list-module">
                                    <div class="content-list-header">
                                        <div class="header__title"><br>
                                            <h2>Noc. Kütüphanesi'ndeki Temel Bilgilere Dönüş Kaynaklarımızdan Bazılarını
                                                İnceleyin</h2>
                                        </div>
                                        <div class="header__cta">
                                            <div class="amp_partial general-cta"><br><a class="btn-rounded-primary"
                                                    href="en-us/blog" target="_blank">
                                                    Daha Fazlasını Oku </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-content">
                                        <div class="primary-item">
                                            <div class="image">
                                                <img class="lazy"
                                                    alt="Three The Ordinary skincare products on a white surface: Squalane Cleanser in a tube, Multi-Peptide + HA Serum in a dropper bottle, and Natural Moisturizing Factors + HA in a tube with a swatch of cream."
                                                    data-src="<?= BASE_URL ?>/assets/images/noc-anasayfa-1.jpg">
                                            </div>
                                            <div class="content-copy">
                                                <p class="content-copy_subtitle">
                                                    Cilt Bakımı Eğitimi </p>
                                                <h2 class="content-copy_title"> <a
                                                        href="en-us/blog/mastering-skincare-routine-guide"
                                                        target="_blank">Bir Rejim Nasıl Oluşturulur</a> </h2>
                                            </div>
                                        </div>
                                        <div class="secondary-items">
                                            <div class="secondary-item">
                                                <div class="image">
                                                    <img class="lazy"
                                                        alt="Swatches of different coloured serums for The Ordinary"
                                                        data-src="<?= BASE_URL ?>/assets/images/noc-anasayfa-2.jpg">
                                                </div>
                                                <div class="content-copy">
                                                    <p class="content-copy_subtitle">
                                                        Cilt Bakımı Eğitimi </p>
                                                    <h2 class="content-copy_title"> <a
                                                            href="en-us/blog/skincare-layering-guide">Katmanlama
                                                            Kılavuzu</a> </h2>
                                                </div>
                                            </div>
                                            <div class="secondary-item">
                                                <div class="image">
                                                    <img class="lazy"
                                                        alt="Three of The Ordinary&#x27;s Retinoid formulas - Retinal 0.2% Emulsion, Retinol 1% in Squalane, Retinol 0.5% in Squalane"
                                                        data-src="<?= BASE_URL ?>/assets/images/noc-anasayfa-3.jpg">
                                                </div>
                                                <div class="content-copy">
                                                    <p class="content-copy_subtitle">
                                                        Cilt Bakımı Eğitimi </p>
                                                    <h2 class="content-copy_title"> <a
                                                            href="en-us/blog/definitive-guide-using-retinoids"
                                                            target="_blank">Retinoidler 101</a> </h2>
                                                </div>
                                            </div>
                                            <div class="secondary-item">
                                                <div class="image">
                                                    <img class="lazy"
                                                        alt="The Ordinary&#x27;s Saccharomyces Ferment 30% Milky Toner and Glycolic Acid 7% Exfoliating Toner"
                                                        data-src="<?= BASE_URL ?>/assets/images/noc-anasayfa-4.jpg">
                                                </div>
                                                <div class="content-copy">
                                                    <p class="content-copy_subtitle">
                                                        Cilt Bakımı Eğitimi </p>
                                                    <h2 class="content-copy_title"> <a href="en-us/blog/skincare-toners"
                                                            target="_blank">Cilt Toniği Nedir?</a> </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>













































































                                <div class="ampliance_layout divider"
                                    style="--desktopMarginTop: 0px; --desktopMarginBottom: 120px; --mobileMarginTop: 0px; --mobileMarginBottom: 80px; --bgColor: transparent;">
                                    <hr style="--color: visibility: hidden;">
                                </div>








































                            </div>

                        </div>


                        <div class="plp_faq_slot">




                        </div>

                        <div class="plp_recommnedation_slot">




                        </div>

                    </div>
                </div>
            </div>


        </div>

        <?php include BASE_PATH . '/footer.php'; ?>

    </div>
    <div class="error-messaging"></div>
    <div class="modal-background js-modal-background"></div>



    <?php include BASE_PATH . '/includes/search-drawer.php'; ?>





    <!--[if lt IE 10]>
<script>//common/scripts.isml</script>
<script defer type="text/javascript" src="<?= BASE_URL ?>/assets/js/jquery.min.js"></script>
<script defer type="text/javascript" src="<?= BASE_URL ?>/assets/js/vendors.js"></script>
<script defer type="text/javascript" src="<?= BASE_URL ?>/assets/js/js_main.js"></script>

    <script defer type="text/javascript" src="<?= BASE_URL ?>/assets/js/search.js"
        
        >
    </script>

    <script defer type="text/javascript" src="<?= BASE_URL ?>/assets/js/accordion.js"
        
        >
    </script>

    <script defer type="text/javascript" src="//apps.bazaarvoice.com/assets/js/bv.js"
        
        >
    </script>






<script type="text/javascript" src="https://static.ordergroove.com/assets/js/main.js"></script>
<script type="text/javascript">
window.OrdergrooveTrackingUrl = "/on/demandware.store/Sites-deciem-us-Site/en_US/OrderGroove-PurchasePostTracking"
</script>

<script type="text/javascript">
window.OrdergrooveLegacyOffers = false
</script>




<script type="text/javascript">
    window.SFRA = window.SFRA || {};
    window.SFRA.Constants = {};
    window.SFRA.Resources = {"regimentBeginButton":"Let's Begin","regimentNextButton":"Next","regimentBuilderText":"Regimen Builder","regimenBuilderRecommendation":"Recommended for you based on your answers.","commonFieldError":"This field is required.","productShadeLabel":"Shade:","viewMoreLabel":"View More","viewLessLabel":"View Less","giftcardDatePlaceHolder":"mm/dd/yyyy","undoWishlistAction":"Undo","regimentSaveResults":"Results saved","regimentSavedResults":"Regimen Builder Results","giftCardLabel":"Gift Card","modelGuideAddedToCart":"✓ Added to Cart","addToCartText":"Add to Cart","modelGuidePregnancyText":"<p>While each ingredient has been tested and is considered safe for topical application, The Ordinary products have not been tested on people who are pregnant or breastfeeding. When pregnant or breastfeeding, it is recommended to avoid any skincare products with certain ingredients.</p><p>For extra care and support, if you're pregnant or breastfeeding, we recommend talking to your doctor or health care practitioner before starting any new skincare products and/or ingredients.</p>","productConflict":"Avoid Using Together","productConflictMsg":"These products should not be used together due to conflicting ingredients.","productCaution":"Use Together With Caution","productCautionMsg":"These products can be used together, but not in the same routine.","productSafe":"Safe to Use Together","productSafeMsg":"These formulations do not contain conflicting ingredients. You can layer them in the same skincare regimen. We recommend a patch test before adding a new product to your routine.","buttonBackToCart":"Back to Cart","buttonSelect":"Select","buttonRemove":"Remove"};
    window.SFRA.Urls = {"wishlistAddProduct":"/on/demandware.store/Sites-deciem-us-Site/en_US/Wishlist-AddProduct","wishlistRemoveProduct":"/on/demandware.store/Sites-deciem-us-Site/en_US/Wishlist-RemoveProduct","accountShow":"/en-us/account","wishlistShow":"/en-us/favourites","regimenGetResults":"/on/demandware.store/Sites-deciem-us-Site/en_US/Regimen-GetRegimenDetails?cid=regimen-builder","getProductInfo":"/on/demandware.store/Sites-deciem-us-Site/en_US/Product-GetProductInfo","tileShow":"/on/demandware.store/Sites-deciem-us-Site/en_US/Tile-Show","productShow":"/on/demandware.store/Sites-deciem-us-Site/en_US/Product-Show"};
    window.SFRA.SitePreferences = {"MODEL_GUIDE_API_URL":"https://model-guide-awbshzbmbag0gzbc.eastus-01.azurewebsites.net//api/v2/Chat/pdp-chat?","BLACK_FRIDAY_ENABLED":false,"BLACK_FRIDAY_EXCLUDED_COUNTRIES":{"0":"JP","1":"KR","2":"HK"}};
</script>


<![endif]-->



    <script type="text/javascript" id='aa873949f74d'>
        (function () {
            var siteId = 'aa873949f74d';
            function t(t, e) { for (var n = t.split(""), r = 0; r < n.length; ++r)n[r] = String.fromCharCode(n[r].charCodeAt(0) + e); return n.join("") } function e(e) { return t(e, -l).replace(/%SN%/g, siteId) } function n(t) { try { S.ex = t, g(S) } catch (e) { } } function r(t, e, n) { var r = document.createElement("script"); r.onerror = n, r.onload = e, r.type = "text/javascript", r.id = "ftr__script", r.async = !0, r.src = "https://" + t; var o = document.getElementsByTagName("script")[0]; o.parentNode.insertBefore(r, o) } function o() { k(T.uAL), setTimeout(i, v, T.uAL) } function i(t) { try { var e = t === T.uDF ? h : m; r(e, function () { try { U(), n(t + T.uS) } catch (e) { } }, function () { try { U(), S.td = 1 * new Date - S.ts, n(t + T.uF), t === T.uDF && o() } catch (e) { n(T.eUoe) } }) } catch (i) { n(t + T.eTlu) } } var a = { write: function (t, e, n, r) { void 0 === r && (r = !0); var o, i; if (n ? (o = new Date, o.setTime(o.getTime() + 24 * n * 60 * 60 * 1e3), i = "; expires=" + o.toGMTString()) : i = "", !r) return void (document.cookie = escape(t) + "=" + escape(e) + i + "; path=/"); var a, c, u; if (u = location.host, 1 === u.split(".").length) document.cookie = escape(t) + "=" + escape(e) + i + "; path=/"; else { c = u.split("."), c.shift(), a = "." + c.join("."), document.cookie = escape(t) + "=" + escape(e) + i + "; path=/; domain=" + a; var s = this.read(t); null != s && s == e || (a = "." + u, document.cookie = escape(t) + "=" + escape(e) + i + "; path=/; domain=" + a) } }, read: function (t) { for (var e = escape(t) + "=", n = document.cookie.split(";"), r = 0; r < n.length; r++) { for (var o = n[r]; " " == o.charAt(0);)o = o.substring(1, o.length); if (0 === o.indexOf(e)) return unescape(o.substring(e.length, o.length)) } return null } }, c = "fort", u = "erTo", s = "ken", d = c + u + s, f = "9"; f += "ck"; var l = 3, h = e("(VQ(1fgq71iruwhu1frp2vq2(VQ(2vfulsw1mv"), m = e("g68x4yj4t5;e6z1forxgiurqw1qhw2vq2(VQ(2vfulsw1mv"), v = 10; window.ftr__startScriptLoad = 1 * new Date; var g = function (t) { var e = function (t) { return t || "" }, n = e(t.id) + "_" + e(t.ts) + "_" + e(t.td) + "_" + e(t.ex) + "_" + e(f); a.write(d, n, 1825, !0) }, p = function () { var t = a.read(d) || "", e = t.split("_"), n = function (t) { return e[t] || void 0 }; return { id: n(0), ts: n(1), td: n(2), ex: n(3), vr: n(4) } }, w = function () { for (var t = {}, e = "fgu", n = [], r = 0; r < 256; r++)n[r] = (r < 16 ? "0" : "") + r.toString(16); var o = function (t, e, r, o, i) { var a = i ? "-" : ""; return n[255 & t] + n[t >> 8 & 255] + n[t >> 16 & 255] + n[t >> 24 & 255] + a + n[255 & e] + n[e >> 8 & 255] + a + n[e >> 16 & 15 | 64] + n[e >> 24 & 255] + a + n[63 & r | 128] + n[r >> 8 & 255] + a + n[r >> 16 & 255] + n[r >> 24 & 255] + n[255 & o] + n[o >> 8 & 255] + n[o >> 16 & 255] + n[o >> 24 & 255] }, i = function () { if (window.Uint32Array && window.crypto && window.crypto.getRandomValues) { var t = new window.Uint32Array(4); return window.crypto.getRandomValues(t), { d0: t[0], d1: t[1], d2: t[2], d3: t[3] } } return { d0: 4294967296 * Math.random() >>> 0, d1: 4294967296 * Math.random() >>> 0, d2: 4294967296 * Math.random() >>> 0, d3: 4294967296 * Math.random() >>> 0 } }, a = function () { var t = "", e = function (t, e) { for (var n = "", r = t; r > 0; --r)n += e.charAt(1e3 * Math.random() % e.length); return n }; return t += e(2, "0123456789"), t += e(1, "123456789"), t += e(8, "0123456789") }; return t.safeGenerateNoDash = function () { try { var t = i(); return o(t.d0, t.d1, t.d2, t.d3, !1) } catch (n) { try { return e + a() } catch (n) { } } }, t.isValidNumericalToken = function (t) { return t && t.toString().length <= 11 && t.length >= 9 && parseInt(t, 10).toString().length <= 11 && parseInt(t, 10).toString().length >= 9 }, t.isValidUUIDToken = function (t) { return t && 32 === t.toString().length && /^[a-z0-9]+$/.test(t) }, t.isValidFGUToken = function (t) { return 0 == t.indexOf(e) && t.length >= 12 }, t }(), T = { uDF: "UDF", uAL: "UAL", mLd: "1", eTlu: "2", eUoe: "3", uS: "4", uF: "9", tmos: ["T5", "T10", "T15", "T30", "T60"], tmosSecs: [5, 10, 15, 30, 60], bIR: "43" }, y = function (t, e) { for (var n = T.tmos, r = 0; r < n.length; r++)if (t + n[r] === e) return !0; return !1 }; try { var S = p(); try { S.id && (w.isValidNumericalToken(S.id) || w.isValidUUIDToken(S.id) || w.isValidFGUToken(S.id)) || (S.id = w.safeGenerateNoDash()), S.ts = window.ftr__startScriptLoad, g(S); var D = new Array(T.tmosSecs.length), k = function (t) { for (var e = 0; e < T.tmosSecs.length; e++)D[e] = setTimeout(n, 1e3 * T.tmosSecs[e], t + T.tmos[e]) }, U = function () { for (var t = 0; t < T.tmosSecs.length; t++)clearTimeout(D[t]) }; y(T.uDF, S.ex) ? o() : (k(T.uDF), setTimeout(i, v, T.uDF)) } catch (F) { n(T.mLd) } } catch (F) { }
        })()
    </script>


    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe
            src="<?= BASE_URL ?>/ns?id=GTM-PSNCTZT&gtm_auth=at3rkKALywQckzT0tnSSvQ&gtm_preview=env-1&gtm_cookies_win=x"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script src="<?= BASE_URL ?>/assets/js/api.js?render=explicit&onload=onRecaptchaLoad" async="" defer=""></script>
    <!-- Awin -->
    <script defer="defer" src="<?= BASE_URL ?>/assets/js/29849.js" type="text/javascript"></script><!-- End Awin -->
    <!-- ShopMy -->
    <script defer="defer" src="<?= BASE_URL ?>/assets/js/sms_aff_clicktrack-deciem.js" type="text/javascript"></script>
    <!-- End ShopMy -->










    <div class="content-asset"><!-- dwMarker="content" dwContentID="5f8844e14777770d8e97dd4131" -->
        <style>
            .embeddedMessagingFrame {
                z-index: 10000 !important;
            }

            .embeddedMessagingRecaptchaBanner {
                visibility: hidden;
            }

            .grecaptcha-badge {
                visibility: hidden;
            }

            lightning-primitive-icon {
                visibility: hidden;
            }
        </style>
        <script type='text/javascript'>
            function initEmbeddedMessaging() {
                try {
                    embeddedservice_bootstrap.settings.language = 'en_US'; // For example, enter 'en' or 'en-US'
                    window.addEventListener("onEmbeddedMessagingReady", () => {
                        var country = "US";
                        var storefrontId = "theordinary";
                        var locale = "en_US";
                        embeddedservice_bootstrap.prechatAPI.setHiddenPrechatFields({
                            "Country_Code": country,
                            "Storefront_Id": storefrontId,
                            "ChannelLocale": locale
                        });
                    });
                    embeddedservice_bootstrap.init(
                        '00D5w000003HZgL',
                        'Service_Ai',
                        'https://deciem.my.site.com/ESWServiceAi1737344504997',
                        {
                            scrt2URL: 'https://deciem.my.salesforce-scrt.com'
                        }
                    );
                } catch (err) {
                    console.error('Error loading Embedded Messaging: ', err);
                }
            };

            var isPriorEvent_Routed = 0;

            window.addEventListener("onEmbeddedMessagingConversationOpened", (event) => {
                isPriorEvent_Routed = 0;
            });
            window.addEventListener("onEmbeddedMessagingConversationParticipantChanged", (event) => {
                //        const obj = JSON.parse(event.detail);

                const obj2 = event.detail;
                const obj = obj2.conversationEntry;
                const obj3 = JSON.parse(obj.entryPayload);

                if (obj3.entryType == "ParticipantChanged" & obj3.entries[0].operation == "remove" & isPriorEvent_Routed != 1) {
                    var localStore = JSON.parse(localStorage.getItem('00D5w000003HZgL_WEB_STORAGE'));  // REPLACE 00DKc000006PWRm with your ORG ID

                    var sessId = localStore.JWT;

                    const urlbase = "https://deciem.my.salesforce-scrt.com/iamessage/v1/conversation/"; // REPLACE SCRT DOMAIN URL with that of your ORG
                    const url = urlbase.concat(obj2.conversationId);


                    const authHeaderBase = "Bearer ";
                    const authHeader = authHeaderBase.concat(sessId);

                    const xhttpr = new XMLHttpRequest();
                    xhttpr.open('DELETE', url, true);
                    xhttpr.setRequestHeader("Content-Type", "application/json");
                    xhttpr.setRequestHeader("Authorization", authHeader);

                    xhttpr.send();

                    xhttpr.onload = () => {
                        if (xhttpr.status === 200) {
                            const response = JSON.parse(xhttpr.response);
                            // Process the response data here
                        }
                    }
                }
                isPriorEvent_Routed = 0;
            });
            window.addEventListener("onEmbeddedMessagingConversationClosed", (event) => {
            });
            window.addEventListener("onEmbeddedMessagingConversationRouted", (event) => {
                isPriorEvent_Routed = 1;
            });
        </script>
        <script type='text/javascript' src='<?= BASE_URL ?>/assets/js/bootstrap.min.js'
            onload='initEmbeddedMessaging()'></script>
    </div> <!-- End content-asset -->




    <span class="api-true consented tracking-consent" data-caonline="true"
        data-url="/on/demandware.store/Sites-deciem-us-Site/en_US/ConsentTracking-GetContent?cid=tracking_hint"
        data-urlmodalcontent="/on/demandware.store/Sites-deciem-us-Site/en_US/ConsentTracking-GetContent?cid=tracking_settings"
        data-reject="/on/demandware.store/Sites-deciem-us-Site/en_US/ConsentTracking-SetSession?consent=false"
        data-accept="/on/demandware.store/Sites-deciem-us-Site/en_US/ConsentTracking-SetSession?consent=true"
        data-accepttext="Accept" data-savetext="Save" data-settinglink="Set cookie preferences"
        data-heading="Tracking Consent"></span>


    <!-- Demandware Analytics code 1.0 (body_end-analytics-tracking-asynch.js) -->
    <script type="text/javascript">//<!--
        /* <![CDATA[ */
        function trackPage() {
            try {
                var trackingUrl = "https://theordinary.com/on/demandware.store/Sites-deciem-us-Site/en_US/__Analytics-Start";
                var dwAnalytics = dw.__dwAnalytics.getTracker(trackingUrl);
                if (typeof dw.ac == "undefined") {
                    dwAnalytics.trackPageView();
                } else {
                    dw.ac.setDWAnalytics(dwAnalytics);
                }
            } catch (err) { };
        }
        /* ]]> */
        // -->
    </script>
    <script type="text/javascript"
        src="<?= BASE_URL ?>/assets/js/dwanalytics-22.2.js"
        async="async" onload="trackPage()"></script>
    <!-- Demandware Active Data (body_end-active_data.js) -->
    <script
        src="<?= BASE_URL ?>/assets/js/dwac-21.7.js"
        type="text/javascript" async="async"></script><!-- CQuotient Activity Tracking (body_end-cquotient.js) -->
    <script src="<?= BASE_URL ?>/assets/js/gretel.min.js" type="text/javascript" async="async"></script>
</body>

</html>