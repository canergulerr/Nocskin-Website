<?php
include __DIR__ . '/config.php';
include_once __DIR__ . '/admin/includes/db.php';
include_once __DIR__ . '/includes/contact_helper.php';

$contactSettings = [];
$contactPhones = [];

if (isset($pdo)) {
    $contactSettings = getContactSettings($pdo);
    $contactPhones = getContactPhones($pdo);
}
?>
<!--[if IE 8]>
<html class="ie8" lang="en">
<![endif]-->
<!--[if IE 9]>
<html class="ie9" lang="en">
<![endif]-->
<!--[if gt IE 9]><!-->
<!DOCTYPE html>
<html lang="en">

<head>
    <!--[if gt IE 9]><!-->
    <script>//common/scripts.isml</script>
    <script defer="" type="text/javascript"
        src="<?= BASE_URL ?>/assets/js/jquery.min.js"></script>
    <script defer="" type="text/javascript"
        src="<?= BASE_URL ?>/assets/js/vendors.js"></script>
    <script defer="" type="text/javascript"
        src="<?= BASE_URL ?>/assets/js/js_main.js"></script>

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
        Contact Us | The Ordinary
    </title>

    <meta name="description"
        content="Our Customer Happiness team is here to help. Please reach out to us with any questions you may have.">
    <meta name="keywords" content="deciem customer service number, contact deciem, contact the ordinary">







    <meta property="og:image"
        content="https://theordinary.com/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw665025d6/theordinary/homepage/slotA/heroes-slot-a-mobile.jpg">
    <meta property="og:title" content="The Ordinary | Clinical Formulations with Integrity">
    <meta property="og:description"
        content="The Ordinary is your destination for Skincare, Makeup, Hair, and Body solutions. Discover clinical formulations with integrity.">










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
        href="<?= BASE_URL ?>/assets/css/contactUs.css">









    <link rel="canonical" href="contact-us">






    <script src="<?= BASE_URL ?>/assets/js/widget.js" defer=""></script>


    </head>

<body data-brand="theordinary">

    <div class="page js-page" data-action="Page-Show" data-querystring="cid=contact-us" data-country-redirect="">
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


        <?php
        include BASE_PATH . '/header.php'; ?>


        <div role="main" id="maincontent">


            <!-- dwMarker="content" dwContentID="80d14e9881be4e5b9a568556d1" -->
            <div class="contact-us ">

                <div class="deciem-logo-container">

                    <a class="logo-link" href="<?= BASE_URL ?>/index.php" title="Home page link">

                        <img class="deciem-logo d-none d-lg-block"
                            src="<?= !empty($contactSettings['logo_image']) ? htmlspecialchars($contactSettings['logo_image']) : 'https://theordinary.com/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw11b93411/deciem/logo.svg' ?>"
                            alt="Home page link">

                    </a>

                </div>

                <div class="contact-us_questions">

                    <div class="contact-us_questions">
                        <div class="background-cover">
                            <img class="background-cover_image tower position-relative"
                                src="<?= !empty($contactSettings['bg_image_tower']) ? htmlspecialchars($contactSettings['bg_image_tower']) : 'https://theordinary.com/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw46fdb508/contact-us/Tower.jpg' ?>"
                                alt="tower image">
                        </div>
                        <div class="background-cover">
                            <img class="background-cover_image frequency position-relative"
                                src="<?= !empty($contactSettings['bg_image_frequency']) ? htmlspecialchars($contactSettings['bg_image_frequency']) : 'https://theordinary.com/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw6d7976e6/contact-us/Frequency.svg' ?>"
                                alt="frequency image">
                        </div>
                        <div class="row">
                            <h1 class="contact-us_questions-heading col-12 col-lg-3 position-relative mb-0">How can we
                                help?</h1> <a class="faqs-link mb-5" href="faq" title="FAQ">FAQ.</a>

                        </div>
                        <div class="d-flex align-items-center position-relative mb-4">
                            <p class="topic-title text-uppercase mr-3 pb-0">Select a topic</p>
                            <p class="black-line mb-0"></p>
                        </div>
                        <div class="contact-us_questions-topics position-relative" id="contactUsAccordion">
                            <?php
                            // Already included at top
                            if (isset($pdo)) {
                                $contactCategories = getContactCategoriesWithLinks($pdo);
                                $totalCats = count($contactCategories);
                                $half = ceil($totalCats / 2);
                                $chunks = array_chunk($contactCategories, $half > 0 ? $half : 1);
                            } else {
                                $chunks = [];
                            }
                            ?>
                            <div class="row">
                                <?php foreach ($chunks as $chunk): ?>
                                    <div class="col-12 col-lg-5">
                                        <?php foreach ($chunk as $cat): ?>
                                            <?php $catSlug = makeSlug($cat['title']); ?>
                                            <div class="pink-dot mb-4"></div>
                                            <h2 class="contact-us_questions-subheading position-relative text-capitalize"
                                                id="<?php echo $catSlug; ?>Accordion" data-toggle="collapse"
                                                data-target="#<?php echo $catSlug; ?>Collapse">
                                                <?php echo htmlspecialchars($cat['title']); ?>
                                                <button
                                                    class="btn btn-link d-lg-none contact-us_questions-subheading_toggle-btn collapsed"
                                                    data-toggle="collapse" data-target="#<?php echo $catSlug; ?>Collapse"
                                                    aria-expanded="false" aria-controls="<?php echo $catSlug; ?>Collapse"
                                                    aria-hidden="true" title="Open navigation accordion"></button>
                                            </h2>
                                            <div class="collapse d-lg-block" id="<?php echo $catSlug; ?>Collapse"
                                                aria-labelledby="<?php echo $catSlug; ?>Accordion"
                                                data-parent="#contactUsAccordion">
                                                <ul class="list-unstyled">
                                                    <?php foreach ($cat['links'] as $link): ?>
                                                        <li class="contact-us_questions-question">
                                                            <a href="<?php echo htmlspecialchars($link['url']); ?>">
                                                                <?php echo htmlspecialchars($link['title']); ?>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="contact-us_need-cs-container">
                        <h2 class="heading text-capitalize">
                            <?= !empty($contactSettings['cs_title']) ? htmlspecialchars($contactSettings['cs_title']) : 'Need Customer Service?' ?>
                        </h2>
                        <p class="hour-info pb-0">
                            <?= !empty($contactSettings['cs_hours']) ? htmlspecialchars($contactSettings['cs_hours']) : 'Mon - Fri 9:30AM - 5:00PM EST' ?>
                        </p>
                        <div class="pink-dot mb-4"></div>
                        <div class="toll-free-container row">
                            <?php foreach ($contactPhones as $phone): ?>
                                <div class="col-6 col-lg-4">
                                    <p class="title text-capitalize mb-1"><?= htmlspecialchars($phone['title']) ?></p>
                                    <p class="phone-number text-capitalize"><?= htmlspecialchars($phone['phone_number']) ?>
                                    </p>
                                    <p class="country text-uppercase mb-0"><?= htmlspecialchars($phone['country_name']) ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="contact-us_media">
                        <div class="col-1 d-flex align-items-center mb-4 pl-0">
                            <p class="topic-title text-uppercase mr-3 pb-0">Media or distribution</p>
                            <p class="black-line mb-0"></p>
                        </div>
                        <div class="media-topics row">
                            <div class="col-12 col-lg-5">
                                <div class="pink-dot mb-4"></div> <a
                                    href="<?= !empty($contactSettings['media_url']) ? htmlspecialchars($contactSettings['media_url']) : '#' ?>"
                                    title="Contact us for Media">
                                    <h2 class="contact-us_questions-subheading position-relative mb-lg-0">
                                        <?= !empty($contactSettings['media_title']) ? htmlspecialchars($contactSettings['media_title']) : 'Contact us for Media' ?>
                                    </h2>
                                </a>

                            </div>
                            <div class="col-12 col-lg">
                                <div class="pink-dot mb-4"></div> <a
                                    href="<?= !empty($contactSettings['dist_url']) ? htmlspecialchars($contactSettings['dist_url']) : '#' ?>"
                                    title="Contact us for Distribution">
                                    <h2 class="col-10 contact-us_questions-subheading position-relative px-0 mb-lg-0">
                                        <?= !empty($contactSettings['dist_title']) ? htmlspecialchars($contactSettings['dist_title']) : 'Contact us for Distribution' ?>
                                    </h2>
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="contact-us_store-image-container d-flex justify-content-center" style="height: auto !important;">
                        <img class="store-image img-fluid" style="max-height: 600px !important;"
                            src="<?= !empty($contactSettings['store_image']) ? htmlspecialchars($contactSettings['store_image']) : 'https://theordinary.com/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dwe8b8899f/contact-us/StoreImage.jpg' ?>"
                            alt="store image">
                    </div>
                </div>
                <!-- END_dwmarker -->

            </div>

            <?php include __DIR__ . '/config.php';
            include BASE_PATH . '/footer.php'; ?>

        </div>
        <div class="error-messaging"></div>
        <div class="modal-background js-modal-background"></div>



        <?php include BASE_PATH . '/includes/search-drawer.php'; ?>





        <!--[if lt IE 10]>
<script>//common/scripts.isml</script>
<script defer type="text/javascript" src="<?= BASE_URL ?>/assets/js/jquery.min.js"></script>
<script defer type="text/javascript" src="<?= BASE_URL ?>/assets/js/vendors.js"></script>
<script defer type="text/javascript" src="/assets/js/js_main.js"></script>

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
        <script src="<?= BASE_URL ?>/assets/js/api.js?render=explicit&onload=onRecaptchaLoad" async=""
            defer=""></script>
        <!-- Awin -->
        <script defer="defer" src="<?= BASE_URL ?>/assets/js/29849.js" type="text/javascript"></script><!-- End Awin -->
        <!-- ShopMy -->
        <script defer="defer" src="<?= BASE_URL ?>/assets/js/sms_aff_clicktrack-deciem.js"
            type="text/javascript"></script>
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
            data-urlmodalcontent="<?= BASE_URL ?>/on/demandware.store/Sites-deciem-us-Site/en_US/ConsentTracking-GetContent?cid=tracking_settings"
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
    </div>
</body>

</html>