<?php include __DIR__ . '/config.php'; ?>
<?php  ?>

<header class="header_wrap js-header theordinary"><a href="#maincontent" class="skip" aria-label="Skip to main content">Skip to main content</a><a href="#footercontent" class="skip" aria-label="Skip to footer content">Skip to footer content</a>
    <nav class="main-nav" aria-label="Main Navigation">
        <div class="header">
            <div class="header__top">
                <div class="promo-messages-slider-holder w-100 position-absolute d-flex justify-content-center align-items-center">
                    <button class="promo-slick-prev promo-slick-prev icon-left_chevron position-relative align-self-end">
                        <span class="sr-only">Previous</span>
                    </button>
                    <div class="js-promo-messages-slider d-inline-block text-center w-100 p-md-0">
                        <div class="promo-message">
                            <span class="promo-message-text mb-0">Tüm siparişlerde karbon nötr kargo.</span>
                        </div>
                        <div class="promo-message">
                            <span class="promo-message-text mb-0">250 TL üzeri siparişlerde ücretsiz kargo</span>
                        </div>
                        <div class="promo-message">
                            <span class="promo-message-text mb-0"><a href="#">Muhteşem Kasım geliyor.</a></span>
                        </div>
                    </div>
                    <button class="promo-slick-next icon-right_chevron position-relative align-self-end">
                        <span class="sr-only">Next</span>
                    </button>
                </div>
                <div class="icons header__service-menu js-header-service-menu">
                    <div class="search">
                        <button class="site-search-button  js-search-button icon-search" aria-label="Open search form" title="Open search form"><span class="d-none">Open search form</span>
                        </button>
                    </div>
                    <!--
                    <a href="en-us/find-us" class="icon-store-locator"></a>
                    <div class="account">
                        <div class="user"><a class="user-link icon-account" href="en-us/login" aria-haspopup="false" aria-label="Login to your account" title="Login"> <span class="sr-only user-message">Login</span> </a>
                        </div>
                    </div>
                    <div class="minicart" data-action-url="/neatordinary/on/demandware.store/Sites-deciem-us-Site/en_US/Cart-MiniCartShow">
                        <div class="minicart-total drawer-trigger"><a class="minicart-link icon-cart" href="en-us/cart" title="Cart 0 Items" aria-label="Cart 0 Items" aria-haspopup="true"> <span class="minicart-quantity">
0 </span> </a>
                        </div>

                        <div class="popover popover-bottom drawer-container"></div>
                    </div>
-->
                </div>
            </div>
            <div class="navbar-header d-flex d-lg-none">
                <button class="navbar-toggler icon-menu" type="button" aria-controls="sg-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation" name="Open menu navigation" title="Open menu navigation">
                </button>
                <div class="theordinary-mobile-logo no-click"><a href="<?= BASE_URL ?>/"> <img src="/on/demandware.static/Sites-deciem-us-Site/-/default/dwbf417386/images/brands-logo/theOrdinary-logo.svg" alt="The Ordinary"> </a>
                </div>
            </div>
        </div>
        <div class="main-menu navbar-toggleable-sm menu-toggleable-left multilevel-dropdown d-lg-block" id="sg-navbar-collapse">
            <div class="brands_and_locale d-none d-lg-block">
                <nav class="brands-nav hidden-md-down" aria-label="brands navigation">
                    <ul class="dropdown-menu brands-list" role="menu">
                        <li class="brands-item brands-item--active" role="menuitem"><a href="https://nocskin.com.tr" class="brands-link brand_theordinary"> <img class="brands-item-logo" src="/on/demandware.static/Sites-deciem-us-Site/-/default/dw04f3255d/images/brands-logo/theordinary_black.svg" title="theordinary" alt="theordinary logo">
                                Noc  </a>
                        </li>
                        <li class="brands-item" role="menuitem"><a href="https://neatordinary.com/" class="brands-link brand_niod" rel='nofollow'> <img class="brands-item-logo" src="/on/demandware.static/Sites-deciem-us-Site/-/default/dwaf34ce59/images/brands-logo/niod_black.svg" title="niod" alt="niod logo">
                                Neat Ordinary  </a>
                        </li>
                        <li class="brands-item" role="menuitem"><a href="https://themedicus.com.tr" class="brands-link brand_loopha" rel='nofollow'> <img class="brands-item-logo" src="/on/demandware.static/Sites-deciem-us-Site/-/default/dw265a4cd3/images/brands-logo/loopha_black.svg" title="loopha" alt="loopha logo">
                                The Medicus  </a>
                        </li>
                       <!-- <li class="brands-item" role="menuitem"><a href="https://roscher.com.tr" class="brands-link brand_deciem" rel='nofollow'> <img class="brands-item-logo" src="/on/demandware.static/Sites-deciem-us-Site/-/default/dw951253d9/images/brands-logo/deciem_black.svg" title="deciem" alt="deciem logo">
                                Dr. Roscher  </a>
                        </li>-->
                        <li class="brands-item" role="menuitem"><a href="#" class="brands-link brand_deciem" rel='nofollow'> <img class="brands-item-logo" src="/on/demandware.static/Sites-deciem-us-Site/-/default/dw951253d9/images/brands-logo/fharmacy_black.jpg" title="fharmacy" alt="fharmacy logo">
                                FHARMACY  </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <nav class="navbar navbar-expand-lg bg-inverse col-12">
                <div class="close-menu clearfix d-lg-none">
                    <div class="js-close-button close-button pull-left d-xl-none burger_close">
                        <button role="button" aria-label="Close Menu" class="burger_close-btn icon-close" title="Close menu navigation" name="Close menu navigation">
                            Close
                        </button>
                    </div>
                    <div class="active_brand_logo d-lg-none">
                        <div class="theordinary-mobile-logo inner-logo"><a href="<?= BASE_URL ?>/"> <img src="/on/demandware.static/Sites-deciem-us-Site/-/default/dwbf417386/images/brands-logo/logo.png" alt="The Ordinary"> </a>
                        </div>
                    </div>
                    <div class="navbar__service-menu pull-right">
                        <div class="search">
                            <button class="site-search-button js-search-button icon-search" aria-label="Open search form" title="Open search form" name="Open search form"><span class="d-none">Open search form</span>
                            </button>
                        </div><a href="/en-us/find-us" class="icon-store-locator"></a><a class="user-link icon-account hi" href="/en-us/login" aria-haspopup="false" aria-label="Login to your account" title="Login"> <span class="sr-only user-message">Login</span> </a>
                        <div class="minicart" data-action-url="/neatordinary/on/demandware.store/Sites-deciem-us-Site/en_US/Cart-MiniCartShow">
                            <div class="minicart-total drawer-trigger"><a class="minicart-link icon-cart" href="/en-us/cart" title="Cart 0 Items" aria-label="Cart 0 Items" aria-haspopup="true"> <span class="minicart-quantity">
0 </span> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-group">
                    <div class="menu-group--wrapper">
                        <div class="theordinary-logo d-none d-lg-block no-click"><a href="<?= BASE_URL ?>/"> <img src="/on/demandware.static/Sites-deciem-us-Site/-/default/dwbf417386/images/brands-logo/noc-logo.png" alt="Noc Masaüstü Logo"> </a>
                        </div>
                        <ul class="nav navbar-nav" role="menu">
                            <li class="nav-item  no_selected theordinary-bestsellers" role="menuitem"><a title="En Çok Satanlar" href="/en-us/category/best-sellers" id="theordinary-bestsellers" class="nav-link "> <span class="link-text">
En Çok Satanlar </span> </a>
                            </li>
                            <li class="nav-item dropdown  no_selected theordinary-newfeatured" role="menuitem"><a aria-title="New &amp; Featured" href="/en-us/category/newfeatured" id="theordinary-newfeatured" class="nav-link dropdown-toggle pane-nav-link" role="button" data-toggle="dropdown" tabindex="0" aria-haspopup="true" aria-expanded="false"> <span class="link-text">
Yeni ve Öne Çıkanlar </span> <span class="icon-right_chevron d-lg-none"></span> </a>
                                <div class="mobile mobile-slide-pane" id="slide-pane-theordinary-newfeatured" hidden="">
                                    <div class="back-container"><span class="icon-left_chevron back-button d-lg-none"></span><span class="name">
Yeni ve Öne Çıkanlar </span>
                                    </div>
                                    <ul class="dropdown-menu js-dropdown-menu d-lg-none" role="menu" aria-hidden="true" aria-label="New &amp; Featured">
                                        <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/new" id="theordinary-newreleases" role="menuitem" class="dropdown-link theordinary-newreleases">Yeni Çıkanlar  </a>
                                        </li>
                                        <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/best-sellers" id="theordinary-new-bestseller" role="menuitem" class="dropdown-link theordinary-new-bestseller">En Çok Satanlar  </a>
                                        </li>
                                        <li class="js-dropdown-item dropdown-item dropdown order-2" role="menuitem"><a href="/en-us/category/gifts" id="theordinary-gifts" class="dropdown-link dropdown-toggle theordinary-gifts" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hediyeler  <sup class="menuitem-featureflag">
                                                    New </sup>  </a>
                                            <ul class="dropdown-menu" role="menu" aria-hidden="true" aria-label="Gifts">
                                                <li class="js-dropdown-item dropdown-item show-mobile-only order-2" role="menuitem"><a href="/en-us/category/gifts" id="theordinary-all-gifts" role="menuitem" class="dropdown-link theordinary-all-gifts">All Gifts  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/gifts/gift-sets" id="theordinary-gift-sets" role="menuitem" class="dropdown-link theordinary-gift-sets">Hediye Setleri  </a>
                                                </li>
                                                <div class="flyout"><a href="/en-us/ingredients-book-100735"> <img class="lazy" data-src="<?= BASE_URL ?>/assets/images/noc-menu-kucuk.png" title="" alt="Ingredients by The Ordinary."> <p>Ön Siparişe Açık.</p> <p>Noc'un İçerikleri.</p> </a>
                                                </div>
                                            </ul>
                                        </li>
                                        <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/fond-farewell" id="theordinary-fondfarewell" role="menuitem" class="dropdown-link theordinary-fondfarewell">Sevgi Dolu Veda  </a>
                                        </li>
                                        <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/newfeatured#product-search-results" id="theordinary-new-featured-shopall" role="menuitem" class="dropdown-link theordinary-new-featured-shopall">Shop All Products  </a>
                                        </li>
                                        <div class="flyout"><a href="/en-us/ingredients-book-100735"> <img class="lazy" data-src="<?= BASE_URL ?>/assets/images/noc-menu-kucuk.png" title="" alt="Ingredients by The Ordinary."> <p>Ön Siparişe Açık.</p> <p>Noc'un İçerikleri.</p> </a>
                                        </div>
                                    </ul>
                                </div>
                                <div class="desktop">
                                    <div class="dropdown-menu  js-dropdown-menu theordinary-newfeatured" role="menu" aria-hidden="true" aria-label="New &amp; Featured">
                                        <div class="inner">
                                            <ul class="main-category" role="menu" aria-hidden="true" aria-label="New &amp; Featured">
                                                <li class="" role="menuitem"><a href="/en-us/category/new" id="theordinary-newreleases" role="menuitem" class="menuitem-subcategory">Yeni Çıkanlar</a>
                                                </li>
                                                <li class="" role="menuitem"><a href="/en-us/category/best-sellers" id="theordinary-new-bestseller" role="menuitem" class="menuitem-subcategory">En Çok Satanlar</a>
                                                </li>
                                                <li class="" role="menuitem"><a href="/en-us/category/fond-farewell" id="theordinary-fondfarewell" role="menuitem" class="menuitem-subcategory">Sevgi Dolu Veda</a>
                                                </li>
                                                <li class="" role="menuitem"><a href="/en-us/category/newfeatured#product-search-results" id="theordinary-new-featured-shopall" role="menuitem" class="menuitem-subcategory">Shop All Products</a>
                                                </li>
                                            </ul>
                                            <ul class="sub-category " role="menu" aria-hidden="true" aria-label="Gifts">
                                                <li class="" role="menuitem"><a aria-title="Gifts" href="#" id="theordinary-gifts"> <span id="theordinary-gifts" class="">Hediyeler</span> </a>
                                                    <ul class="" role="menu" aria-label="Gifts">
                                                        <li class="" role="menuitem"><a href="/en-us/category/gifts/gift-sets" id="theordinary-gift-sets" role="menuitem" class="menuitem-subcategory">Hediye Setleri</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <div class="flyout"><a href="#"> <img class="lazy" data-src="<?= BASE_URL ?>/assets/images/noc-menu-kucuk.png" title="" alt="Ingredients by The Ordinary."> <p>Ön Siparişe Açık.</p> <p>Noc'un İçerikleri.</p> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown  no_selected theordinary-skincare" role="menuitem"><a aria-title="Skincare" href="/en-us/category/noc-skincare" id="theordinary-skincare" class="nav-link dropdown-toggle pane-nav-link" role="button" data-toggle="dropdown" tabindex="0" aria-haspopup="true" aria-expanded="false"> <span class="link-text">
Cilt Bakımı </span> <span class="icon-right_chevron d-lg-none"></span> </a>
                                <div class="mobile mobile-slide-pane" id="slide-pane-theordinary-skincare" hidden="">
                                    <div class="back-container"><span class="icon-left_chevron back-button d-lg-none"></span><span class="name">
Cilt Bakımı </span>
                                    </div>
                                    <ul class="dropdown-menu js-dropdown-menu d-lg-none" role="menu" aria-hidden="true" aria-label="Skincare">
                                        <li class="js-dropdown-item dropdown-item dropdown order-1" role="menuitem"><a href="/en-us/category/skincare/shop-by-concern" id="theordinary-shop-by-concern" class="dropdown-link dropdown-toggle theordinary-shop-by-concern" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">İhtiyacına Göre Alışveriş Yapın  </a>
                                            <ul class="dropdown-menu" role="menu" aria-hidden="true" aria-label="Shop by Concern">
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/yaslanma-karsiti" id="theordinary-signs-of-aging" role="menuitem" class="dropdown-link theordinary-signs-of-aging">Yaşlanma Karşıtı & Sıkılaştırma  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/kirisiklik-ince-cizgi" id="theordinary-signs-of-aging" role="menuitem" class="dropdown-link theordinary-signs-of-aging">Kırışıklık & İnce Çizgi Bakımı  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/leke-karsiti-cilt-tonu-esitleme" id="theordinary-uneven-skin-tone" role="menuitem" class="dropdown-link theordinary-uneven-skin-tone">Leke Karşıtı & Cilt Tonu Eşitleme  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/gozenek-sikilastirma" id="theordinary-signs-of-congestion" role="menuitem" class="dropdown-link theordinary-signs-of-congestion">Gözenek Sıkılaştırma & Cilt Dokusu  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/sebum-dengeleme" id="theordinary-textural-irregularities" role="menuitem" class="dropdown-link theordinary-textural-irregularities">Sebum Dengeleme & Akne Eğilimli Ciltler  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/hassasiyet-kizariklik" id="theordinary-dryness" role="menuitem" class="dropdown-link theordinary-dryness">Hassasiyet & Kızarıklık Karşıtı Bakım  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/nemlendirme-bariyer-guclendirme" id="theordinary-eyecare" role="menuitem" class="dropdown-link theordinary-eyecare">Nemlendirme & Bariyer Güçlendirme  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/goz-cevresi-bakimi" id="theordinary-redness" role="menuitem" class="dropdown-link theordinary-redness">Göz Çevresi Bakımı  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/aninda-puruzsuzluk" id="theordinary-dullness" role="menuitem" class="dropdown-link theordinary-dullness">Anında Pürüzsüzlük & Canlı Görünüm  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/yorgun-mat-ciltler" id="theordinary-uv-protection" role="menuitem" class="dropdown-link theordinary-uv-protection">Yorgun & Mat Ciltler İçin Bakım  </a>
                                                </li>
                                               <!-- <li class="js-dropdown-item dropdown-item d-none order-2" role="menuitem"><a href="/en-us/category/skincare#product-search-results" id="theordinary-explore-skincare" role="menuitem" class="dropdown-link theordinary-explore-skincare">Shop All Skincare  </a>
                                                </li>-->
                                                <div class="flyout"><a href="/en-us/regimen-builder"> <img class="lazy" data-src="<?= BASE_URL ?>/assets/images/noc-menu-kucuk-2.png" title="" alt="Rejim Oluşturucumuzu Deneyin."> <p>Cildiniz, Bakım Rutininiz:</p> <p>Rejim Oluşturucumuzu Deneyin.</p> </a>
                                                </div>
                                            </ul>
                                        </li>
                                        <li class="js-dropdown-item dropdown-item dropdown order-2" role="menuitem"><a href="/en-us/the-ordinary/skincare/shop-by-step" id="theordinary-shop-by-step" class="dropdown-link dropdown-toggle theordinary-shop-by-step" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ürünlere Göre Alışveriş Yapın  </a>
                                            <ul class="dropdown-menu" role="menu" aria-hidden="true" aria-label="Shop by Step">
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/skincare/shop-by-step/prep" id="theordinary-shopbystep-step1" role="menuitem" class="dropdown-link theordinary-shopbystep-step1" style="font-weight:500 !important; font-size:13px; !important;">Gözenek Sıkılaştırıcı Serum  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/skincare/goz-cevresi-serum" id="theordinary-facialcleansers" role="menuitem" class="dropdown-link theordinary-facialcleansers">Göz Çevresi Serum  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/skincare/leke-karsiti-aydinlatici-serum" id="theordinary-toners" role="menuitem" class="dropdown-link theordinary-toners">Leke Karşıtı & Aydınlatıcı & Gözenek Sıkılaştırıcı Serum  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/skincare/yaslanma-karsiti-serum" id="theordinary-shopbystep-step2" role="menuitem" class="dropdown-link theordinary-shopbystep-step2" style="font-weight:500 !important; font-size:13px; !important;">Yaşlanma Karşıtı Serum  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/skincare/leke-karsiti-serum" id="theordinary-eyeserums" role="menuitem" class="dropdown-link theordinary-eyeserums">Leke Karşıtı Serum  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/skincare/aydinlatici-serum" id="theordinary-exfoliators" role="menuitem" class="dropdown-link theordinary-exfoliators">Aydınlatıcı Serum  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/skincare/sebum-dengeleyici-serum" id="theordinary-facemasques" role="menuitem" class="dropdown-link theordinary-facemasques">Sebum Dengeleyici Serum  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/skincare/yuz-temizleme-kopugu" id="theordinary-serums" role="menuitem" class="dropdown-link theordinary-serums">Hassas Ciltler İçin Yüz Temizleme Köpüğü  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/skincare/cilt-canlandirici-tonik" id="theordinary-faceoils" role="menuitem" class="dropdown-link theordinary-faceoils">Cilt Canlandırıcı Tonik  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/skincare/shop-by-step/seal" id="theordinary-shopbystep-step3" role="menuitem" class="dropdown-link theordinary-shopbystep-step3">Adım 3: Koruma  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/skincare/moisturizers" id="theordinary-moisturizers" role="menuitem" class="dropdown-link theordinary-moisturizers">Nemlendiriciler  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/skincare/suncare" id="theordinary-suncare" role="menuitem" class="dropdown-link theordinary-suncare">Güneş Bakımı  </a>
                                                </li>
                                                <div class="flyout"><a href="/en-us/regimen-builder"> <img class="lazy" data-src="<?= BASE_URL ?>/assets/images/noc-menu-kucuk-2.png" title="" alt="Rejim Oluşturucumuzu Deneyin."> <p>Cildiniz, Bakım Rutininiz:</p> <p>Rejim Oluşturucumuzu Deneyin.</p> </a>
                                                </div>
                                            </ul>
                                        </li>
                                        <li class="js-dropdown-item dropdown-item dropdown order-1" role="menuitem"><a href="/en-us/category/skincare/shop-by-ingredients" id="theordinary-shop-by-ingredients" class="dropdown-link dropdown-toggle theordinary-shop-by-ingredients" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Malzemelere Göre Alışveriş Yapın  </a>
                                            <ul class="dropdown-menu" role="menu" aria-hidden="true" aria-label="Shop by Ingredients">
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/peptitler" id="theordinary-retinoids" role="menuitem" class="dropdown-link theordinary-retinoids">Peptit & Amino Asit Bazlı Aktifler  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/bitkisel" id="theordinary-vitamin-c" role="menuitem" class="dropdown-link theordinary-vitamin-c">Bitkisel & Biyoteknolojik Ekstraktlar  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/aydinlatici-ton-esitleyici" id="theordinary-direct-acids" role="menuitem" class="dropdown-link theordinary-direct-acids">Aydınlatıcı & Ton Eşitleyici Aktifler  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/nem-bariyer" id="theordinary-salicylic-acid" role="menuitem" class="dropdown-link theordinary-salicylic-acid">Nem & Bariyer Destekleyiciler  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/sebum-mikrobiyom" id="theordinary-niacinamide" role="menuitem" class="dropdown-link theordinary-niacinamide">Sebum & Mikrobiyom Destekleyiciler  </a>
                                                </li>
                                                <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/ciltbakim/aninda-etki" id="theordinary-hyaluronic-acid" role="menuitem" class="dropdown-link theordinary-hyaluronic-acid">Anında Etki Sağlayan Bileşenler  </a>
                                                </li>
                                                <div class="flyout"><a href="/en-us/regimen-builder"> <img class="lazy" data-src="<?= BASE_URL ?>/assets/images/noc-menu-kucuk-2.png" title="" alt="Rejim Oluşturucumuzu Deneyin."> <p>Cildiniz, Bakım Rutininiz:</p> <p>Rejim Oluşturucumuzu Deneyin.</p> </a>
                                                </div>
                                            </ul>
                                        </li>
                                        <!--<li class="js-dropdown-item dropdown-item show-mobile-only order-2" role="menuitem"><a href="/en-us/category/skincare#product-search-results" id="theordinary-skincare-all" role="menuitem" class="dropdown-link theordinary-skincare-all">Shop All Skincare  </a>
                                        </li>-->
                                        <div class="flyout"><a href="/en-us/regimen-builder"> <img class="lazy" data-src="<?= BASE_URL ?>/assets/images/noc-menu-kucuk-2.png" title="" alt="Rejim Oluşturucumuzu Deneyin."> <p>Cildiniz, Bakım Rutininiz:</p> <p>Rejim Oluşturucumuzu Deneyin.</p> </a>
                                        </div>
                                    </ul>
                                </div>
                                <div class="desktop">
                                    <div class="dropdown-menu  js-dropdown-menu theordinary-skincare" role="menu" aria-hidden="true" aria-label="Skincare">
                                        <div class="inner">
                                            <ul class="main-category" role="menu" aria-hidden="true" aria-label="Skincare">
                                                <!--<li class=" d-lg-none" role="menuitem"><a href="/en-us/category/skincare#product-search-results" id="theordinary-skincare-all" role="menuitem" class="menuitem-subcategory">Shop All Skincare</a>
                                                </li>-->
                                            </ul>
                                            <ul class="sub-category " role="menu" aria-hidden="true" aria-label="Shop by Concern">
                                                <li class="" role="menuitem"><span id="theordinary-shop-by-concern" class="">İhtiyacına Göre Alışveriş Yapın</span>
                                                    <ul class="" role="menu" aria-label="Shop by Concern">
                                                        <li class="" role="menuitem"><a href="/ciltbakim/yaslanma-karsiti" id="theordinary-signs-of-aging" role="menuitem" class="menuitem-subcategory">Yaşlanma Karşıtı & Sıkılaştırma</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/ciltbakim/kirisiklik-ince-cizgi" id="theordinary-uneven-skin-tone" role="menuitem" class="menuitem-subcategory">Kırışıklık & İnce Çizgi Bakımı</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/ciltbakim/leke-karsiti-cilt-tonu-esitleme" id="theordinary-signs-of-congestion" role="menuitem" class="menuitem-subcategory">Leke Karşıtı & Cilt Tonu Eşitleme</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/ciltbakim/gozenek-sikilastirma" id="theordinary-textural-irregularities" role="menuitem" class="menuitem-subcategory">Gözenek Sıkılaştırma & Cilt Dokusu</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/ciltbakim/sebum-dengeleme" id="theordinary-dryness" role="menuitem" class="menuitem-subcategory">Sebum Dengeleme & Akne Eğilimli Ciltler</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/ciltbakim/hassasiyet-kizariklik" id="theordinary-eyecare" role="menuitem" class="menuitem-subcategory">Hassasiyet & Kızarıklık Karşıtı Bakım</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/ciltbakim/nemlendirme-bariyer-guclendirme" id="theordinary-redness" role="menuitem" class="menuitem-subcategory">Nemlendirme & Bariyer Güçlendirme</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/ciltbakim/goz-cevresi-bakimi" id="theordinary-dullness" role="menuitem" class="menuitem-subcategory">Göz Çevresi Bakımı</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/ciltbakim/aninda-puruzsuzluk" id="theordinary-uv-protection" role="menuitem" class="menuitem-subcategory">Anında Pürüzsüzlük & Canlı Görünüm</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/ciltbakim/yorgun-mat-ciltler" id="theordinary-barrier-support" role="menuitem" class="menuitem-subcategory">Yorgun & Mat Ciltler İçin Bakım</a>
                                                        </li>
                                                     <!--   <li class="" role="menuitem"><a href="/en-us/category/skincare#product-search-results" id="theordinary-explore-skincare" role="menuitem" class="menuitem-subcategory">Shop All Skincare</a>
                                                        </li>-->
                                                    </ul>
                                                </li>
                                            </ul>
                                            <ul class="sub-category " role="menu" aria-hidden="true" aria-label="Shop by Step">
                                                <li class="" role="menuitem"><span id="theordinary-shop-by-step" class="">Ürünlere Göre Alışveriş Yapın</span>
                                                    <ul class="" role="menu" aria-label="Shop by Step">
                                                        <li class="" role="menuitem"><a href="/en-us/category/skincare/gozenek-sikilastirici-serum" id="theordinary-shopbystep-step1" role="menuitem" class="menuitem-subcategory" style="font-weight:500 !important; font-size:13px; !important;">Gözenek Sıkılaştırıcı Serum</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/en-us/category/skincare/goz-cevresi-serum" id="theordinary-facialcleansers" role="menuitem" class="menuitem-subcategory">Göz Çevresi Serum</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/en-us/category/skincare/leke-karsiti-aydinlatici-serum" id="theordinary-toners" role="menuitem" class="menuitem-subcategory">Leke Karşıtı & Aydınlatıcı & Gözenek Sıkılaştırıcı Serum</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/en-us/category/skincare/yaslanma-karsiti-serum" id="theordinary-shopbystep-step2" role="menuitem" class="menuitem-subcategory" style="font-weight:500 !important; font-size:13px; !important;">Yaşlanma Karşıtı Serum</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/en-us/category/skincare/leke-karsiti-serum" id="theordinary-eyeserums" role="menuitem" class="menuitem-subcategory">Leke Karşıtı Serum</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/en-us/category/skincare/aydinlatici-serum" id="theordinary-exfoliators" role="menuitem" class="menuitem-subcategory">Aydınlatıcı Serum</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/en-us/category/skincare/sebum-dengeleyici-serum" id="theordinary-facemasques" role="menuitem" class="menuitem-subcategory">Sebum Dengeleyici Serum</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/en-us/category/skincare/yuz-temizleme-kopugu" id="theordinary-serums" role="menuitem" class="menuitem-subcategory">Hassas Ciltler İçin Yüz Temizleme Köpüğü</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/en-us/category/skincare/cilt-canlandirici-tonik" id="theordinary-faceoils" role="menuitem" class="menuitem-subcategory">Cilt Canlandırıcı Tonik</a>
                                                        </li>
                                                 <!--       <li class="" role="menuitem"><a href="/en-us/category/skincare/shop-by-step/seal" id="theordinary-shopbystep-step3" role="menuitem" class="menuitem-subcategory">Adım 3: Koruma</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/en-us/category/skincare/moisturizers" id="theordinary-moisturizers" role="menuitem" class="menuitem-subcategory">Nemlendiriciler</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/en-us/category/skincare/suncare" id="theordinary-suncare" role="menuitem" class="menuitem-subcategory">Güneş Bakımı</a>
                                                        </li>-->
                                                    </ul>
                                                </li>
                                            </ul>
                                            <ul class="sub-category " role="menu" aria-hidden="true" aria-label="Shop by Ingredients">
                                                <li class="" role="menuitem"><span id="theordinary-shop-by-ingredients" class="">Malzemelere Göre Alışveriş Yapın</span>
                                                    <ul class="" role="menu" aria-label="Shop by Ingredients">
                                                        <li class="" role="menuitem"><a href="/ciltbakim/peptitler" id="theordinary-retinoids" role="menuitem" class="menuitem-subcategory">Peptit & Amino Asit Bazlı Aktifler</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/ciltbakim/bitkisel" id="theordinary-vitamin-c" role="menuitem" class="menuitem-subcategory">Bitkisel & Biyoteknolojik Ekstraktlar</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/ciltbakim/aydinlatici-ton-esitleyici" id="theordinary-direct-acids" role="menuitem" class="menuitem-subcategory">Aydınlatıcı & Ton Eşitleyici Aktifler</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/ciltbakim/nem-bariyer" id="theordinary-salicylic-acid" role="menuitem" class="menuitem-subcategory">Nem & Bariyer Destekleyiciler</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/ciltbakim/sebum-mikrobiyom" id="theordinary-niacinamide" role="menuitem" class="menuitem-subcategory">Sebum & Mikrobiyom Destekleyiciler</a>
                                                        </li>
                                                        <li class="" role="menuitem"><a href="/ciltbakim/aninda-etki" id="theordinary-hyaluronic-acid" role="menuitem" class="menuitem-subcategory">Anında Etki Sağlayan Aktifler</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <div class="flyout"><a href="/en-us/regimen-builder"> <img class="lazy" data-src="<?= BASE_URL ?>/assets/images/noc-menu-kucuk-2.png" title="" alt="Rejim Oluşturucumuzu Deneyin."> <p>Cildiniz, Bakım Rutininiz:</p> <p>Rejim Oluşturucumuzu Deneyin.</p> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown  no_selected theordinary-bodyhair" role="menuitem"><a aria-title="Vücut + Saç" href="/en-us/category/noc-body-hair" id="theordinary-bodyhair" class="nav-link dropdown-toggle pane-nav-link" role="button" data-toggle="dropdown" tabindex="0" aria-haspopup="true" aria-expanded="false"> <span class="link-text">
Vücut + Saç </span> <span class="icon-right_chevron d-lg-none"></span> </a>
                                <div class="mobile mobile-slide-pane" id="slide-pane-theordinary-bodyhair" hidden="">
                                    <div class="back-container"><span class="icon-left_chevron back-button d-lg-none"></span><span class="name">
Vücut + Saç </span>
                                    </div>
                                    <ul class="dropdown-menu js-dropdown-menu d-lg-none" role="menu" aria-hidden="true" aria-label="Vücut + Saç">
                                        <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/body-hair/body-care" id="theordinary-bodycare" role="menuitem" class="dropdown-link theordinary-bodycare">Vücut Bakımı  </a>
                                        </li>
                                        <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/body-hair/hair-scalp-solutions" id="theordinary-hairtreatments" role="menuitem" class="dropdown-link theordinary-hairtreatments">Saç ve Saç Derisi Çözümleri  </a>
                                        </li>
                                        <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/body-hair/lash-brow-treatment" id="theordinary-lashbrow" role="menuitem" class="dropdown-link theordinary-lashbrow">Kirpik ve Kaş Bakımları  </a>
                                        </li>
                                        <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/body-hair/lip-care" id="theordinary-lips" role="menuitem" class="dropdown-link theordinary-lips">Dudak Bakımı  </a>
                                        </li>
                                       <!-- <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/category/body-hair#product-search-results" id="theordinary-explore-bodyhair" role="menuitem" class="dropdown-link theordinary-explore-bodyhair">Shop All Body + Hair  </a>
                                        </li>-->
                                        <div class="flyout"><a href="/en-us/category/body-hair/body-care"> <img class="lazy" data-src="/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dwa3aeab9a/navigation/nav-body-care-flyout.jpg" title="" alt="Önce içerik odaklı formülasyonlar. �?imdi sıra vücudunuzun cildinde."> <p>34 Vücuda Yüzünü Gösterme Zamanı Ver 44</p> <p>Önce içerik odaklı formülasyonlar. �?imdi sıra vücudunuzun cildinde.</p> </a>
                                        </div>
                                    </ul>
                                </div>
                                <div class="desktop">
                                    <div class="dropdown-menu  js-dropdown-menu theordinary-bodyhair" role="menu" aria-hidden="true" aria-label="Vücut + Saç">
                                        <div class="inner">
                                            <ul class="main-category" role="menu" aria-hidden="true" aria-label="Vücut + Saç">
                                                <li class="" role="menuitem"><a href="/en-us/category/body-hair/body-care" id="theordinary-bodycare" role="menuitem" class="menuitem-subcategory">Vücut Bakımı</a>
                                                </li>
                                                <li class="" role="menuitem"><a href="/en-us/category/body-hair/hair-scalp-solutions" id="theordinary-hairtreatments" role="menuitem" class="menuitem-subcategory">Saç ve Saç Derisi Çözümleri</a>
                                                </li>
                                                <li class="" role="menuitem"><a href="/en-us/category/body-hair/lash-brow-treatment" id="theordinary-lashbrow" role="menuitem" class="menuitem-subcategory">Kirpik ve Kaş Bakımları</a>
                                                </li>
                                                <li class="" role="menuitem"><a href="/en-us/category/body-hair/lip-care" id="theordinary-lips" role="menuitem" class="menuitem-subcategory">Dudak Bakımı</a>
                                                </li>
                                              <!--  <li class="" role="menuitem"><a href="/en-us/category/body-hair#product-search-results" id="theordinary-explore-bodyhair" role="menuitem" class="menuitem-subcategory">Shop All Body + Hair</a>
                                                </li>-->
                                            </ul>
                                            <div class="flyout"><a href="/en-us/category/body-hair/body-care"> <img class="lazy" data-src="/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dwa3aeab9a/navigation/nav-body-care-flyout.jpg" title="" alt="Önce içerik odaklı formülasyonlar. �?imdi sıra vücudunuzun cildinde."> <p>Vücuda Yüzünü Gösterme Zamanı Ver</p> <p>Önce içerik odaklı formülasyonlar. �?imdi sıra vücudunuzun cildinde.</p> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item  no_selected theordinary-sets" role="menuitem"><a title="Sets &amp; Collections" href="/en-us/category/skincare/skincare-sets" id="theordinary-sets" class="nav-link "> <span class="link-text">
Setler & Koleksiyonlar </span> </a>
                            </li>
                            <li class="nav-item dropdown  no_selected theordinary-theolibrary" role="menuitem"><a aria-title="Noc Kütüphanesi" href="/en-us/noc-blog" id="theordinary-theolibrary" class="nav-link dropdown-toggle pane-nav-link" role="button" data-toggle="dropdown" tabindex="0" aria-haspopup="true" aria-expanded="false"> <span class="link-text">
Noc Kütüphanesi </span> <span class="icon-right_chevron d-lg-none"></span> </a>
                                <div class="mobile mobile-slide-pane" id="slide-pane-theordinary-theolibrary" hidden="">
                                    <div class="back-container"><span class="icon-left_chevron back-button d-lg-none"></span><span class="name">
Noc Kütüphanesi </span>
                                    </div>
                                    <ul class="dropdown-menu js-dropdown-menu d-lg-none" role="menu" aria-hidden="true" aria-label="Noc Kütüphanesi">
                                      <!--  <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/blog" id="theordinary-blog" role="menuitem" class="dropdown-link theordinary-blog">The O. Blog  </a>
                                        </li>-->
                                        <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/blog/mastering-skincare-routine-guide" id="theordinary-regimenguide" role="menuitem" class="dropdown-link theordinary-regimenguide">Rejim Rehberi  </a>
                                        </li>
                                        <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/ingredient-glossary" id="theordinary-ingredientglossary" role="menuitem" class="dropdown-link theordinary-ingredientglossary">Malzeme Sözlüğü  </a>
                                        </li>
                                        <li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="/en-us/blog/skincare-layering-guide" id="theordinary-layering-guide" role="menuitem" class="dropdown-link theordinary-layering-guide">Katmanlama Kılavuzu  </a>
                                        </li>
                                        <!--<li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="#" id="theordinary-olibrary-beginners-guide" role="menuitem" class="dropdown-link theordinary-olibrary-beginners-guide">A Beginner's Guide to The Ordinary  </a>
                                        </li>-->
                                        <div class="flyout"><a href="#"> <img class="lazy" data-src="/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw6db2ce59/navigation/beginner-guide-flyout.jpg" title="" alt="Cildiniz için kolay bakım rutinlerini keşfedin."> <p>Noc'a yeni mi geldiniz?</p> <p>Cildiniz için kolay bakım rutinlerini keşfedin.</p> </a>
                                        </div>
                                    </ul>
                                </div>
                                <div class="desktop">
                                    <div class="dropdown-menu  js-dropdown-menu theordinary-theolibrary" role="menu" aria-hidden="true" aria-label="Noc Kütüphanesi">
                                        <div class="inner">
                                            <ul class="main-category" role="menu" aria-hidden="true" aria-label="Noc Kütüphanesi">
                                                <!--<li class="" role="menuitem"><a href="/en-us/blog" id="theordinary-blog" role="menuitem" class="menuitem-subcategory">The O. Blog</a>
                                                </li>-->
                                                <li class="" role="menuitem"><a href="/en-us/blog/mastering-skincare-routine-guide" id="theordinary-regimenguide" role="menuitem" class="menuitem-subcategory">Rejim Rehberi</a>
                                                </li>
                                                <li class="" role="menuitem"><a href="/en-us/ingredient-glossary" id="theordinary-ingredientglossary" role="menuitem" class="menuitem-subcategory">Malzeme Sözlüğü</a>
                                                </li>
                                                <li class="" role="menuitem"><a href="/en-us/blog/skincare-layering-guide" id="theordinary-layering-guide" role="menuitem" class="menuitem-subcategory">Katmanlama Kılavuzu</a>
                                                </li>
                                               <!-- <li class="" role="menuitem"><a href="/en-us/skincare-regimen-for-beginners" id="theordinary-olibrary-beginners-guide" role="menuitem" class="menuitem-subcategory">A Beginner's Guide to The Ordinary</a>
                                                </li>-->
                                            </ul>
                                            <div class="flyout"><a href="#"> <img class="lazy" data-src="/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw6db2ce59/navigation/beginner-guide-flyout.jpg" title="" alt="Cildiniz için kolay bakım rutinlerini keşfedin."> <p>Noc'a yeni mi geldiniz?</p> <p>Cildiniz için kolay bakım rutinlerini keşfedin.</p> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item  no_selected periodic-table-of-bs" role="menuitem"><a title="Periyodik Tablo" href="/en-us/the-periodic-fable" id="periodic-table-of-bs" class="nav-link "> <span class="link-text">
Periyodik Tablo </span> </a>
                            </li>
                            <li class="nav-item  no_selected theordinary_regimenbuilder" role="menuitem"><a title="Build My Regimen" href="/en-us/regimen-builder" id="theordinary_regimenbuilder" class="nav-link btn-rounded-primary"> <span class="link-text">
Rejim Programımı Oluştur </span> </a>
                            </li>
                            <template id="dropdown-tmpl">
                                <div class="dropdown-menu hidden-md-down dropdown-menu" aria-hidden="true">
                                    <div class="dropdown-content">
                                        <div class="logo">
                                            <div class="logo-text">
                                            </div><a href="<?= BASE_URL ?>/" class="logo-link" aria-label="Logo The Ordinary"> <img class="logo-img" src="/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw4ee7d800/theordinary/logo.svg" alt="Logo The Ordinary"> </a>
                                        </div>
                                        <div class="js-close-button close-button"><span>Menu</span>
                                            <button role="button" aria-label="Close menu" title="Close menu navigation" name="Close menu navigation" class="burger_close-btn icon-close">
                                                Close menu
                                            </button>
                                        </div>
                                        <div class="dropdown-main"></div>
                                        <div class="dropdown-bottom">
                                            <div class="dropdown-copyright">
                                                <ul class="page_footer-copyright_menu content list-unstyled">
                                                    <li class="page_footer-copyright_text">© DECIEM Beauty Group Inc. 2022. All rights reserved. </li>
                                                    <li>
                                                        <a href="/en-us/terms">Terms & Conditions</a>
                                                    </li>
                                                    <li>
                                                        <a href="/en-us/privacy-policy">Privacy Policy</a>
                                                    </li>
                                                    <li>
                                                        <a href="/en-us/do-not-sell">Do not sell my personal information</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="js-cookie_settings-btn" data-toggle="modal" data-target="#cookieConsentModal">Cookies</a>
                                                    </li>
                                                    <li class="page_footer-copyright_brand_link">
                                                        <a href="/en-us/deciem-about">A DECIEM PROJECT.</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-faq"><a href="/en-us/faq" title="FAQ">
                                                    FAQ </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </ul>
                        <div class="site_nav_footer">
                            <ul class="list-unstyled ctas nav_footer-items">
                                <li class="user-link d-xl-none" role="menuitem"><a href="/en-us/login-1" class="icon-account dropdown-link" role="button">
                                        Sign in </a>
                                </li>
                                <li class="d-xl-none" role="menuitem"><a href="/en-us/contact-us" class="icon-contact-us dropdown-link" role="button">
                                        Contact Us </a>
                                </li>
                                <li class="d-xl-none" role="menuitem"><a href="/en-us/order-lookup" class="dropdown-link" role="button">  <img src="/on/demandware.static/Sites-deciem-us-Site/-/default/dwd75589ed/images/icons/svg/track-order-black.svg" alt="track-order">
                                        Track Order </a>
                                </li>
                                <li class="d-xl-none site_nav_footer-country_selector" role="menuitem">
                                    <button class="country_selector-button icon-map_pin" data-target="#modalCountrySelector" data-toggle="modal">
                                        United States
                                    </button>
                                </li>
                            </ul>
                            <ul class="list-unstyled brand-list">
                                <li class="nav-item d-xl-none brands-item brands-item--active visit-theordinary" role="menuitem"><a href="<?= BASE_URL ?>/" class="brands-link"> <span>Visit</span>   <img class="brands-item-logo" src="/on/demandware.static/Sites-deciem-us-Site/-/default/dwa148e371/images/brands-logo/theordinary.svg" title="" alt=""> <img class="brands-item-logo brands-item-logo--black" src="/on/demandware.static/Sites-deciem-us-Site/-/default/dw04f3255d/images/brands-logo/theordinary_black.svg" title="" alt=""> <img class="brands-item-logo brands-item-logo--white" src="on/demandware.static/Sites-deciem-us-Site/-/default/dw617e88ef/images/brands-logo/theordinary_white.svg" title="" alt="">   <span class="brand-name text-uppercase">The Ordinary</span>  </a>
                                </li>
                                <li class="nav-item d-xl-none brands-item visit-niod" role="menuitem"><a href="/en-us-1?url=https%3A%2F%2Fniod.com%2Fen-us" class="brands-link"> <span>Visit</span>   <img class="brands-item-logo" src="/on/demandware.static/Sites-deciem-us-Site/-/default/dw86c1e57d/images/brands-logo/niod.svg" title="" alt=""> <img class="brands-item-logo brands-item-logo--black" src="/on/demandware.static/Sites-deciem-us-Site/-/default/dwaf34ce59/images/brands-logo/niod_black.svg" title="" alt=""> <img class="brands-item-logo brands-item-logo--white" src="on/demandware.static/Sites-deciem-us-Site/-/default/dw93298ae8/images/brands-logo/niod_white.svg" title="" alt="">   <span class="brand-name text-uppercase">Niod</span>  </a>
                                </li>
                                <li class="nav-item d-xl-none brands-item visit-loopha" role="menuitem"><a href="/en-us-2?url=https%3A%2F%2Floopha.com%2Fen-us" class="brands-link"> <span>Visit</span>   <img class="brands-item-logo" src="/on/demandware.static/Sites-deciem-us-Site/-/default/dw0e544fc0/images/brands-logo/loopha.svg" title="" alt=""> <img class="brands-item-logo brands-item-logo--black" src="/on/demandware.static/Sites-deciem-us-Site/-/default/dw265a4cd3/images/brands-logo/loopha_black.svg" title="" alt=""> <img class="brands-item-logo brands-item-logo--white" src="on/demandware.static/Sites-deciem-us-Site/-/default/dw73bca2ea/images/brands-logo/loopha_white.svg" title="" alt="">   <span class="brand-name text-uppercase">Loopha</span>  </a>
                                </li>
                                <li class="nav-item d-xl-none brands-item visit-deciem" role="menuitem"><a href="https://theordinary.com/s/Sites-deciem-us-Site/dw/shared_session_redirect?url=https%3A%2F%2Fdeciem.com%2Fen-us" class="brands-link"> <span>Visit</span>   <img class="brands-item-logo brands-item-logo--black" src="/on/demandware.static/Sites-deciem-us-Site/-/default/dwb462007d/images/brands-logo/deciem_full_black.svg" title="" alt=""> <img class="brands-item-logo brands-item-logo--white" src="/on/demandware.static/Sites-deciem-us-Site/-/default/dw6b7f4d7f/images/brands-logo/deciem_full_white.svg" title="" alt="">   <span class="brand-name text-uppercase">Deciem</span>  </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </nav>
</header>

