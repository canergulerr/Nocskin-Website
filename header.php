<?php
include __DIR__ . '/config.php';
// DB Connection for Dynamic Menus
// DB Connection for Dynamic Menus
require_once 'admin/includes/db.php';

// Fetch Settings (Logos)
try {
    $stmt = $pdo->query("SELECT * FROM settings WHERE id = 1");
    $settings = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $settings = [];
}

// Fetch Announcements
try {
    $stmt = $pdo->query("SELECT * FROM announcements WHERE status = 1 ORDER BY order_index ASC");
    $announcements = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $announcements = [];
}

// Fetch Header Brands
try {
    $stmt = $pdo->query("SELECT * FROM header_brands WHERE status = 1 ORDER BY order_index ASC");
    $headerBrands = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $headerBrands = [];
}

// Fetch menus
try {
    $stmt = $pdo->prepare("SELECT * FROM menus WHERE status = 1 ORDER BY parent_id ASC, position ASC");
    $stmt->execute();
    $all_menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $all_menus = [];
}

if (!function_exists('buildFrontendMenuTree')) {
    function buildFrontendMenuTree($elements, $parentId = NULL)
    {
        $branch = array();
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = buildFrontendMenuTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
}

$frontendMenuTree = buildFrontendMenuTree($all_menus);

if (!function_exists('renderFrontendMenu')) {
    function renderFrontendMenu($tree)
    {
        foreach ($tree as $item) {
            $hasChildren = !empty($item['children']);
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $item['title'])));

            // Fix URL path: Prepend BASE_URL if relative
            $url = htmlspecialchars($item['url']);
            if (strpos($url, 'http') !== 0 && strpos($url, '#') !== 0 && strpos($url, '/') !== 0) {
                // If completely relative without slash, maybe add slash? 
                // Assuming DB has '/en-us/...' or 'ciltbakim/...'
            }
            // Logic: if it starts with '/', prepend BASE_URL only if BASE_URL is not empty and URL doesn't already have domain. 
            // But simpler: just always use BASE_URL . $url for local dev if $url starts with /
            // Actually, user inputs might be '/en-us/...'
            // Let's ensure strict pathing.
            if (strpos($url, 'http') !== 0 && strpos($url, '#') !== 0) {
                $url = BASE_URL . $url;
            }

            $title = htmlspecialchars($item['title']);

            // Check for Rejim Button (Level 1)
            if (mb_strpos($title, 'Rejim') !== false) {
                echo '<li class="nav-item  no_selected theordinary_regimenbuilder" role="menuitem"><a title="Build My Regimen" href="' . $url . '" id="theordinary_regimenbuilder" class="nav-link btn-rounded-primary"> <span class="link-text">' . $title . ' </span> </a></li>';
                continue;
            }

            // Check if we have active children to determine dropdown status
            if (!$hasChildren) {
                echo '<li class="nav-item no_selected ' . $slug . '" role="menuitem">';
                echo '<a href="' . $url . '" class="nav-link"><span class="link-text">' . $title . '</span></a>';
                echo '</li>';
            } else {
                echo '<li class="nav-item dropdown no_selected ' . $slug . '" role="menuitem">';
                echo '<a aria-title="' . $title . '" href="' . $url . '" class="nav-link dropdown-toggle pane-nav-link" role="button" data-toggle="dropdown" tabindex="0" aria-haspopup="true" aria-expanded="false"> <span class="link-text">' . $title . '</span> <span class="icon-right_chevron d-lg-none"></span> </a>';

                // --- MOBILE PANE ---
                echo '<div class="mobile mobile-slide-pane" id="slide-pane-' . $slug . '" hidden="">';
                echo '<div class="back-container"><span class="icon-left_chevron back-button d-lg-none"></span><span class="name">' . $title . '</span></div>';
                echo '<ul class="dropdown-menu js-dropdown-menu d-lg-none" role="menu" aria-hidden="true" aria-label="' . $title . '">';

                foreach ($item['children'] as $child) {
                    $childUrl = htmlspecialchars($child['url']);
                    if (strpos($childUrl, 'http') !== 0 && strpos($childUrl, '#') !== 0) {
                        $childUrl = BASE_URL . $childUrl;
                    }

                    if (!empty($child['children'])) {
                        // Level 2 with Children (Mobile)
                        echo '<li class="js-dropdown-item dropdown-item dropdown order-2" role="menuitem">';
                        echo '<a href="#" class="dropdown-link dropdown-toggle ' . $slug . '-sub" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . htmlspecialchars($child['title']) . ' </a>';
                        echo '<ul class="dropdown-menu" role="menu" aria-hidden="true" aria-label="' . htmlspecialchars($child['title']) . '">';
                        foreach ($child['children'] as $grandChild) {
                            $grandChildUrl = htmlspecialchars($grandChild['url']);
                            if (strpos($grandChildUrl, 'http') !== 0 && strpos($grandChildUrl, '#') !== 0) {
                                $grandChildUrl = BASE_URL . $grandChildUrl;
                            }
                            echo '<li class="js-dropdown-item dropdown-item order-2" role="menuitem"><a href="' . $grandChildUrl . '" class="dropdown-link nested">' . htmlspecialchars($grandChild['title']) . '</a></li>';
                        }
                        echo '</ul>';
                        echo '</li>';
                    } else {
                        // Level 2 Direct Link (Mobile)
                        echo '<li class="js-dropdown-item dropdown-item order-2" role="menuitem">';
                        echo '<a href="' . $childUrl . '" class="dropdown-link ' . $slug . '-direct">' . htmlspecialchars($child['title']) . '</a>';
                        echo '</li>';
                    }
                }
                // Mobile Flyout (Hardcoded for visual parity)
                if (strpos($slug, 'yeni') !== false || strpos($slug, 'new') !== false) {
                    echo '<div class="flyout"><a href="/en-us/ingredients-book-100735"> <img class="lazy" data-src="' . BASE_URL . '/assets/images/noc-menu-kucuk.png" title="" alt="Ingredients by The Ordinary."> <p>Ön Siparişe Açık.</p> <p>Noc\'un İçerikleri.</p> </a></div>';
                } elseif (strpos($slug, 'cilt') !== false || strpos($slug, 'skin') !== false || strpos($slug, 'vucut') !== false || strpos($slug, 'body') !== false) {
                    echo '<div class="flyout"><a href="/en-us/regimen-builder"> <img class="lazy" data-src="' . BASE_URL . '/assets/images/noc-menu-kucuk-2.png" title="" alt="Rejim Oluşturucumuzu Deneyin."> <p>Cildiniz, Bakım Rutininiz:</p> <p>Rejim Oluşturucumuzu Deneyin.</p> </a></div>';
                }

                echo '</ul></div>';

                // --- DESKTOP PANE ---
                $directLinks = [];
                $subSections = [];
                foreach ($item['children'] as $child) {
                    if (!empty($child['children'])) {
                        $subSections[] = $child;
                    } else {
                        $directLinks[] = $child;
                    }
                }

                // Use exact classes from original. inner > main-category + sub-category + flyout
                echo '<div class="desktop"><div class="dropdown-menu js-dropdown-menu ' . $slug . '" role="menu" aria-hidden="true" aria-label="' . $title . '"><div class="inner">';

                // 1. Main Category (Direct Links)
                echo '<ul class="main-category" role="menu" aria-hidden="true" aria-label="' . $title . '">';
                foreach ($directLinks as $link) {
                    $linkUrl = htmlspecialchars($link['url']);
                    if (strpos($linkUrl, 'http') !== 0 && strpos($linkUrl, '#') !== 0) {
                        $linkUrl = BASE_URL . $linkUrl;
                    }
                    echo '<li class="" role="menuitem"><a href="' . $linkUrl . '" class="menuitem-subcategory">' . htmlspecialchars($link['title']) . '</a></li>';
                }
                echo '</ul>';

                // 2. Sub Category (Columns)
                foreach ($subSections as $section) {
                    echo '<ul class="sub-category" role="menu" aria-hidden="true" aria-label="' . htmlspecialchars($section['title']) . '">';
                    // Separator Style Added
                    echo '<li class="" role="menuitem"><span class="" style="display:block; border-bottom: 2px solid #ccc; padding-bottom: 8px; margin-bottom: 12px; font-weight:bold;">' . htmlspecialchars($section['title']) . '</span>';
                    echo '<ul class="" role="menu" aria-label="' . htmlspecialchars($section['title']) . '">';
                    foreach ($section['children'] as $subLink) {
                        $subLinkUrl = htmlspecialchars($subLink['url']);
                        if (strpos($subLinkUrl, 'http') !== 0 && strpos($subLinkUrl, '#') !== 0) {
                            $subLinkUrl = BASE_URL . $subLinkUrl;
                        }
                        echo '<li class="" role="menuitem"><a href="' . $subLinkUrl . '" class="menuitem-subcategory">' . htmlspecialchars($subLink['title']) . '</a></li>';
                    }
                    echo '</ul>';
                    echo '</li>';
                    echo '</ul>';
                }

                // 3. Flyout (Hardcoded Logic matches slugs to original images)
                if (strpos($slug, 'yeni') !== false || strpos($slug, 'new') !== false) {
                    echo '<div class="flyout"><a href="#"> <img class="lazy" data-src="' . BASE_URL . '/assets/images/noc-menu-kucuk.png" title="" alt="Ingredients by The Ordinary."> <p>Ön Siparişe Açık.</p> <p>Noc\'un İçerikleri.</p> </a></div>';
                } elseif (strpos($slug, 'cilt') !== false || strpos($slug, 'skin') !== false) {
                    echo '<div class="flyout"><a href="/en-us/regimen-builder"> <img class="lazy" data-src="' . BASE_URL . '/assets/images/noc-menu-kucuk-2.png" title="" alt="Rejim Oluşturucumuzu Deneyin."> <p>Cildiniz, Bakım Rutininiz:</p> <p>Rejim Oluşturucumuzu Deneyin.</p> </a></div>';
                } elseif (strpos($slug, 'vucut') !== false || strpos($slug, 'body') !== false || mb_strpos($title, 'Vücut') !== false) {
                    echo '<div class="flyout"><a href="' . BASE_URL . '/en-us/category/body-hair/body-care"> <img src="' . BASE_URL . '/assets/images/noc-body-care-flyout.jpg" title="" alt="Vücuda Yüzünü Gösterme Zamanı Ver"> <p>Vücuda Yüzünü Gösterme Zamanı Ver</p> <p>Önce içerik odaklı formülasyonlar. Şimdi sıra vücudunuzun cildinde.</p> </a></div>';
                } elseif (strpos($slug, 'noc') !== false || strpos($slug, 'library') !== false) {
                    echo '<div class="flyout"><a href="#"> <img class="lazy" data-src="' . BASE_URL . '/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw6db2ce59/navigation/beginner-guide-flyout.jpg" title="" alt="Noca yeni mi geldiniz?"> <p>Noc\'a yeni mi geldiniz?</p> <p>Cildiniz için kolay bakım rutinlerini keşfedin.</p> </a></div>';
                }


                echo '</div></div></div>'; // End inner, dropdown-menu, desktop

                echo '</li>';
            }
        }
    }
}
?>

<header class="header_wrap js-header theordinary"><a href="#maincontent" class="skip"
        aria-label="Skip to main content">Skip to main content</a><a href="#footercontent" class="skip"
        aria-label="Skip to footer content">Skip to footer content</a>
    <nav class="main-nav" aria-label="Main Navigation">
        <div class="header">
            <div class="header__top">
                <div
                    class="promo-messages-slider-holder w-100 position-absolute d-flex justify-content-center align-items-center">
                    <button
                        class="promo-slick-prev promo-slick-prev icon-left_chevron position-relative align-self-end">
                        <span class="sr-only">Previous</span>
                    </button>
                    <div class="js-promo-messages-slider d-inline-block text-center w-100 p-md-0">
                        <?php if (!empty($announcements)): ?>
                            <?php foreach ($announcements as $announcement): ?>
                                <div class="promo-message">
                                    <span class="promo-message-text mb-0">
                                        <?php if (!empty($announcement['url']) && $announcement['url'] != '#'): ?>
                                            <a
                                                href="<?= htmlspecialchars($announcement['url']) ?>"><?= htmlspecialchars($announcement['text']) ?></a>
                                        <?php else: ?>
                                            <?= htmlspecialchars($announcement['text']) ?>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Default fallback if no announcements (Optional) -->
                            <div class="promo-message">
                                <span class="promo-message-text mb-0">Hoş geldiniz.</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button class="promo-slick-next icon-right_chevron position-relative align-self-end">
                        <span class="sr-only">Next</span>
                    </button>
                </div>
                <div class="icons header__service-menu js-header-service-menu">
                    <div class="search">
                        <button class="site-search-button  js-search-button icon-search" aria-label="Open search form"
                            title="Open search form"><span class="d-none">Open search form</span>
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
                <button class="navbar-toggler icon-menu" type="button" aria-controls="sg-navbar-collapse"
                    aria-expanded="false" aria-label="Toggle navigation" name="Open menu navigation"
                    title="Open menu navigation">
                </button>
                <div class="theordinary-mobile-logo no-click"><a href="<?= BASE_URL ?>/">
                        <?php
                        $mobileLogo = !empty($settings['logo_mobile']) ? BASE_URL . '/' . $settings['logo_mobile'] : BASE_URL . '/on/demandware.static/Sites-deciem-us-Site/-/default/dwbf417386/images/brands-logo/theOrdinary-logo.svg';
                        ?>
                        <img src="<?= $mobileLogo ?>" alt="The Ordinary"> </a>
                </div>
            </div>
        </div>
        <div class="main-menu navbar-toggleable-sm menu-toggleable-left multilevel-dropdown d-lg-block"
            id="sg-navbar-collapse">
            <div class="brands_and_locale d-none d-lg-block">
                <nav class="brands-nav hidden-md-down" aria-label="brands navigation">
                    <ul class="dropdown-menu brands-list" role="menu">
                        <?php if (!empty($headerBrands)): ?>
                            <?php
                            $firstBrand = true;
                            // Determine active brand logic:
                            // Try to match current host or default to first one.
                            // Since we don't have multi-domain logic setup in localhost easily, we default to Noc (first item) being active
                            // OR we can check if the user is on that specific site. 
                            // For this specific request, the user seems to want Noc active mostly.
                            // We will simply make the first item active by default if no better logic.
                            // Original code had active on the first item (Noc).
                            foreach ($headerBrands as $index => $brand):
                                $isActive = ($index === 0) ? 'brands-item--active' : '';
                                ?>
                                <li class="brands-item <?= $isActive ?>" role="menuitem">
                                    <a href="<?= htmlspecialchars($brand['url']) ?>"
                                        class="brands-link <?= htmlspecialchars($brand['class_name']) ?>" rel='nofollow'>
                                        <?php if (!empty($brand['logo_path'])): ?>
                                            <?php
                                            // Handle relative paths for default logos vs uploaded logos
                                            $logoSrc = (strpos($brand['logo_path'], 'http') === 0) ? $brand['logo_path'] : BASE_URL . '/' . $brand['logo_path'];
                                            ?>
                                            <img class="brands-item-logo" src="<?= $logoSrc ?>"
                                                title="<?= htmlspecialchars($brand['title']) ?>"
                                                alt="<?= htmlspecialchars($brand['title']) ?> logo">
                                        <?php endif; ?>
                                        <?= htmlspecialchars($brand['title']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Fallback or Empty -->
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
            <nav class="navbar navbar-expand-lg bg-inverse col-12">
                <div class="close-menu clearfix d-lg-none">
                    <div class="js-close-button close-button pull-left d-xl-none burger_close">
                        <button role="button" aria-label="Close Menu" class="burger_close-btn icon-close"
                            title="Close menu navigation" name="Close menu navigation">
                            Close
                        </button>
                    </div>
                    <div class="active_brand_logo d-lg-none">
                        <div class="theordinary-mobile-logo inner-logo"><a href="<?= BASE_URL ?>/">
                                <?php
                                // Prefer desktop/inner logo for this slot if distinct, otherwise use mobile/main logo
                                $innerLogo = !empty($settings['logo_desktop']) ? BASE_URL . '/' . $settings['logo_desktop'] : (!empty($settings['logo_mobile']) ? BASE_URL . '/' . $settings['logo_mobile'] : BASE_URL . '/on/demandware.static/Sites-deciem-us-Site/-/default/dwbf417386/images/brands-logo/logo.png');
                                ?>
                                <img src="<?= $innerLogo ?>" alt="The Ordinary"> </a>
                        </div>
                    </div>
                    <div class="navbar__service-menu pull-right">
                        <div class="search">
                            <button class="site-search-button js-search-button icon-search"
                                aria-label="Open search form" title="Open search form" name="Open search form"><span
                                    class="d-none">Open search form</span>
                            </button>
                        </div><a href="<?= BASE_URL ?>/en-us/find-us" class="icon-store-locator"></a><a
                            class="user-link icon-account hi" href="<?= BASE_URL ?>/en-us/login" aria-haspopup="false"
                            aria-label="Login to your account" title="Login"> <span
                                class="sr-only user-message">Login</span> </a>
                        <div class="minicart"
                            data-action-url="/neatordinary/on/demandware.store/Sites-deciem-us-Site/en_US/Cart-MiniCartShow">
                            <div class="minicart-total drawer-trigger"><a class="minicart-link icon-cart"
                                    href="<?= BASE_URL ?>/en-us/cart" title="Cart 0 Items" aria-label="Cart 0 Items"
                                    aria-haspopup="true"> <span class="minicart-quantity">
                                        0 </span> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-group">
                    <div class="menu-group--wrapper">
                        <div class="theordinary-logo d-none d-lg-block no-click"><a href="<?= BASE_URL ?>/"> <img
                                    src="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dwbf417386/images/brands-logo/noc-logo.png"
                                    alt="Noc Masaüstü Logo"> </a>
                        </div>
                        <ul class="nav navbar-nav" role="menu">
                            <?php if (!empty($frontendMenuTree)): ?>
                                <?php renderFrontendMenu($frontendMenuTree); ?>
                            <?php else: ?>
                                <li class="nav-item"><a href="#" class="nav-link">Menüler Yükleniyor...</a></li>
                            <?php endif; ?>

                            <template id="dropdown-tmpl">
                                <div class="dropdown-menu hidden-md-down dropdown-menu" aria-hidden="true">
                                    <div class="dropdown-content">
                                        <div class="logo">
                                            <div class="logo-text">
                                            </div><a href="<?= BASE_URL ?>/" class="logo-link"
                                                aria-label="Logo The Ordinary"> <img class="logo-img"
                                                    src="<?= BASE_URL ?>/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw4ee7d800/theordinary/logo.svg"
                                                    alt="Logo The Ordinary"> </a>
                                        </div>
                                        <div class="js-close-button close-button"><span>Menu</span>
                                            <button role="button" aria-label="Close menu" title="Close menu navigation"
                                                name="Close menu navigation" class="burger_close-btn icon-close">
                                                Close menu
                                            </button>
                                        </div>
                                        <div class="dropdown-main"></div>
                                        <div class="dropdown-bottom">
                                            <div class="dropdown-copyright">
                                                <ul class="page_footer-copyright_menu content list-unstyled">
                                                    <li class="page_footer-copyright_text">© DECIEM Beauty Group Inc.
                                                        2022. All rights reserved. </li>
                                                    <li>
                                                        <a href="<?= BASE_URL ?>/en-us/terms">Terms & Conditions</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= BASE_URL ?>/en-us/privacy-policy">Privacy
                                                            Policy</a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= BASE_URL ?>/en-us/do-not-sell">Do not sell my
                                                            personal information</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="js-cookie_settings-btn" data-toggle="modal"
                                                            data-target="#cookieConsentModal">Cookies</a>
                                                    </li>
                                                    <li class="page_footer-copyright_brand_link">
                                                        <a href="<?= BASE_URL ?>/en-us/deciem-about">A DECIEM
                                                            PROJECT.</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-faq"><a href="<?= BASE_URL ?>/en-us/faq" title="FAQ">
                                                    FAQ </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </ul>
                        <div class="site_nav_footer">
                            <ul class="list-unstyled ctas nav_footer-items">
                                <li class="user-link d-xl-none" role="menuitem"><a href="<?= BASE_URL ?>/en-us/login-1"
                                        class="icon-account dropdown-link" role="button">
                                        Sign in </a>
                                </li>
                                <li class="d-xl-none" role="menuitem"><a href="<?= BASE_URL ?>/en-us/contact-us"
                                        class="icon-contact-us dropdown-link" role="button">
                                        Contact Us </a>
                                </li>
                                <li class="d-xl-none" role="menuitem"><a href="<?= BASE_URL ?>/en-us/order-lookup"
                                        class="dropdown-link" role="button"> <img
                                            src="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dwd75589ed/images/icons/svg/track-order-black.svg"
                                            alt="track-order">
                                        Track Order </a>
                                </li>
                                <li class="d-xl-none site_nav_footer-country_selector" role="menuitem">
                                    <button class="country_selector-button icon-map_pin"
                                        data-target="#modalCountrySelector" data-toggle="modal">
                                        United States
                                    </button>
                                </li>
                            </ul>
                            <ul class="list-unstyled brand-list">
                                <li class="nav-item d-xl-none brands-item brands-item--active visit-theordinary"
                                    role="menuitem"><a href="<?= BASE_URL ?>/" class="brands-link"> <span>Visit</span>
                                        <img class="brands-item-logo"
                                            src="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dwa148e371/images/brands-logo/theordinary.svg"
                                            title="" alt=""> <img class="brands-item-logo brands-item-logo--black"
                                            src="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dw04f3255d/images/brands-logo/theordinary_black.svg"
                                            title="" alt=""> <img class="brands-item-logo brands-item-logo--white"
                                            src="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dw617e88ef/images/brands-logo/theordinary_white.svg"
                                            title="" alt=""> <span class="brand-name text-uppercase">The Ordinary</span>
                                    </a>
                                </li>
                                <li class="nav-item d-xl-none brands-item visit-niod" role="menuitem"><a
                                        href="/en-us-1?url=https%3A%2F%2Fniod.com%2Fen-us" class="brands-link">
                                        <span>Visit</span> <img class="brands-item-logo"
                                            src="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dw86c1e57d/images/brands-logo/niod.svg"
                                            title="" alt=""> <img class="brands-item-logo brands-item-logo--black"
                                            src="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dwaf34ce59/images/brands-logo/niod_black.svg"
                                            title="" alt=""> <img class="brands-item-logo brands-item-logo--white"
                                            src="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dw93298ae8/images/brands-logo/niod_white.svg"
                                            title="" alt=""> <span class="brand-name text-uppercase">Niod</span> </a>
                                </li>
                                <li class="nav-item d-xl-none brands-item visit-loopha" role="menuitem"><a
                                        href="/en-us-2?url=https%3A%2F%2Floopha.com%2Fen-us" class="brands-link">
                                        <span>Visit</span> <img class="brands-item-logo"
                                            src="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dw0e544fc0/images/brands-logo/loopha.svg"
                                            title="" alt=""> <img class="brands-item-logo brands-item-logo--black"
                                            src="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dw265a4cd3/images/brands-logo/loopha_black.svg"
                                            title="" alt=""> <img class="brands-item-logo brands-item-logo--white"
                                            src="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dw73bca2ea/images/brands-logo/loopha_white.svg"
                                            title="" alt=""> <span class="brand-name text-uppercase">Loopha</span> </a>
                                </li>
                                <li class="nav-item d-xl-none brands-item visit-deciem" role="menuitem"><a
                                        href="https://theordinary.com/s/Sites-deciem-us-Site/dw/shared_session_redirect?url=https%3A%2F%2Fdeciem.com%2Fen-us"
                                        class="brands-link"> <span>Visit</span> <img
                                            class="brands-item-logo brands-item-logo--black"
                                            src="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dwb462007d/images/brands-logo/deciem_full_black.svg"
                                            title="" alt=""> <img class="brands-item-logo brands-item-logo--white"
                                            src="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dw6b7f4d7f/images/brands-logo/deciem_full_white.svg"
                                            title="" alt=""> <span class="brand-name text-uppercase">Deciem</span> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </nav>
</header>