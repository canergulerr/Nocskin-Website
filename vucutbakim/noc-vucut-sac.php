<?php
include dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/admin/includes/db.php';
require_once dirname(__DIR__) . '/includes/banner_helper.php';

try {
    $stmt = $pdo->prepare("SELECT * FROM banners WHERE page_identifier = 'body-hair' LIMIT 1");
    $stmt->execute();
    $banner = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $banner = null;
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
        Vücut + Saç Ürünleri | Noc
    </title>

    <meta name="description"
        content="Shop The Ordinary's entire hair care collection. Top-rated vegan shampoo, conditioner, and hair treatments for your hair care routine. Order now.">
    <meta name="keywords" content="hair oil, hair products, hair treatments, the ordinary hair">







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









    <link rel="canonical" href="body-hair">






    <script src="<?= BASE_URL ?>/assets/js/widget.js" defer=""></script>


    <style>
    @media (min-width: 1024px) {
        div.page { padding-top: 115px !important; }
    }
    @media (max-width: 1023px) {
        div.page { padding-top: 75px !important; }
    }
</style>
</head>

<body data-brand="theordinary">

    <div class="page js-page" data-action="Search-Show" data-querystring="cgid=theordinary-bodyhair"
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









            <div class="add-to-wishlist-messages" style="display:none;"></div>





            <div class="plp_breadcrumb_panel d-sm-block mt-0 pt-0" style="margin-top:0 !important; padding-top:0 !important;">


                <ol class="breadcrumb">



                    <li class="breadcrumb-item icon-right_chevron">

                        <a href="<?= BASE_URL ?>/index.php" style="color:#fff !important;">Anasayfa</a>

                    </li>



                    <li class="breadcrumb-item ">

                        <span class="breadcrumb--current js-last-breadcrumbs" style="color:#fff !important;">Vücut +
                            Saç</span>

                    </li>


                </ol>


            </div>


            <div class="plp-search-section">

                <div class="plp_promotions_slot">


































































































                    <?php render_banner($pdo, 'noc-body-hair'); ?>






















                    <div class="ampliance_layout layout6 shop-by">

                        <div class="amp_partial">
                            <h2 class="title-text">Kategoriye Göre Alışveriş Yapın</h2>
                        </div>
                        <div class="subtitle">
                            <p>Saç ve vücut için, içeriği ön planda tutan, sürekli büyüyen ürün koleksiyonumuzu
                                keşfedin. Günlük vücut ve saç sorunlarınızı göz önünde bulundurarak, bilimsel
                                yöntemlerle geliştirilmiştir.</p>
                        </div>

                        <div class="grid-group" data-config="amplienceEventCarousel">
                            <div class="inner">

                                <div class="grid-tile">

                                    <div class="event-image">
                                        <a href="body-hair/body-care">
                                            <img class="lazy" alt=""
                                                data-src="https://cdn.media.amplience.net/i/deciem/ORD-PCP-Body1?fmt=auto&$poi$&sm=aspect&w=500&aspect=4:3">
                                        </a>
                                    </div>


                                    <div class="event-name">
                                        <span>Vücut Bakımı</span>
                                    </div>

                                    <div class="event-description">
                                        <span>Vücudunuzla ilgili endişeleri gidermek için formüle edilmiştir.</span>
                                    </div>

                                    <div class="amp_partial shop-cta">
                                        <a class="shop-arrow-link icon-arrow" href="body-hair/body-care">
                                            Tümünü Görüntüle
                                        </a>
                                    </div>
                                </div>
                                <div class="grid-tile">

                                    <div class="event-image">
                                        <a href="body-hair/hair-scalp-solutions">
                                            <img class="lazy" alt=""
                                                data-src="https://cdn.media.amplience.net/i/deciem/ORD-PCP-Body4?fmt=auto&$poi$&sm=aspect&w=500&aspect=4:3">
                                        </a>
                                    </div>


                                    <div class="event-name">
                                        <span>Saç ve Saç Derisi Çözümleri</span>
                                    </div>

                                    <div class="event-description">
                                        <span>En sık karşılaştığınız saç ve saç derisi sorunlarını gidermek için
                                            tasarlanmıştır.</span>
                                    </div>

                                    <div class="amp_partial shop-cta">
                                        <a class="shop-arrow-link icon-arrow" href="body-hair/hair-scalp-solutions">
                                            Tümünü Görüntüle
                                        </a>
                                    </div>
                                </div>
                                <div class="grid-tile">

                                    <div class="event-image">
                                        <a href="body-hair/lash-brow-treatment">
                                            <img class="lazy" alt=""
                                                data-src="https://cdn.media.amplience.net/i/deciem/ORD-PCP-Body3?fmt=auto&$poi$&sm=aspect&w=500&aspect=4:3">
                                        </a>
                                    </div>


                                    <div class="event-name">
                                        <span>Kirpik ve Kaş Bakımları</span>
                                    </div>

                                    <div class="event-description">
                                        <span>Daha kalın, dolgun ve sağlıklı görünen kirpik ve kaşları desteklemek için
                                            formüle edilmiştir.</span>
                                    </div>

                                    <div class="amp_partial shop-cta">
                                        <a class="shop-arrow-link icon-arrow" href="body-hair/lash-brow-treatment">
                                            Tümünü Görüntüle
                                        </a>
                                    </div>
                                </div>
                                <div class="grid-tile">

                                    <div class="event-image">
                                        <a href="body-hair/lip-care">
                                            <img class="lazy" alt="Lip Care"
                                                data-src="https://cdn.media.amplience.net/i/deciem/ORD-PCP-Body2?fmt=auto&$poi$&sm=aspect&w=500&aspect=4:3">
                                        </a>
                                    </div>


                                    <div class="event-name">
                                        <span>Dudak Bakımı</span>
                                    </div>

                                    <div class="event-description">
                                        <span>Dudaklarınıza uzun süreli nemlendirme ve cilt bariyeri desteği
                                            sağlayın.</span>
                                    </div>

                                    <div class="amp_partial shop-cta">
                                        <a class="shop-arrow-link icon-arrow" href="body-hair/lip-care">
                                            Tümünü Görüntüle
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>



































































                    <div class="evensplitmodule_layout module-content">
                        <div class="evensplitmodule_left_panel">
                            <div class="content-body">
                                <h1 class="content-title">

                                    <span>Cilt Tonunu Eşitleme. Tüm Cilt Tonları İçin.</span>

                                </h1>


                                <div class="content-msg">
                                    Niasinamid %5 Yüz ve Vücut Emülsiyonu ile koyu lekelerin ve cilt tonu
                                    eşitsizliklerinin görünümünü hedefleyin.
                                </div>









                                <div class="amp_partial general-cta">

                                    <a class="btn-rounded-primary" href="/en-us/category/body-hair/all-body-hair">Şimdi
                                        Alışveriş Yapın</a>
                                </div>




                            </div>
                        </div>

                        <div class="evensplitmodule_right_panel">
                            <div class="content-image">


                                <a href="/en-us/category/body-hair/all-body-hair"><img
                                        src="/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dwbf330000/theordinary/plp/ORD-PLP-Body-50-50-Body.jpg"
                                        title="" alt="Even Skin Tone.  For All Skin Tones."></a>

                            </div>
                        </div>

                    </div>




                </div>


                <div class="search-results_items-side tab-content plp-search-products">
                    <div class="search-results_tab-pane" id="product-search-results" role="list"
                        aria-labelledby="pagePlpTitle">

                        <div class="col-12 p-0 tab-pane active product-tab-pane">







                            






                            <input type="hidden" name="wishlistEnabled" value="true" encoding="off">
                            <input type="hidden" class="wishlist-fill-heart-grid-url" id="wishlistUrl-grid"
                                value="/on/demandware.store/Sites-deciem-us-Site/en_US/Wishlist-WishlistFillIcon"
                                encoding="off">


                           




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
                                        var slotConfigurationUUID = '7fcc595439ddb68dcba8b1809f';
                                        var contextAUID = decodeHtml('theordinary-bodyhair');
                                        var contextSecondaryAUID = decodeHtml('');
                                        var contextAltAUID = decodeHtml('');
                                        var contextType = decodeHtml('');
                                        var anchorsArray = [];
                                        var contextAUIDs = contextAUID.split(separator);
                                        var contextSecondaryAUIDs = contextSecondaryAUID.split(separator);
                                        var contextAltAUIDs = contextAltAUID.split(separator);
                                        var contextTypes = contextType.split(separator);
                                        var slotName = decodeHtml('recently-viewed-slot');
                                        var slotConfigId = decodeHtml('recently-viewed-bodyhair-plp');
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
                            <div id="cq_recomm_slot-7fcc595439ddb68dcba8b1809f"></div>
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
<script defer type="text/javascript" src="/assets/js/jquery.min.js"></script>
<script defer type="text/javascript" src="/assets/js/vendors.js"></script>
<script defer type="text/javascript" src="/assets/js/js_main.js"></script>

    <script defer type="text/javascript" src="/assets/js/search.js"
        
        >
    </script>

    <script defer type="text/javascript" src="/assets/js/accordion.js"
        
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
    <noscript><iframe src="<?= BASE_URL ?>/ns?id=GTM-PSNCTZT&gtm_auth=at3rkKALywQckzT0tnSSvQ&gtm_preview=env-1&gtm_cookies_win=x"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script src="<?= BASE_URL ?>/assets/js/api.js?render=explicit&onload=onRecaptchaLoad" async="" defer=""></script><!-- Awin -->
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
        <script type='text/javascript' src='../../assets/js/bootstrap.min.js'
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
    <script src="<?= BASE_URL ?>/assets/js/dwac-21.7.js"
        type="text/javascript" async="async"></script><!-- CQuotient Activity Tracking (body_end-cquotient.js) -->
    <script src="<?= BASE_URL ?>/assets/js/gretel.min.js" type="text/javascript" async="async"></script>
</body>

</html>