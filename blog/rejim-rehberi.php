<?php
include dirname(__DIR__) . '/config.php';
include BASE_PATH . '/admin/includes/db.php';
require_once __DIR__ . '/../includes/banner_helper.php';
$slug = 'rejim-rehberi';
$stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE slug = ? AND status = 1");
$stmt->execute([$slug]);
$post = $stmt->fetch();

$sections = [];
if ($post) {
    $stmtSec = $pdo->prepare("SELECT section_key, section_value FROM blog_post_sections WHERE post_id = ?");
    $stmtSec->execute([$post['id']]);
    $sections = $stmtSec->fetchAll(PDO::FETCH_KEY_PAIR);
}
function s($key, $default = '')
{
    global $sections;
    return isset($sections[$key]) && $sections[$key] !== '' ? $sections[$key] : $default;
}
if (!$post) {
    $post = ['meta_title' => 'Rejim Rehberi', 'meta_description' => ''];
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
    <script type="text/javascript" src="<?= BASE_URL ?>/assets/js/main.js"></script>
    <script
        type="text/javascript">window.OrdergrooveTrackingUrl = "/on/demandware.store/Sites-deciem-us-Site/en_US/OrderGroove-PurchasePostTracking"</script>
    <script type="text/javascript">window.OrdergrooveLegacyOffers = false</script>
    <script type="text/javascript">window.SFRA = window.SFRA || {};</script>

    <!--<![endif]-->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title><?= htmlspecialchars($post['meta_title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($post['meta_description']) ?>">
    <meta name="keywords" content="Skincare regimen">

    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/icons-font.css">
    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/global.css">

    <!-- SEO and Analytics meta tags skipped for brevity but should be here -->
</head>

<body data-brand="theordinary">
    <?php include BASE_PATH . '/header.php'; ?>

    <div role="main" id="maincontent">
        <!-- Dyn Content -->
        <div role="main" id="maincontent">
            <?php render_banner($pdo, 'blog-rejim-rehberi'); ?>
            <div class="ampliance_layout layout1">
                <div class="d-md-flex flex-wrap inner">

                    <div class="col-12 col-lg-5 left-col">
                        <h1 class="title-wrap">
                            <span class="title-text"><?= s('main_title') ?></span>
                        </h1>
                    </div>

                    <div class="col-md-6 col-lg-4 middle-col keyline">
                        <div class="d-flex d-md-block">
                            <div class="col-6 col-md-12">
                            </div>
                            <div class="d-md-none col-6">
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 col-lg-3 right-col">

                        <div class="copy-block keyline">
                            <div class="d-none d-md-block">
                            </div>


                            <div class="amp_partial text-block">
                                <p>
                                    <style>
                                        .ampliance_layout.layout1 {
                                            @media only screen and (max-width: 500px) {
                                                img {
                                                    display: none;
                                                }
                                            }
                                        }
                                    </style> <img src="<?= s('header_logo_url') ?>" width="75px" height="75px">
                                </p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>



























































            <div class="ampliance_layout layout4">
                <div class="d-flex flex-wrap flex-column">

                    <h2 class="title-block">
                        <span class="title-text"><?= s('regimen_basics_title') ?></span>
                    </h2>

                    <div class="d-flex flex-wrap flex-column flex-xl-row justify-content-xl-between">

                        <div class="image-block-1 d-none d-xl-block image-block">

                        </div>

                        <div class="text-content d-flex justify-content-start">
                            <div class="amp_partial text-block single-column">
                                <?= s('regimen_basics_text') ?>
                            </div>

                        </div>

                        <div class="image-block-2 d-flex justify-content-end align-items-xl-end">

                        </div>

                    </div>

                </div>
            </div>























































            <div class="ampliance_layout layout4">
                <div class="d-flex flex-wrap flex-column">

                    <h2 class="title-block">
                        <span class="title-text"><?= s('how_many_products_title') ?></span>
                    </h2>

                    <div class="d-flex flex-wrap flex-column flex-xl-row justify-content-xl-between">

                        <div class="image-block-1 d-none d-xl-block image-block">

                            <div class="amp_partial content-image">
                                <img class="lazy" alt="The Ordinary Product Swatch"
                                    data-src="<?= s('how_many_products_image') ?>"
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAANQTFRF+Pj4c64OKQAAAApJREFUeJxjYAAAAAIAAUivpHEAAAAASUVORK5CYII=">
                            </div>
                        </div>

                        <div class="text-content d-flex justify-content-start">
                            <div class="amp_partial text-block single-column">
                                <p>Bu durum cilt tipine ve/veya cilt sorununa göre değişebilir. Daha hassas cilde sahip
                                    olanlar veya bazı cilt bakım içeriklerine yeni başlayanlar daha basit bir rutin
                                    tercih edebilir. Oysa cilt bakımına meraklı olanlar, kapsamlı ve çok katmanlı bir
                                    cilt bakım rejimiyle daha rahat edebilirler.</p>
                                <p>Bir tedavi programını 3 adımdan oluşan bir süreç olarak düşünün: <b>Hazırlık, İşlem
                                        ve Koruma.</b></p>
                            </div>

                        </div>

                        <div class="image-block-2 d-flex justify-content-end align-items-xl-end">

                        </div>

                    </div>

                </div>
            </div>























































            <div class="ampliance_layout layout4">
                <div class="d-flex flex-wrap flex-column">

                    <h2 class="title-block">
                        <span class="title-text"><?= s('step1_title') ?></span>
                    </h2>

                    <div class="d-flex flex-wrap flex-column flex-xl-row justify-content-xl-between">

                        <div class="image-block-1 d-none d-xl-block image-block">

                        </div>

                        <div class="text-content d-flex justify-content-start">
                            <div class="amp_partial text-block single-column">
                                <?= s('step1_text') ?>
                            </div>

                        </div>

                        <div class="image-block-2 d-flex justify-content-end align-items-xl-end">

                            <div class="amp_partial content-image">
                                <img class="lazy" alt="" data-src="<?= s('middle_right_image') ?>"
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAANQTFRF+Pj4c64OKQAAAApJREFUeJxjYAAAAAIAAUivpHEAAAAASUVORK5CYII=">
                            </div>
                        </div>

                    </div>

                </div>
            </div>























































            <div class="ampliance_layout layout4">
                <div class="d-flex flex-wrap flex-column">

                    <h1 class="title-block">
                        <span class="title-text"><?= s('step2_title') ?></span>
                    </h1>

                    <div class="d-flex flex-wrap flex-column flex-xl-row justify-content-xl-between">

                        <div class="image-block-1 d-none d-xl-block image-block">

                        </div>

                        <div class="text-content d-flex justify-content-start">
                            <div class="amp_partial text-block single-column">
                                <?= s('step2_text') ?>
                            </div>

                        </div>

                        <div class="image-block-2 d-flex justify-content-end align-items-xl-end">

                        </div>

                    </div>

                </div>
            </div>



































































            <div class="amp_partial content-image">



                <picture>
                    <source media="(min-width: 1200px)"
                        data-srcset="<?= s('infographic_image') ?> 1x, https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_01?fmt=auto&$poi$&sm=aspect&w=3100&aspect=4:1 2x">

                    <source media="(min-width: 768px)"
                        data-srcset="https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_01_MOBILE11?fmt=auto&$poi$&sm=aspect&w=1200&aspect=4:3 1x, https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_01_MOBILE11?fmt=auto&$poi$&sm=aspect&w=2400&aspect=4:3 2x">

                    <source media="(min-width: 376px)"
                        data-srcset="https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_01_MOBILE11?fmt=auto&$poi$&sm=aspect&w=600&aspect=4:3 1x, https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_01_MOBILE11?fmt=auto&$poi$&sm=aspect&w=1200&aspect=4:3 2x">
                    <source
                        data-srcset="https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_01_MOBILE11?fmt=auto&$poi$&sm=aspect&w=400&aspect=4:3 1x, https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_01_MOBILE11?fmt=auto&$poi$&sm=aspect&w=800&aspect=4:3 2x">
                    <img class="lazy" alt="" itemprop="image"
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAANQTFRF+Pj4c64OKQAAAApJREFUeJxjYAAAAAIAAUivpHEAAAAASUVORK5CYII=">
                </picture>



            </div>























































            <div class="amp_partial content-image">



                <picture>
                    <source media="(min-width: 1200px)"
                        data-srcset="https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_02?fmt=auto&$poi$&sm=aspect&w=1550&aspect=4:1 1x, https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_02?fmt=auto&$poi$&sm=aspect&w=3100&aspect=4:1 2x">

                    <source media="(min-width: 768px)"
                        data-srcset="https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_02_MOBILE11?fmt=auto&$poi$&sm=aspect&w=1200&aspect=4:3 1x, https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_02_MOBILE11?fmt=auto&$poi$&sm=aspect&w=2400&aspect=4:3 2x">

                    <source media="(min-width: 376px)"
                        data-srcset="https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_02_MOBILE11?fmt=auto&$poi$&sm=aspect&w=600&aspect=4:3 1x, https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_02_MOBILE11?fmt=auto&$poi$&sm=aspect&w=1200&aspect=4:3 2x">
                    <source
                        data-srcset="https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_02_MOBILE11?fmt=auto&$poi$&sm=aspect&w=400&aspect=4:3 1x, https://cdn.media.amplience.net/i/deciem/ORD-Slowvember2024-RegimenBlogRefresh-INFOGRAPHIC_02_MOBILE11?fmt=auto&$poi$&sm=aspect&w=800&aspect=4:3 2x">
                    <img class="lazy" alt="" itemprop="image"
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAANQTFRF+Pj4c64OKQAAAApJREFUeJxjYAAAAAIAAUivpHEAAAAASUVORK5CYII=">
                </picture>



            </div>











































            <div class="ampliance_layout layout4">
                <div class="d-flex flex-wrap flex-column">

                    <div class="title-block">
                        <span class="title-text"></span>
                    </div>

                    <div class="d-flex flex-wrap flex-column flex-xl-row justify-content-xl-between">

                        <div class="image-block-1 d-none d-xl-block image-block">

                        </div>

                        <div class="text-content d-flex justify-content-start">
                            <div class="amp_partial text-block single-column">
                                <h3 style="font-size: 1.25rem;">Aynı formatta birden fazla ürün olması durumunda ne
                                    olur?</h3>
                                <?= s('multiple_products_text') ?>
                            </div>

                        </div>

                        <div class="image-block-2 d-flex justify-content-end align-items-xl-end">

                        </div>

                    </div>

                </div>
            </div>























































            <div class="ampliance_layout layout4">
                <div class="d-flex flex-wrap flex-column">

                    <h2 class="title-block">
                        <span class="title-text"><?= s('conflicting_products_title') ?></span>
                    </h2>

                    <div class="d-flex flex-wrap flex-column flex-xl-row justify-content-xl-between">

                        <div class="image-block-1 d-none d-xl-block image-block">

                            <div class="amp_partial content-image">
                                <img class="lazy" alt="The Ordinary Product Swatch"
                                    data-src="<?= s('conflicting_products_image') ?>"
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAANQTFRF+Pj4c64OKQAAAApJREFUeJxjYAAAAAIAAUivpHEAAAAASUVORK5CYII=">
                            </div>
                        </div>

                        <div class="text-content d-flex justify-content-start">
                            <div class="amp_partial text-block single-column">
                                <?= s('conflicting_products_text') ?>
                            </div>

                        </div>

                        <div class="image-block-2 d-flex justify-content-end align-items-xl-end">

                            <div class="amp_partial content-image">
                                <img class="lazy" alt="The Ordinary product swatch"
                                    data-src="<?= s('middle_right_image_2') ?>"
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAANQTFRF+Pj4c64OKQAAAApJREFUeJxjYAAAAAIAAUivpHEAAAAASUVORK5CYII=">
                            </div>
                        </div>

                    </div>

                </div>
            </div>























































            <div class="ampliance_layout layout4">
                <div class="d-flex flex-wrap flex-column">

                    <h2 class="title-block">
                        <span class="title-text"><?= s('step3_title') ?></span>
                    </h2>

                    <div class="d-flex flex-wrap flex-column flex-xl-row justify-content-xl-between">

                        <div class="image-block-1 d-none d-xl-block image-block">

                        </div>

                        <div class="text-content d-flex justify-content-start">
                            <div class="amp_partial text-block single-column">
                                <?= s('step3_text') ?>
                            </div>

                        </div>

                        <div class="image-block-2 d-flex justify-content-end align-items-xl-end">

                        </div>

                    </div>

                </div>
            </div>























































            <div class="ampliance_layout layout4">
                <div class="d-flex flex-wrap flex-column">

                    <h2 class="title-block">
                        <span class="title-text"><?= s('faq_title') ?></span>
                    </h2>

                    <div class="d-flex flex-wrap flex-column flex-xl-row justify-content-xl-between">

                        <div class="image-block-1 d-none d-xl-block image-block">

                            <div class="amp_partial content-image">
                                <img class="lazy" alt="" data-src="<?= s('faq_image') ?>"
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAANQTFRF+Pj4c64OKQAAAApJREFUeJxjYAAAAAIAAUivpHEAAAAASUVORK5CYII=">
                            </div>
                        </div>

                        <div class="text-content d-flex justify-content-start">
                            <div class="amp_partial text-block single-column">
                                Ürünler arasında ne kadar beklemeliyim? Ürünler arasında belirli bir bekleme süresi
                                yoktur, ancak bir sonraki ürünü uygulamadan önce her ürünün cilde tamamen emilmesini
                                beklemenizi öneririz. Sonuçları ne zaman görmeyi bekleyebilirim? Herkesin cildi farklı
                                olduğu için, herkesin yeni cilt bakım ürünlerine verdiği tepki benzersiz olacaktır.
                                Önemli olan sabırlı ve tutarlı olmaktır. Emülsiyon nedir? Rutinimde nerede yer
                                alıyorlar? Emülsiyonlar, homojen hale gelene kadar (ayrışmayana kadar) iki veya daha
                                fazla maddenin karışımıdır. Hem serum emülsiyonlarımız hem de krem ​​emülsiyonlarımız
                                mevcuttur, bu nedenle rutininizde nerede yer alacaklarını belirlerken en ince olandan en
                                kalın olana doğru sıraladığınızdan emin olun. Cilt bakım ürünlerinin topaklanmasını
                                nasıl önleyebilirim? Topaklanma, uygulanan ürün miktarı veya kullanılan ürünler gibi
                                birçok farklı nedenden kaynaklanabilir. Bazı formüller birbirine iyi yapışmayabilir.
                                Topaklanma olasılığını azaltmak için, düşündüğünüzden daha az ürün (2-3 damla)
                                uygulamanızı ve bir sonraki ürünü uygulamadan önce tamamen emilmesini beklemenizi
                                öneririz. Artık kendi etkili cilt bakım rutininizi oluşturmak için gereken araçlara
                                sahip olduğunuza göre, daha sağlıklı görünen ve ışıltılı bir cilde kavuşmak için adımlar
                                atabilirsiniz. Sadece alıp gitmek istiyorsanız, Set ve Koleksiyonlarımızı inceleyebilir
                                veya Rejim Oluşturucumuzla kendi setinizi oluşturabilirsiniz.
                            </div>

                        </div>

                        <div class="image-block-2 d-flex justify-content-end align-items-xl-end">

                        </div>

                    </div>

                </div>
            </div>





















































            <!-- END_dwmarker -->

        </div>


        <!-- End Dyn Content -->
    </div>

    <?php include BASE_PATH . '/footer.php'; ?>
</body>

</html>