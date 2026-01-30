<?php include dirname(__DIR__) . '/config.php'; ?>
<!DOCTYPE html>
<html lang="en" data-preferences="" data-contenturl="/on/demandware.store/Sites-deciem-us-Site/en_US/Page-GetContent">

<head>
    <!--[if gt IE 9]><!-->
    <script>
        // Force all Shadow DOMs to be open so we can access them
        (function () {
            const originalAttachShadow = Element.prototype.attachShadow;
            Element.prototype.attachShadow = function (init) {
                if (init && init.mode === 'closed') {
                    init.mode = 'open';
                }
                return originalAttachShadow.call(this, init);
            };
        })();
    </script>
    <script>//common/scripts.isml</script>
    <script defer="" type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script defer="" type="text/javascript" src="../assets/js/vendors.js"></script>
    <script defer="" type="text/javascript" src="../assets/js/js_main.js"></script>

    <script defer="" type="text/javascript"
        src="https://d1v04h6vhv8d4p.cloudfront.net/releases/latest/ordinary-periodic-bs.iife.js">
        </script>

    <!-- <script defer="" type="text/javascript" src="../assets/js/bv.js">
    </script> -->






    <script type="text/javascript" src="../assets/js/main.js"></script>
    <script type="text/javascript">
        window.OrdergrooveTrackingUrl = "/on/demandware.store/Sites-deciem-us-Site/en_US/OrderGroove-PurchasePostTracking"
    </script>

    <script type="text/javascript">
        window.OrdergrooveLegacyOffers = false
    </script>

    <script>
        (function() {
            // console.log("Translation script v6 STARTING");

            const observerConfig = { childList: true, subtree: true, characterData: true };
            const observedRoots = new WeakSet();

            function runTranslation() {
                if (!document.body) {
                    setTimeout(runTranslation, 100);
                    return;
                }

                function translateDetails(root) {
                    const walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, null, false);
                    let node;
                    while (node = walker.nextNode()) {
                        const parent = node.parentElement;
                        // SECURITY/LOGIC FIX: unexpected self-replacement if we match script content
                        if (!parent || parent.tagName === 'SCRIPT' || parent.tagName === 'STYLE') {
                            continue;
                        }

                        const text = node.nodeValue;
                        if (text && text.includes("scientific table") && text.includes("zero science")) {
                            // console.log("Found target text in:", parent.tagName);
                            try {
                                parent.textContent = "Sıfır bilimsellik içeren bilimsel bir tablo.";
                                parent.style.visibility = 'visible';
                                // console.log("Replaced text successfully");
                            } catch(e) {
                                // console.error("Error replacing text", e);
                            }
                        }
                    }
                }

                function scanAndObserve(root) {
                    if (!root) return;
                    translateDetails(root);

                    const allElements = root.querySelectorAll('*');
                    allElements.forEach(el => {
                        if (el.shadowRoot && !observedRoots.has(el.shadowRoot)) {
                            observeRoot(el.shadowRoot);
                        }
                    });
                }

                function observeRoot(root) {
                    if (!root || observedRoots.has(root)) return;
                    observedRoots.add(root);
                    
                    const obs = new MutationObserver((mutations) => {
                        scanAndObserve(root);
                    });
                    obs.observe(root, observerConfig);
                    scanAndObserve(root);
                }

                observeRoot(document.body);
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', runTranslation);
            } else {
                runTranslation();
            }
        })();
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
        The Periodic Fable
    </title>

    <meta name="description" content="DECIEM">
    <meta name="keywords" content="DECIEM">







    <meta property="og:image"
        content="https://theordinary.com/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw665025d6/theordinary/homepage/slotA/heroes-slot-a-mobile.jpg">
    <meta property="og:title" content="The Ordinary | Clinical Formulations with Integrity">
    <meta property="og:description"
        content="The Ordinary is your destination for Skincare, Makeup, Hair, and Body solutions. Discover clinical formulations with integrity.">










    <!-- Favicon for ICO file format -->
    <link rel="icon"
        href="../on/demandware.static/Sites-deciem-us-Site/-/default/dw111bf775/images/favicons/favicon-theordinary.ico"
        type="image/x-icon">

    <!-- Favicon for PNG file format -->
    <link rel="icon"
        href="../on/demandware.static/Sites-deciem-us-Site/-/default/dw9d699b3f/images/favicons/favicon-theordinary.png"
        type="image/png">

    <!-- Apple Touch Icon (iOS Devices) -->
    <link rel="apple-touch-icon"
        href="../on/demandware.static/Sites-deciem-us-Site/-/default/dw58e5b677/images/favicons/favicon-theordinary-apple-touch-icon.png">

    <!-- For different sizes and devices, you can specify multiple favicons -->
    <link rel="icon" sizes="32x32"
        href="../on/demandware.static/Sites-deciem-us-Site/-/default/dwdf569b1d/images/favicons/favicon-theordinary-32x32.png">
    <link rel="icon" sizes="16x16"
        href="../on/demandware.static/Sites-deciem-us-Site/-/default/dw99ff95b6/images/favicons/favicon-theordinary-16x16.png">

    <!-- Favicon for Safari Pinned Tab -->
    <link rel="mask-icon"
        href="../on/demandware.static/Sites-deciem-us-Site/-/default/dwabed6e93/images/favicons/favicon-theordinary.svg"
        color="#000000">



    <link rel="stylesheet" href="../assets/css/bootstrap.css">


    <link rel="stylesheet" href="../assets/css/icons-font.css">


    <link rel="stylesheet" href="../assets/css/global.css">











    <link rel="canonical" href="the-periodic-fable">






    <script src="../assets/js/widget.js" defer=""></script>


    <style>
        @media (min-width: 1024px) {
            div.page {
                padding-top: 115px !important;
            }
        }

        @media (max-width: 1023px) {
            div.page {
                padding-top: 75px !important;
            }
        }
    </style>
</head>

<body data-brand="theordinary">

    <div class="page js-page" data-action="Page-Show" data-querystring="cid=the-periodic-fable"
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


            <!-- dwMarker="content" dwContentID="247a2e1a7a05c48bb62470ee52" -->
            <ordinary-tpf></ordinary-tpf>
            <!-- END_dwmarker -->

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

    <script defer type="text/javascript" src="https://d1v04h6vhv8d4p.cloudfront.net/releases/latest/ordinary-periodic-bs.iife.js"
        
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
    <noscript><iframe src="../ns?id=GTM-PSNCTZT&gtm_auth=at3rkKALywQckzT0tnSSvQ&gtm_preview=env-1&gtm_cookies_win=x"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script src="../assets/js/api.js?render=explicit&onload=onRecaptchaLoad" async="" defer=""></script><!-- Awin -->
    <script defer="defer" src="../assets/js/29849.js" type="text/javascript"></script><!-- End Awin -->
    <!-- ShopMy -->
    <script defer="defer" src="../assets/js/sms_aff_clicktrack-deciem.js" type="text/javascript"></script>
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
        <script type='text/javascript' src='../assets/js/bootstrap.min.js' onload='initEmbeddedMessaging()'></script>
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
    <script type="text/javascript" src="../assets/js/dwanalytics-22.2.js" async="async" onload="trackPage()"></script>
    <!-- Demandware Active Data (body_end-active_data.js) -->
    <script src="../assets/js/dwac-21.7.js" type="text/javascript" async="async"></script>
    <!-- CQuotient Activity Tracking (body_end-cquotient.js) -->
    <script src="../assets/js/gretel.min.js" type="text/javascript" async="async"></script>
<script>
(function() {
    // 1. AYARLAR
    const customLogoUrl = 'https://nocskin.com.tr/assets/images/periodic.png'; 

    // 2. KUTU İÇİ AÇIKLAMALAR (GİZLİ İNGİLİZCE -> GÖRÜNEN TÜRKÇE)
    const kutuSozlugu = {
        // 1-10
        "When used in skincare, the term 'flawless' contains one flaw": "Kusursuz cilt bir cilt tipi değildir. Cilt yaşayan bir dokudur, gözenekleri vardır ve nefes alır.",
        "While some invest in luxury packaging": "Lüks ambalajlar her zaman lüks içerik anlamına gelmez. Biz bilime ve erişilebilir fiyata inanıyoruz.",
        "The cold hard truth?": "Soğuk gerçek şu: Kozmetik prosedürler 'yağı dondurabilir' ancak vücut bakım ürünleri bunu yapamaz.",
        "Without a regulated definition": "Düzenlenmiş bir tanımı olmadığı için, bu terim önlük giymiş pazarlamadan başka bir şey değildir.",
        "Wrinkles can be softened": "Kırışıklıklar yumuşatılabilir ama asla silinemez. Ayrıca ince çizgiler gayet normaldir.",
        "There's no shame in scars": "Yara izlerinde utanılacak bir şey yoktur. Ancak bir serumun onları tamamen 'yok edebileceğini' iddia etmekte olabilir.",
        "If it's actually not from Korea": "Eğer gerçekten Kore'den gelmiyorsa, K harfi 'Kopyacı' anlamına gelir.",
        "If your pores disappeared": "Gözenekleriniz yok olsaydı, teriniz, tüyleriniz ve vücut ısınızı düzenleme yeteneğiniz de yok olurdu.",
        "If skin needs healing": "Cildin iyileşmeye ihtiyacı varsa ilaca ihtiyacı vardır, ışıltılı bir yüz maskesine değil.",
        "SYN-AKE is a synthetic peptide": "SYN-AKE sentetik bir peptittir, ancak 'yılan zehri' içerdiğini iddia eden markalar samimiyetsiz davranıyor.",
        
        // 11-20
        "Claiming an elixir is a cure all": "Bir iksirin her derde deva olduğunu iddia etmek fantezidir. Biz doğaüstü olaylar yerine bilime bağlı kalmayı tercih ediyoruz.",
        "Natural doesn't always mean safer": "Doğal her zaman daha güvenli demek değildir. Bazen akrepler ve deniz anaları anlamına gelir.",
        "A claim that a product is derm-recommended": "Bir ürünün dermatolog tarafından önerilmesi onu otomatik olarak iyi yapmaz. Gerçekleri kontrol edin. Bilimi kontrol edin.",
        "Studies show that aluminium is used at safe levels": "Çalışmalar alüminyumun kozmetiklerde güvenli seviyelerde kullanıldığını gösteriyor. Ancak korku genellikle gerçekten daha çok satar.",
        "There is no \"best\" in skincare": "Cilt bakımı biliminde 'en iyi' diye bir şey yoktur. Sadece sizin için en iyi çalışan vardır.",
        "Abracadabra is not a scientifically proven": "Abrakadabra bilimsel olarak kanıtlanmış bir içerik değildir. Biz kanıtlanmış olanlara odaklanmayı tercih ediyoruz.",
        "Skincare can do many things": "Cilt bakımı birçok şey yapabilir, ancak asla yanlış olmayan bir şeyi 'düzeltemez'.",
        "Nothing is chemical free": "Hiçbir şey kimyasalsız değildir. Boş bir şişedeki hava bile.",
        "Studies show parabens are safe": "Çalışmalar parabenlerin düzenlenmiş seviyelerde güvenli olduğunu gösteriyor. Satışlar ise yanlış bilginin ilgi çekmek için daha iyi olduğunu gösteriyor.",
        "Modern toxicology shows that just because something is old": "Modern toksikoloji, bir şeyin eski olmasının işe yarayacağı anlamına gelmediğini gösteriyor. Sonuçta kurşun ve cıva da antik içeriklerdir.",

        // 21-30
        "Another term used to artificially build hype": "Yapay bir heyecan yaratmak için kullanılan başka bir terim. Rüyadan ziyade bir efsane.",
        "The idea you have to be young": "Güzel olmak için genç olmanız gerektiği fikri, hepsinden büyük bir aldatmacadır.",
        "Cosmeceutical is unregulated": "Kozmesötik terimi düzenlenmemiştir, bu da onu anlamsız, mantıksız ve düpedüz şüpheli kılar.",
        "This is industry standard": "Bu bir endüstri standardıdır, ekstra bir ürün faydası değildir.",
        "Hercules and Achilles are legends": "Herkül ve Aşil efsanedir. Anlamsız reklamları dayatan pazarlama yöneticileri değil.",
        "Eternal youth belongs in fountains": "Sonsuz gençlik formüllere değil çeşmelere aittir. Sektörümüzün yaşlanma karşıtı takıntısı artık eskidi.",
        "We can't speak for anyone else": "Başkaları adına konuşamayız ama bizde cilt bakımı erişilebilirlik demektir; bu da heyecan yaratmak için erişimi kısıtlamak anlamına gelmez.",
        "There will always be waste produced": "Üretim sürecinde her zaman atık oluşacaktır. Bu saçmalıklara inanmayın.",
        "When used alone, \"Green\" tells you little": "Tek başına kullanıldığında 'Yeşil', bir ürünün çevre üzerindeki etkisi hakkında çok az şey söyler. Bazıları buna 'Yeşil Aklama' der.",
        "Free from toxins should be a basic requirement": "Toksin içermemek temel bir gereklilik olmalıdır, ek bir ürün faydası değil.",

        // 31-40
        "\"Rare\" rarely means \"more effective\"": "'Nadir' nadiren 'daha etkili' anlamına gelir, ancak daha pahalı anlamına gelebilir. Biz kanıtlanmış ve erişilebilir olanı tercih ediyoruz.",
        "Adding a celebrity name on a bottle": "Şişeye bir ünlü isminin eklenmesi, formülasyonun bilimsel etkinliğini değiştirmez.",
        "We could call our products \"secrets\"": "Ürünlerimize 'sır' diyebilirdik, biz sadece 'dürüstlükle klinik olarak test edilmiş formülasyonları' tercih ediyoruz.",
        "There are no scientifically proven benefits to not using preservatives": "Koruyucu kullanmamanın bilimsel olarak kanıtlanmış bir faydası yoktur, ancak küflü nemlendiricinin bazı dezavantajları vardır.",
        "Banning sulfates is harsh": "Sülfatları yasaklamak, doğru konsantrasyonda nazik temizleyiciler oldukları düşünüldüğünde sert bir tutumdur.",
        "Your skincare can't erase pores": "Cilt bakımınız gözenekleri silemez, ancak gerçekler bulanıklaştırılabilir.",
        "There's nothing calming about corporations": "Şirketlerin hızlı satış uğruna ruhani uygulamaları kullanmasında sakinleştirici hiçbir şey yoktur.",
        "\"Precious\" could mean more expensive": "'Değerli' daha pahalı anlamına gelebilir, daha etkili olması gerekmez. Biz abartılarla değil gerçeklerle konuşmayı tercih ediyoruz.",
        "\"Smart\" has no regulatory definition": "'Akıllı' kelimesinin yasal bir tanımı yoktur, bu yüzden pazarlamacılar bolca kullanır, bilim insanları ise asla.",
        "The idea that certain types of beauty are \"unclean\"": "Bazı güzellik türlerinin 'kirli' olduğu fikri faydasız, gerçek dışı ve denetimsizdir.",

        // 41-49
        "Whether it's made in a kitchen": "İster mutfakta ister fabrikada yapılsın, kozmetik formüle ederken kalite her zaman önce gelmelidir.",
        "Just because it's a superfood": "Süper gıda olması, cildiniz için otomatik olarak süper iyi olduğu anlamına gelmez. Her zaman testleri kontrol edin.",
        "Cosmetics can't provide \"therapy\"": "Kozmetikler 'terapi' sağlayamaz, yani buradaki en yoğun şey ödünç alınan tıbbi jargondur.",
        "All cosmetics are technically lab grade": "Tüm kozmetikler teknik olarak laboratuvar kalitesindedir. Olmasalardı, onları satamazdınız.",
        "The best skincare is free from the artificial fear": "En iyi cilt bakımı, yapay koruyucu korkusundan arınmış olandır. Raf ömrünü uzatır ve israfı azaltırlar.",
        "Whether or not you believe in miracles": "Mucizelere inanın ya da inanmayın, cilt bakımının etkinliği yine de bilimle kanıtlanır.",
        "\"Perfect\" is the perfect marketing word": "'Mükemmel' mükemmel bir pazarlama kelimesidir. Mükemmel derecede belirsiz, öznel ve aldatıcıdır.",
        "By definition, surfactants are simply molecules": "Yüzey aktif maddeler, karışmayan maddeleri bir araya getiren moleküllerdir. Onlara karşı korku yaratmak yersizdir.",
        "Crushed diamonds exfoliate just as well": "Ezilmiş elmaslar, pirinç tozu veya ezilmiş ceviz kadar iyi peeling yapar. Sadece gereksiz yere çok daha pahalıdırlar."
    };

    function fixEverything() {
        const root = document.querySelector('ordinary-tpf') || document.body;

        // ---------------------------------------------------------
        // A) "FROM EMPTY PROMISES" YAZISINI DÜZELT (EN ÖNEMLİ KISIM)
        // ---------------------------------------------------------
        // Sizin attığınız koddaki 'tpf:max-w-512' sınıfını hedefliyoruz. Nokta atışı.
        const heroDivs = root.querySelectorAll('.tpf\\:max-w-512'); // ':' karakteri kaçış (\) gerektirir
        
        heroDivs.forEach(div => {
            // İçinde "From" ve "empty" geçiyorsa o kutudur.
            if (div.textContent.includes('From') && div.textContent.includes('empty')) {
                // Eğer zaten Türkçe değilse değiştir
                if (!div.textContent.includes('Uzun süredir')) {
                    // Animasyonlu karmaşık yapıyı sil, temiz Türkçe bas.
                    div.innerHTML = `<div style="text-align:center; padding: 0 10px; font-size: 1.2em; line-height: 1.5; color: inherit;">
                        Uzun süredir sektörümüz bize yanlış güzellik öğretileri sundu; boş vaatler, imkansız standartlar ve abartılı içerikler.
                    </div>`;
                }
            }
        });

        // ---------------------------------------------------------
        // B) SVG LOGOYU DEĞİŞTİR
        // ---------------------------------------------------------
        const allSvgs = document.querySelectorAll('svg');
        allSvgs.forEach(svg => {
            const title = svg.querySelector('title');
            if (title && title.textContent.includes('Beauty Scams')) {
                const parentLink = svg.closest('a');
                if (parentLink && !parentLink.classList.contains('js-replaced')) {
                    svg.style.display = 'none';
                    const newLogo = document.createElement('img');
                    newLogo.src = customLogoUrl;
                    newLogo.style.width = '100%';
                    newLogo.style.maxWidth = '300px';
                    newLogo.style.display = 'block';
                    newLogo.style.margin = '0 auto';
                    parentLink.appendChild(newLogo);
                    parentLink.classList.add('js-replaced');
                    parentLink.style.display = 'flex';
                    parentLink.style.flexDirection = 'column';
                    parentLink.style.alignItems = 'center';
                    parentLink.style.justifyContent = 'center';
                }
            }
        });

        // ---------------------------------------------------------
        // C) KUTU İÇİ AÇIKLAMALARI DÜZELT
        // ---------------------------------------------------------
        // Gizli (sr-only) metni bul, yanındaki görüneni değiştir.
        const hiddenSpans = root.querySelectorAll('span.tpf\\:sr-only');
        hiddenSpans.forEach(hiddenSpan => {
            const englishText = hiddenSpan.textContent.trim();
            for (const key in kutuSozlugu) {
                if (englishText.includes(key)) {
                    const visibleSibling = hiddenSpan.nextElementSibling;
                    // Eğer yanında görünen bir kardeş varsa ve aria-hidden ise
                    if (visibleSibling && visibleSibling.getAttribute('aria-hidden') === 'true') {
                        // Türkçe değilse değiştir
                        if (!visibleSibling.textContent.includes(kutuSozlugu[key])) {
                            visibleSibling.innerHTML = `<p style="font-size: 1.2em; line-height: 1.5;">${kutuSozlugu[key]}</p>`;
                        }
                    }
                }
            }
        });

        // ---------------------------------------------------------
        // D) BUTONU DÜZELT
        // ---------------------------------------------------------
        const buttons = root.querySelectorAll('a[href="#/table"]');
        buttons.forEach(btn => {
            if (btn.textContent.indexOf('GERÇEKLERİ KEŞFET') === -1) {
                 const newText = 'GERÇEKLERİ KEŞFET';
                 const svgIcon = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="tpf:-mr-8"><path d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="1.5"></path></svg>';
                 btn.innerHTML = newText + svgIcon;
            }
        });
        
        // Shadow DOM varsa içine de bak (Recursive)
        const allElements = root.querySelectorAll('*');
        allElements.forEach(el => {
            if (el.shadowRoot) {
                // Shadow root için fonksiyonu tekrar çağırmak yerine, 
                // basitçe o kök içinde aynı işlemleri yapan minik bir loop yeterli olur 
                // ama şimdilik ana DOM yeterli görünüyor. Gerekirse burası açılabilir.
            }
        });
    }

    // --- ZAMANLAYICI (Hızlı ve sürekli kontrol) ---
    setInterval(fixEverything, 200);

})();
</script>
</body>

</html>
