<?php
include 'config.php';
require_once 'admin/includes/db.php';

// Get Slug
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
if (!$slug) {
    header("Location: " . BASE_URL);
    exit;
}

// Fetch Product
$stmt = $pdo->prepare("SELECT * FROM products WHERE slug = ? AND status = 1");
$stmt->execute([$slug]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header("HTTP/1.0 404 Not Found");
    include 'header.php';
    echo '<div class="container text-center" style="padding:100px;"><h1>Product Not Found</h1></div>';
    include 'footer.php';
    exit;
}

// Fetch Variants
$stmtVar = $pdo->prepare("SELECT * FROM product_variants WHERE product_id = ? ORDER BY price ASC");
$stmtVar->execute([$product['id']]);
$variants = $stmtVar->fetchAll(PDO::FETCH_ASSOC);

// Fetch Images (Gallery)
$stmtImg = $pdo->prepare("SELECT * FROM product_images WHERE product_id = ? ORDER BY sort_order ASC");
$stmtImg->execute([$product['id']]);
$images = $stmtImg->fetchAll(PDO::FETCH_ASSOC);

// Combine Main Image if no gallery, or ensure structure
if (empty($images) && !empty($product['image'])) {
    $images[] = ['image_path' => $product['image']];
}

$pageTitle = $product['name'] . ' | The Ordinary';
$metaDesc = strip_tags($product['short_description']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDesc) ?>">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/icons-font.css">
    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/global.css">
    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/detail.css">

    <!-- JS -->
    <script defer
        src="<?= BASE_URL ?>/assets/js/jquery.min.js"></script>
    <script defer
        src="<?= BASE_URL ?>/assets/js/vendors.js"></script>
    <script defer
        src="<?= BASE_URL ?>/assets/js/js_main.js"></script>
    <script defer
        src="<?= BASE_URL ?>/assets/js/productDetail.js"></script>
    <script defer
        src="<?= BASE_URL ?>/assets/js/accordion.js"></script>

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

        /* Awards Adjustment */
        .awards-section {
            margin-top: 20px;
        }

        .awards-section img {
            width: 80px;
            height: auto;
            display: block;
        }

        /* Gallery Fixes - Aggressive */
        /* Gallery Fixes - Safeguard */
        .thumbnail-image-container {
            /* Ensure it has height for vertical swiper */
            min-height: 500px;
        }

        .swiper-wrapper {
            /* Default to column for vertical appearance before JS loads */
            display: flex;
            flex-direction: column;
            height: auto;
        }

        .swiper-slide {
            /* Ensure slides take up space */
            flex-shrink: 0;
            width: 100%;
            display: block !important;
            /* Force visibility */
            height: auto !important;
            margin-bottom: 10px;
        }

        /* Hover Zoom Effect */
        .zoom-container {
            overflow: hidden;
            cursor: crosshair;
            position: relative;
        }

        .zoom-container img {
            transition: transform 0.2s ease-out;
            transform-origin: center center;
            width: 100%;
            height: auto;
            display: block;
        }

        .zoom-container:hover img {
            transform: scale(1.8);
        }
    </style>
</head>

<body data-brand="theordinary">

    <div class="page js-page" data-action="Product-Show">
        <?php include 'header.php'; ?>

        <div role="main" id="maincontent">
            <div class="product product-detail js-product-detail js-pid-<?= $product['id'] ?>"
                data-pid="<?= $product['id'] ?>" data-gtm-enhanced-ecommerce="null" data-key-ingredient-asset-id="null">
                <div class="product-header js-product-header">

                    <div class="product-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item icon-right_chevron"><a href="<?= BASE_URL ?>">Home</a></li>
                            <li class="breadcrumb-item icon-right_chevron"><a href="#">Skincare</a></li>
                            <li class="breadcrumb-item"><span
                                    class="breadcrumb--current"><?= htmlspecialchars($product['name']) ?></span></li>
                        </ol>
                    </div>

                    <section class="product-details">
                        <!-- Mobile Title -->
                        <div class="product-title-area d-lg-none">
                            <div class="product-timetouse-title">
                                <div class="product-step-when-to-use">
                                    <p class="step-type">Step <?= htmlspecialchars($product['step_number'] ?? '1') ?>:
                                        <?= htmlspecialchars($product['regimen_step'] ?? 'Prep') ?>
                                    </p>
                                    <span class="time-to-use pm icon-pm"></span>
                                </div>
                                <h1 class="product-name"><?= htmlspecialchars($product['name']) ?></h1>
                            </div>
                        </div>

                        <div class="inner-wrap">
                            <!-- IMAGES (Gallery) - Restored Original Structure (Cleaned for JS Init) -->
                            <div class="product-images">
                                <div class="thumbnail-image-container">
                                    <!-- Removed 'swiper-initialized' etc. to let JS initialize it -->
                                    <div class="swiper outer-wrap">
                                        <div class="swiper-wrapper">

                                            <?php foreach ($images as $idx => $img):
                                                $src = strpos($img['image_path'], 'http') === 0 ? $img['image_path'] : BASE_URL . '/' . $img['image_path'];
                                                $activeClass = ($idx === 0) ? 'active' : '';
                                                ?>
                                                <div class="swiper-slide sw-item">
                                                    <picture>
                                                        <source media="(min-width: 1024px)" srcset="<?= $src ?>">
                                                        <img class="<?= $activeClass ?>" data-full-src="<?= $src ?>"
                                                            data-full-src-retina="<?= $src ?>" itemprop="image"
                                                            srcset="<?= $src ?>" src="<?= $src ?>"
                                                            alt="<?= htmlspecialchars($product['name']) ?>"
                                                            aria-title="<?= htmlspecialchars($product['name']) ?>">
                                                    </picture>

                                                    <div class="mobile-only">
                                                        <div class="pdp-product-tag">Trending</div>
                                                        <div class="pdp-award-tag">
                                                            <?php if (!empty($product['awards_image'])):
                                                                $awardSrc = strpos($product['awards_image'], 'http') === 0 ? $product['awards_image'] : BASE_URL . '/' . $product['awards_image'];
                                                                ?>
                                                                <img class="award-img" src="<?= $awardSrc ?>" alt="Award">
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>

                                        </div>
                                        <div class="swiper-scrollbar"></div>
                                    </div>

                                    <div class="custom-scrollbar d-lg-none"
                                        style="--scrollbar-width: 16.666666666666668%"
                                        data-slides="<?= count($images) ?>.0"></div>
                                </div>

                                <div class="zoom-container d-none d-lg-block">
                                    <?php
                                    $firstImg = !empty($images) ? $images[0]['image_path'] : '';
                                    if ($firstImg) {
                                        $mainSrc = strpos($firstImg, 'http') === 0 ? $firstImg : BASE_URL . '/' . $firstImg;
                                        ?>
                                        <picture>
                                            <source class="hd-source"
                                                media="(min-width: 1025px) and (-webkit-min-device-pixel-ratio: 2) and (min-resolution: 192dpi)"
                                                srcset="<?= $mainSrc ?>">
                                            <source class="sd-source" srcset="<?= $mainSrc ?>">
                                            <img itemprop="image" srcset="<?= $mainSrc ?>"
                                                alt="<?= htmlspecialchars($product['name']) ?>"
                                                aria-title="<?= htmlspecialchars($product['name']) ?>">
                                        </picture>
                                    <?php } ?>


                                </div>
                            </div>

                            <!-- INFO -->
                            <div class="product-info">
                                <div class="product-title-area d-none d-lg-block">
                                    <div class="product-timetouse-title">
                                        <div class="product-step-when-to-use">
                                            <p class="step-type">Step
                                                <?= htmlspecialchars($product['step_number'] ?? '1') ?>:
                                                <?= htmlspecialchars($product['regimen_step'] ?? 'Prep') ?>
                                            </p>
                                            <span class="time-to-use pm icon-pm"></span>
                                        </div>
                                        <h1 class="product-name"><?= htmlspecialchars($product['name']) ?></h1>

                                        <div class="product-price">
                                            <div class="prices">
                                                <div class="price">
                                                    <span class="value"
                                                        id="productPriceDisplay">$<?= number_format($product['price'], 2) ?>
                                                        USD</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="active-ingredient-flyout-root">
                                    <aside class="active-ingredient-flyout">
                                        <button type="button" class="close icon-close" title="Close"
                                            aria-label="Close"></button>
                                        <div class="title">Ingredients</div>
                                        <p class="ingredients-flyout-content">
                                            <?= htmlspecialchars($product['ingredients']) ?>
                                        </p>
                                    </aside>
                                </div>

                                <div class="product-info-description">
                                    <div class="description">
                                        <?= htmlspecialchars($product['short_description']) ?>
                                    </div>
                                </div>

                                <!-- Variations / Size Selector -->
                                <div class="variations-desktop">
                                    <div class="attributes product_tile-attributes">
                                        <div class="product_price_and_size">
                                            <div class="size_wrap">
                                                <div class="attribute-values product_tile-attributes_value product-variation"
                                                    data-attr="size">

                                                    <!-- If Variants Exist, Render Loop -->
                                                    <?php if (!empty($variants)): ?>
                                                        <?php foreach ($variants as $idx => $var): ?>
                                                            <div class="attribute-value-container">
                                                                <button
                                                                    class="js-variant-select attribute-value_link item product_tile-attributes_link size <?= $idx === 0 ? 'selected' : '' ?> selectable"
                                                                    data-price="<?= $var['price'] ?>"
                                                                    data-image="<?= $var['image_path'] ? (strpos($var['image_path'], 'http') === 0 ? $var['image_path'] : BASE_URL . '/' . $var['image_path']) : '' ?>"
                                                                    data-size="<?= htmlspecialchars($var['size']) ?>">
                                                                    <span
                                                                        class="size-value swatch-rectangle swatch-value <?= $idx === 0 ? 'selected' : '' ?> selectable">
                                                                        <?= htmlspecialchars($var['size']) ?>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        <?php endforeach; ?>

                                                        <!-- Fallback only if no variants but size exists -->
                                                    <?php elseif ($product['size']): ?>
                                                        <div class="attribute-value-container">
                                                            <button
                                                                class="attribute-value_link item product_tile-attributes_link size selected selectable">
                                                                <span
                                                                    class="size-value swatch-rectangle swatch-value selected selectable">
                                                                    <?= htmlspecialchars($product['size']) ?>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Add to Cart / Custom Link -->
                                        <div class="product-quantity">
                                            <div class="product-add">
                                                <div class="adding_to_cart">
                                                    <div class="adding_to_cart-inner">
                                                        <?php if (!empty($product['add_to_cart_url'])): ?>
                                                            <a href="<?= htmlspecialchars($product['add_to_cart_url']) ?>"
                                                                target="_blank"
                                                                class="add-to-cart btn btn-outline-primary adding_to_cart-btn_states available-to-purchase"
                                                                style="display:flex; align-items:center; justify-content:center; text-decoration:none;">
                                                                <span class="icon-cart atc-icon">Add to Cart</span>
                                                            </a>
                                                        <?php else: ?>
                                                            <button
                                                                class="add-to-cart btn btn-outline-primary adding_to_cart-btn_states available-to-purchase">
                                                                <span class="icon-cart atc-icon">Add to Cart</span>
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Attributes Panel -->
                                <div class="product-attribute-panel">
                                    <?php if ($product['targets']): ?>
                                        <p class="skin-concern panel-item">
                                            <span class="title">Targets</span>
                                            <?= htmlspecialchars($product['targets']) ?>
                                        </p>
                                    <?php endif; ?>

                                    <?php if ($product['suited_to']): ?>
                                        <p class="suitedTo panel-item">
                                            <span class="title">Suited to</span>
                                            <?= htmlspecialchars($product['suited_to']) ?>
                                        </p>
                                    <?php endif; ?>

                                    <?php if ($product['format']): ?>
                                        <p class="format panel-item">
                                            <span class="title">Format</span>
                                            <?= htmlspecialchars($product['format']) ?>
                                        </p>
                                    <?php endif; ?>

                                    <!-- Key Ingredients Dynamic -->
                                    <?php if ($product['key_ingredients']): ?>
                                        <div class="active-Ingredient panel-item">
                                            <span class="title">Key ingredients</span>
                                            <div class="list"><?= htmlspecialchars($product['key_ingredients']) ?></div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Highlights & Awards -->
                                <div class="content property-content">
                                    <h3>Highlights</h3>
                                    <div class="product-properties">
                                        <dl class="product-properties-list">
                                            <?php if (!empty($product['ph_range'])): ?>
                                                <div class="properties-list-item">
                                                    <dt class="product-properties-term">ph</dt>
                                                    <dd class="product-properties-definition">
                                                        <?= htmlspecialchars($product['ph_range']) ?>
                                                    </dd>
                                                </div>
                                            <?php endif; ?>

                                            <?php
                                            $props = [
                                                'water-free' => 'is_water_free',
                                                'alcohol-free' => 'is_alcohol_free',
                                                'oil-free' => 'is_oil_free',
                                                'silicone-free' => 'is_silicone_free',
                                                'vegan' => 'is_vegan',
                                                'gluten-free' => 'is_gluten_free',
                                                'cruelty-free' => 'is_cruelty_free'
                                            ];
                                            foreach ($props as $label => $col) {
                                                $val = $product[$col];
                                                $trueClass = "product-properties-definition product-property-true icon-check icon-" . str_replace('-', '', $label);
                                                $falseClass = "product-property-false";
                                                $svgClose = '<svg class="close-icon" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 52 52"><path d="M31.6 25.8l13.1-13.1c.6-.6.6-1.5 0-2.1l-2.1-2.1c-.6-.6-1.5-.6-2.1 0L27.4 21.6a1 1 0 01-1.4 0L12.9 8.4c-.6-.6-1.5-.6-2.1 0l-2.1 2.1c-.6.6-.6 1.5 0 2.1l13.1 13.1c.4.4.4 1 0 1.4L8.6 40.3c-.6.6-.6 1.5 0 2.1l2.1 2.1c.6.6 1.5.6 2.1 0L26 31.4a1 1 0 011.4 0l13.1 13.1c.6.6 1.5.6 2.1 0l2.1-2.1c.6-.6.6-1.5 0-2.1L31.6 27.2c-.3-.4-.3-1 0-1.4z"></path></svg>';
                                                echo '<div class="properties-list-item">';
                                                echo '<dt class="property-name product-properties-term">' . $label . '</dt>';
                                                echo $val ? '<dd class="' . $trueClass . '"><span class="sr-only">Yes</span></dd>' : '<dd class="' . $falseClass . '">' . $svgClose . '<span class="sr-only">No</span></dd>';
                                                echo '</div>';
                                            }
                                            ?>
                                        </dl>

                                        <!-- Awards Image (Moved Here) -->
                                        <?php if (!empty($product['awards_image'])):
                                            $awardSrc = strpos($product['awards_image'], 'http') === 0 ? $product['awards_image'] : BASE_URL . '/' . $product['awards_image'];
                                            ?>
                                            <div class="awards-section">
                                                <h3>Awards & Features</h3>
                                                <img src="<?= $awardSrc ?>" alt="Awards">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>

                    <!-- Expanded Details -->
                    <div class="product-block product-overview overview-section">
                        <div class="overview-wrapper">
                            <div class="product-block-header">
                                <h2>Overview</h2>
                            </div>
                            <div class="product-block-content show">
                                <div class="inner p-3">
                                    <div class="content description-content">
                                        <?= $product['description'] ?>
                                    </div>
                                    <div class="content testing-content mt-4">
                                        <h3>Testing Shows</h3>
                                        <?= $product['testing_results'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const priceDisplay = document.getElementById('productPriceDisplay');
            const variantButtons = document.querySelectorAll('.js-variant-select');

            // Variants Logic
            variantButtons.forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();

                    // 1. Update Price
                    const newPrice = this.getAttribute('data-price');
                    if (priceDisplay && newPrice) {
                        priceDisplay.textContent = '$' + parseFloat(newPrice).toFixed(2) + ' USD';
                    }

                    // 2. Update Selected State
                    variantButtons.forEach(b => {
                        b.classList.remove('selected');
                        const val = b.querySelector('.size-value');
                        if (val) val.classList.remove('selected');
                    });
                    this.classList.add('selected');
                    const thisVal = this.querySelector('.size-value');
                    if (thisVal) thisVal.classList.add('selected');

                    // 3. Update Image from Variant (Targeting the Zoom Container implementation)
                    const newImage = this.getAttribute('data-image');
                    if (newImage) {
                        const mainImg = document.querySelector('.zoom-container img');
                        const mainSource = document.querySelector('.zoom-container source');

                        if (mainImg) {
                            mainImg.src = newImage;
                            mainImg.srcset = newImage;
                        }
                        if (mainSource) {
                            mainSource.srcset = newImage;
                        }
                    }
                });
            });

            // Zoom Logic (Mouse Tracking)
            const zoomContainer = document.querySelector('.zoom-container');
            if (zoomContainer) {
                zoomContainer.addEventListener('mousemove', function (e) {
                    const rect = this.getBoundingClientRect();
                    const x = ((e.clientX - rect.left) / rect.width) * 100;
                    const y = ((e.clientY - rect.top) / rect.height) * 100;

                    const img = this.querySelector('img');
                    if (img) {
                        img.style.transformOrigin = `${x}% ${y}%`;
                    }
                });
            }
        });
    </script>

</body>

</html>