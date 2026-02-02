<?php
include dirname(__DIR__) . '/config.php';
require_once 'includes/auth_check.php';
require_once 'includes/db.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Fetch Counts
$stats = [
    'products' => $pdo->query("SELECT count(*) FROM products WHERE status = 1")->fetchColumn(),
    'categories' => $pdo->query("SELECT count(*) FROM categories")->fetchColumn(),
    'blog_posts' => $pdo->query("SELECT count(*) FROM blog_posts WHERE status = 1")->fetchColumn(),
    'announcements' => $pdo->query("SELECT count(*) FROM announcements WHERE status = 1")->fetchColumn(),
    'sliders' => $pdo->query("SELECT count(*) FROM slider_items")->fetchColumn()
];
?>

<!-- Page Content -->
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-fluid">
            <h4 class="mb-0 fw-bold clr-dark">Genel Bakış</h4>
        </div>
    </nav>

    <div class="container-fluid mt-4">

        <!-- Welcome Banner -->
        <div class="card bg-dark text-white mb-4 border-0 position-relative overflow-hidden"
            style="background: linear-gradient(135deg, #1f2937 0%, #111827 100%);">
            <!-- Decorative Circle -->
            <div
                style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.05); border-radius: 50%;">
            </div>

            <div class="card-body p-4 position-relative">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold mb-1">Hoşgeldin,
                            <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!
                        </h2>
                        <p class="mb-0 text-white-50">Yönetim paneline başarıyla giriş yaptınız.</p>
                    </div>
                    <div class="d-none d-md-block">
                        <span class="badge bg-white text-dark p-2 px-3 rounded-pill fw-bold">
                            <i class="far fa-calendar-alt me-1"></i> <?php echo date('d.m.Y'); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="row g-4 mb-4">
            <!-- Products -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm hover-up">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="card-icon-wrapper bg-primary-soft me-3">
                                <i class="fas fa-box-open fa-lg"></i>
                            </div>
                            <h6 class="text-uppercase text-muted small fw-bold mb-0">Ürünler</h6>
                        </div>
                        <h2 class="mb-0 fw-bold text-dark display-6"><?php echo $stats['products']; ?></h2>
                        <small class="text-muted">Aktif Ürün Sayısı</small>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm hover-up">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="card-icon-wrapper bg-success-soft me-3">
                                <i class="fas fa-tags fa-lg"></i>
                            </div>
                            <h6 class="text-uppercase text-muted small fw-bold mb-0">Kategoriler</h6>
                        </div>
                        <h2 class="mb-0 fw-bold text-dark display-6"><?php echo $stats['categories']; ?></h2>
                        <small class="text-muted">Toplam Kategori</small>
                    </div>
                </div>
            </div>

            <!-- Blog Posts -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm hover-up">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="card-icon-wrapper bg-info-soft me-3">
                                <i class="fas fa-blog fa-lg"></i>
                            </div>
                            <h6 class="text-uppercase text-muted small fw-bold mb-0">Blog Yazıları</h6>
                        </div>
                        <h2 class="mb-0 fw-bold text-dark display-6"><?php echo $stats['blog_posts']; ?></h2>
                        <small class="text-muted">Yayındaki Yazılar</small>
                    </div>
                </div>
            </div>

            <!-- Announcements -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm hover-up">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="card-icon-wrapper bg-warning-soft me-3"
                                style="color: #d97706; background-color: rgba(245, 158, 11, 0.1);">
                                <i class="fas fa-bullhorn fa-lg"></i>
                            </div>
                            <h6 class="text-uppercase text-muted small fw-bold mb-0">Duyurular</h6>
                        </div>
                        <h2 class="mb-0 fw-bold text-dark display-6"><?php echo $stats['announcements']; ?></h2>
                        <small class="text-muted">Aktif Kayan Yazı</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & System Status -->
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center">
                        <div class="card-icon-wrapper bg-primary-soft me-3" style="width: 32px; height: 32px;">
                            <i class="fas fa-rocket fa-sm"></i>
                        </div>
                        <h6 class="m-0 fw-bold text-dark">Hızlı İşlemler</h6>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted mb-4">Sık kullanılan yönetim modüllerine hızlı erişim.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="product-edit.php"
                                class="btn btn-outline-primary px-4 py-3 d-flex align-items-center">
                                <i class="fas fa-plus-circle me-2"></i> Ürün Ekle
                            </a>
                            <a href="slider.php" class="btn btn-outline-dark px-4 py-3 d-flex align-items-center">
                                <i class="fas fa-images me-2"></i> Slider Yönetimi
                            </a>
                            <a href="announcements.php"
                                class="btn btn-outline-dark px-4 py-3 d-flex align-items-center">
                                <i class="fas fa-bullhorn me-2"></i> Duyurular
                            </a>
                            <a href="header-brands.php"
                                class="btn btn-outline-dark px-4 py-3 d-flex align-items-center">
                                <i class="fas fa-bookmark me-2"></i> Marka Logoları
                            </a>
                            <a href="settings.php"
                                class="btn btn-outline-secondary px-4 py-3 d-flex align-items-center">
                                <i class="fas fa-cog me-2"></i> Genel Ayarlar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="m-0 fw-bold text-dark">Sistem Durumu</h6>
                    </div>
                    <div class="card-body p-4 d-flex flex-column justify-content-center align-items-center text-center">
                        <div class="mb-3 p-3 rounded-circle bg-success-soft"
                            style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-check-circle fa-3x"></i>
                        </div>
                        <h4 class="fw-bold text-success mb-1">Sistem Aktif</h4>
                        <p class="text-muted small mb-0">Veritabanı ve servisler sorunsuz çalışıyor.</p>
                        <hr class="w-100 my-3 opacity-10">
                        <div class="w-100 d-flex justify-content-between text-muted small">
                            <span>Sunucu:</span>
                            <span class="fw-bold text-dark">Apache/PHP</span>
                        </div>
                        <div class="w-100 d-flex justify-content-between text-muted small mt-2">
                            <span>Veritabanı:</span>
                            <span class="fw-bold text-dark">MySQL</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /#page-content-wrapper -->

<?php require_once 'includes/footer.php'; ?>