<?php
// Banner Helper Function

/**
 * Renders a banner with the specified page identifier.
 * Uses output buffering to prevent immediate output if needed.
 * 
 * @param PDO $pdo Database connection object
 * @param string $page_identifier Unique identifier for the banner
 */
function render_banner($pdo, $page_identifier)
{
    try {
        $stmt = $pdo->prepare("SELECT * FROM banners WHERE page_identifier = ? LIMIT 1");
        $stmt->execute([$page_identifier]);
        $banner = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $banner = null;
    }

    if (!$banner) {
        // Optionally render nothing or a default fallback if absolutely necessary
        // For now, if no banner exists in DB, we return empty string to avoid breaking layout
        return;
    }

    // Ensure BASE_URL is available
    if (!defined('BASE_URL')) {
        // Fallback for define if not set, though it should be by config
        $base_url = '/noc_new';
    } else {
        $base_url = BASE_URL;
    }

    ?>
    <style>
        .amplience_category_hero {
            width: 100vw !important;
            position: relative !important;
            left: 50% !important;
            right: 50% !important;
            margin-left: -50vw !important;
            margin-right: -50vw !important;
            max-width: 100vw !important;
            padding: 0 !important;
            top: -25px !important;
        }

        .amplience_category_hero .content-wrapper {
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
    </style>
    <div class="ampliance_layout media-with-cta amplience_category_hero mt-0">
        <div class="content-wrapper">
            <div class="amp_partial content-image">
                <picture>
                    <source media="(min-width: 1440px)"
                        data-srcset="<?= $base_url . '/' . htmlspecialchars($banner['image_desktop']) ?>">
                    <source media="(min-width: 1024px)"
                        data-srcset="<?= $base_url . '/' . htmlspecialchars($banner['image_desktop']) ?>">
                    <source
                        data-srcset="<?= $base_url . '/' . htmlspecialchars($banner['image_mobile'] ?: $banner['image_desktop']) ?>">
                    <img class="lazy" alt="<?= htmlspecialchars($banner['title']) ?>" itemprop="image"
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAANQTFRF+Pj4c64OKQAAAApJREFUeJxjYAAAAAIAAUivpHEAAAAASUVORK5CYII=">
                </picture>
            </div>
            <h1 class="category_title h2 d-lg-none">
                <?= htmlspecialchars($banner['title']) ?>
            </h1>
        </div>

        <div class="overlay-wrapper">
            <h1 class="category_title h2 d-none d-lg-block">
                <?= htmlspecialchars($banner['title']) ?>
            </h1>

            <div class="category_description">
                <?= htmlspecialchars($banner['description']) ?>
            </div>

            <div class="regimen_section">
                <span class="regimen_section-text"></span>
                <?php if (!empty($banner['button_text'])): ?>
                    <div class="amp_partial general-cta">
                        <a class="btn-rounded-primary" href="<?= htmlspecialchars($banner['button_url']) ?>">
                            <?= htmlspecialchars($banner['button_text']) ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($banner['shop_link_text'])): ?>
                <div class="amp_partial shop-cta">
                    <a class="shop-arrow-link icon-arrow" href="<?= htmlspecialchars($banner['shop_link_url']) ?>">
                        <?= htmlspecialchars($banner['shop_link_text']) ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
}
?>