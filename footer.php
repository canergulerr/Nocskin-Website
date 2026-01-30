<?php
require_once __DIR__ . '/admin/includes/db.php';

// Fetch Settings
$fs_stmt = $pdo->query("SELECT * FROM footer_settings LIMIT 1");
$footer_settings = $fs_stmt->fetch(PDO::FETCH_ASSOC);

// Fetch All Footer Menus
$fm_stmt = $pdo->query("SELECT * FROM menus WHERE location LIKE 'footer_%' AND status = 1 ORDER BY position ASC, id ASC");
$all_menus = $fm_stmt->fetchAll(PDO::FETCH_ASSOC);

// Organize Menus by Parent ID for easy access
$menus_by_parent = [];
$root_menus_by_title = [];
$footer_bottom_links = [];

foreach ($all_menus as $menu) {
        if ($menu['location'] === 'footer_bottom') {
                $footer_bottom_links[] = $menu;
        } else {
                $menus_by_parent[$menu['parent_id']][] = $menu;
                if ($menu['parent_id'] == 0) {
                        $root_menus_by_title[trim($menu['title'])] = $menu;
                }
        }
}

// Function to get children of a specific root title
function getChildrenByTitle($root_title, $root_menus_by_title, $menus_by_parent)
{
        if (isset($root_menus_by_title[$root_title])) {
                $root_id = $root_menus_by_title[$root_title]['id'];
                return $menus_by_parent[$root_id] ?? [];
        }
        return [];
}

// Map sections
$company_links = getChildrenByTitle('Şirket', $root_menus_by_title, $menus_by_parent);
$commitments_links = getChildrenByTitle('Taahhütlerimiz', $root_menus_by_title, $menus_by_parent);
$support_links = getChildrenByTitle('Müşteri Hizmetleri', $root_menus_by_title, $menus_by_parent);
$giftcard_links = getChildrenByTitle('Hediye Kartları', $root_menus_by_title, $menus_by_parent);
// 'Bize Ulaşın' (formerly Hızlı Erişim/Storefront)
$storefront_links = getChildrenByTitle('Bize Ulaşın', $root_menus_by_title, $menus_by_parent);
// Fallback if 'Bize Ulaşın' isn't found (maybe it's 'Hızlı Erişim')
if (empty($storefront_links)) {
        $storefront_links = getChildrenByTitle('Hızlı Erişim', $root_menus_by_title, $menus_by_parent);
}

?>
<footer id="footercontent" class="page_footer position-relative js-page_footer">
        <div class="container">
                <div class="page_footer-container row" id="footerAccordion">
                        <div
                                class="page_footer-container_newsletter js-footer-container_newsletter col-lg-4 float-lg-right">
                                <div class="page_footer-newsletter">
                                        <div class="page_footer-newsletter_wrapper js-handle-astronaut d-md-block"
                                                id="footerNewsletterCustomer"
                                                aria-labelledby="footerAccordionNewsletter"
                                                data-parent="#footerAccordion">
                                                <h3 class="page_footer-newsletter_promo js-footer-newsletter_promo">
                                                        <?= htmlspecialchars($footer_settings['newsletter_title'] ?? 'Haberdar olun.') ?>
                                                </h3>
                                                <p class="page_footer-newsletter_subheading">
                                                        <?= htmlspecialchars($footer_settings['newsletter_description'] ?? 'Bilimsel olarak desteklenen ipuçları, özel tekliflere erişim ve yeni yenilikler almak için abone olun.') ?>
                                                </p>
                                                <form class="js-subscribe_email-form" role="form" action="#"
                                                        aria-label="Subscribe to newsletter" onsubmit="return false;">
                                                        <div
                                                                class="input-group form-group page_footer-newsletter_wrapper">
                                                                <label class="form-control-label" for="footer_email">
                                                                        E-Posta Adresi
                                                                </label>
                                                                <input type="email"
                                                                        class="form-control page_footer-newsletter_input js-footer-newsletter_input"
                                                                        id="footer_email" aria-label="Email Address"
                                                                        required>
                                                                <div
                                                                        class="input-group-append page_footer-newsletter_append">
                                                                        <button type="submit" aria-label="Subscribe"
                                                                                class="page_footer-newsletter_btn icon-right_chevron"><span
                                                                                        class="sr-only">Subscribe</span>
                                                                        </button>
                                                                </div>
                                                        </div>
                                                </form>
                                                <div class="page_footer-newsletter_description">
                                                        <?= nl2br($footer_settings['newsletter_disclaimer'] ?? '') ?>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="page_footer-container_links float-lg-left col-lg-8 mb-md-1">
                                <div class="row main-footer-row">
                                        <div class="col-left col-lg-4">

                                                <!-- Şirket (Company) -->
                                                <div class="page_footer-item about">
                                                        <div class="content-asset">
                                                                <h3 class="page_footer-heading"
                                                                        id="footerAccordionCompany"
                                                                        data-toggle="collapse" aria-expanded="false"
                                                                        data-target="#footerCollapseCompany">
                                                                        Şirket <button
                                                                                class="d-lg-none page_footer-heading_toggle-btn collapsed"
                                                                                data-toggle="collapse"
                                                                                data-target="#footerCollapseCompany"
                                                                                aria-expanded="false"
                                                                                aria-controls="footerCollapseCompany"
                                                                                aria-label="Toggle company links list"></button>
                                                                </h3>
                                                                <div class="collapse d-lg-block"
                                                                        id="footerCollapseCompany"
                                                                        aria-labelledby="footerAccordionCompany"
                                                                        data-parent="#footerAccordion">
                                                                        <ul
                                                                                class="page_footer-menu list-unstyled mb-md-1">
                                                                                <?php foreach ($company_links as $link): ?>
                                                                                        <li><a href="<?= htmlspecialchars(BASE_URL . '/' . ltrim($link['url'], '/')) ?>"><?= htmlspecialchars($link['title']) ?></a>
                                                                                        </li>
                                                                                <?php endforeach; ?>
                                                                        </ul>
                                                                </div>
                                                        </div>
                                                </div>

                                                <!-- Taahhütlerimiz (Commitments) -->
                                                <div class="page_footer-item commitments collapsible-xs">
                                                        <div class="content-asset">
                                                                <h3 class="page_footer-heading"
                                                                        id="footerAccordionCommitments"
                                                                        data-toggle="collapse" aria-expanded="false"
                                                                        data-target="#footerCollapseCommitments">
                                                                        Taahhütlerimiz<button
                                                                                class="d-lg-none page_footer-heading_toggle-btn collapsed"
                                                                                data-toggle="collapse"
                                                                                data-target="#footerCollapseCommitments"
                                                                                aria-expanded="false"
                                                                                aria-controls="footerCollapseCommitments"
                                                                                aria-label="Toggle company links list"></button>
                                                                </h3>
                                                                <div class="collapse d-lg-block"
                                                                        id="footerCollapseCommitments"
                                                                        aria-labelledby="footerAccordionCommitments"
                                                                        data-parent="#footerAccordion">
                                                                        <ul
                                                                                class="page_footer-menu list-unstyled mb-md-1">
                                                                                <?php foreach ($commitments_links as $link): ?>
                                                                                        <li><a href="<?= htmlspecialchars(BASE_URL . '/' . ltrim($link['url'], '/')) ?>"><?= htmlspecialchars($link['title']) ?></a>
                                                                                        </li>
                                                                                <?php endforeach; ?>
                                                                        </ul>
                                                                </div>
                                                        </div>
                                                </div>

                                        </div>
                                        <div class="col-middle col-lg-4">

                                                <!-- Müşteri Hizmetleri (Support) -->
                                                <div class="page_footer-item support collapsible-xs">
                                                        <div class="content-asset">
                                                                <h3 class="page_footer-heading"
                                                                        id="footerAccordionCustomer"
                                                                        data-toggle="collapse" aria-expanded="false"
                                                                        data-target="#footerCollapseCustomer">
                                                                        Müşteri Hizmetleri <button
                                                                                class="d-lg-none page_footer-heading_toggle-btn collapsed"
                                                                                data-toggle="collapse"
                                                                                data-target="#footerCollapseCustomer"
                                                                                aria-expanded="false"
                                                                                aria-controls="footerCollapseCustomer"
                                                                                aria-label="Toggle castomer care links list"></button>
                                                                </h3>
                                                                <div class="collapse d-lg-block"
                                                                        id="footerCollapseCustomer"
                                                                        aria-labelledby="footerAccordionCustomer"
                                                                        data-parent="#footerAccordion">
                                                                        <ul class="page_footer-menu list-unstyled">
                                                                                <?php foreach ($support_links as $link): ?>
                                                                                        <li><a href="<?= htmlspecialchars(BASE_URL . '/' . ltrim($link['url'], '/')) ?>"><?= htmlspecialchars($link['title']) ?></a>
                                                                                        </li>
                                                                                <?php endforeach; ?>
                                                                        </ul>
                                                                </div>
                                                        </div>
                                                </div>

                                                <!-- Hediye Kartları (Gift Cards) -->
                                                <div class="page_footer-item giftcards collapsible-xs">
                                                        <div class="content-asset">
                                                                <h3 class="page_footer-heading"
                                                                        id="footerAccordionGiftCards"
                                                                        data-toggle="collapse" aria-expanded="false"
                                                                        data-target="#footerCollapseGiftCards">
                                                                        Hediye Kartları <button
                                                                                class="d-lg-none page_footer-heading_toggle-btn collapsed"
                                                                                data-toggle="collapse"
                                                                                data-target="#footerCollapseGiftCards"
                                                                                aria-expanded="false"
                                                                                aria-controls="footerCollapseGiftCards"
                                                                                aria-label="Toggle gift card list"></button>
                                                                </h3>
                                                                <div class="collapse d-lg-block"
                                                                        id="footerCollapseGiftCards"
                                                                        aria-labelledby="footerAccordionGiftCards"
                                                                        data-parent="#footerAccordion">
                                                                        <ul class="page_footer-menu list-unstyled">
                                                                                <?php foreach ($giftcard_links as $link): ?>
                                                                                        <li><a href="<?= htmlspecialchars(BASE_URL . '/' . ltrim($link['url'], '/')) ?>"><?= htmlspecialchars($link['title']) ?></a>
                                                                                        </li>
                                                                                <?php endforeach; ?>
                                                                        </ul>
                                                                </div>
                                                        </div>
                                                </div>

                                        </div>
                                        <div class="col-right col-lg-4">

                                                <!-- Bize Ulaşın / Storefront Links -->
                                                <div class="page_footer-item storefront-links">
                                                        <div class="content-asset">
                                                                <div class="storefront-links-container">
                                                                        <ul class="page_footer-menu list-unstyled">

                                                                                <!-- Hardcoded "Bize Ulaşın" Header in lieu of separate H3 because design has it as simple list -->
                                                                                <li class="font-weight-bold mb-2">Bize
                                                                                        Ulaşın</li>

                                                                                <?php foreach ($storefront_links as $link): ?>
                                                                                        <li><a href="<?= htmlspecialchars(BASE_URL . '/' . ltrim($link['url'], '/')) ?>"><?= htmlspecialchars($link['title']) ?></a>
                                                                                        </li>
                                                                                <?php endforeach; ?>
                                                                        </ul>
                                                                </div>
                                                        </div>
                                                </div>

                                        </div>
                                </div>
                        </div>

                        <!-- Social Icons -->
                        <div class="page_footer-social col-lg-4 float-lg-right">
                                <div class="content-asset">
                                        <ul class="page_footer-social_links list-unstyled">
                                                <?php if (!empty($footer_settings['social_facebook'])): ?>
                                                        <li class="page_footer-social_item page_footer-social_item--facebook"><a
                                                                        title="Go to Facebook"
                                                                        href="https://facebook.com/<?= htmlspecialchars($footer_settings['social_facebook']) ?>"
                                                                        target="_blank" class="icon-facebook"></a></li>
                                                <?php endif; ?>
                                                <?php if (!empty($footer_settings['social_instagram'])): ?>
                                                        <li class="page_footer-social_item page_footer-social_item--instagram">
                                                                <a title="Go to Instagram"
                                                                        href="https://instagram.com/<?= htmlspecialchars($footer_settings['social_instagram']) ?>"
                                                                        target="_blank" class="icon-instagram"></a></li>
                                                <?php endif; ?>
                                                <?php if (!empty($footer_settings['social_youtube'])): ?>
                                                        <li class="page_footer-social_item page_footer-social_item--youtube"><a
                                                                        title="Go to YouTube"
                                                                        href="https://youtube.com/<?= htmlspecialchars($footer_settings['social_youtube']) ?>"
                                                                        target="_blank" class="icon-youtube"></a></li>
                                                <?php endif; ?>
                                                <?php if (!empty($footer_settings['social_tiktok'])): ?>
                                                        <li class="page_footer-social_item page_footer-social_item--tiktok"><a
                                                                        title="Go to Tiktok"
                                                                        href="https://tiktok.com/<?= htmlspecialchars($footer_settings['social_tiktok']) ?>"
                                                                        target="_blank" class="icon-tiktok"></a></li>
                                                <?php endif; ?>
                                        </ul>
                                </div>
                        </div>

                        <!-- Copyright & Bottom Links -->
                        <div class="page_footer-container_newsletter col-lg-12 float-lg-left">
                                <div class="page_footer-copyright">
                                        <div class="content-asset">
                                                <ul class="page_footer-copyright_menu content list-unstyled">
                                                        <li class="page_footer-copyright_text">
                                                                <?= htmlspecialchars($footer_settings['copyright_text'] ?? '© NOC. 2026. Tüm hakları saklıdır.') ?>
                                                        </li>

                                                        <?php foreach ($footer_bottom_links as $link):
                                                                // Skip "A UNITAB PROJESİ." if found, as it is separate in original design
                                                                if ($link['title'] === 'A UNITAB PROJESİ.')
                                                                        continue;
                                                                ?>
                                                                <li>
                                                                        <a
                                                                                href="<?= htmlspecialchars(BASE_URL . '/' . ltrim($link['url'], '/')) ?>"><?= htmlspecialchars($link['title']) ?></a>
                                                                </li>
                                                        <?php endforeach; ?>

                                                        <li class="page_footer-copyright_brand_link">
                                                                <a href="en-us/deciem-about">A UNITAB PROJESİ.</a>
                                                        </li>
                                                </ul>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</footer>