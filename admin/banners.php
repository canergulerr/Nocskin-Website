<?php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';
include 'includes/header.php';

// Fetch banners
try {
    $stmt = $pdo->query("SELECT * FROM banners ORDER BY id DESC");
    $banners = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Hata: " . $e->getMessage();
}
?>

<div class="d-flex" id="wrapper">
    <?php include 'includes/sidebar.php'; ?>

    <div id="page-content-wrapper" class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
            <div class="container-fluid">
                <button class="btn btn-link text-dark" id="sidebarToggle"><i class="fas fa-bars"></i></button>
                <span class="navbar-brand ms-2 fw-bold text-uppercase"
                    style="letter-spacing: 0.1em; font-size: 0.9rem;">Banner Yönetimi</span>
            </div>
        </nav>

        <div class="container-fluid px-4 py-4">

            <?php if (isset($error)): ?>
                <div class="alert alert-danger shadow-sm border-0 rounded-3 mb-4"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="card-title mb-0 fw-bold text-secondary">Mevcut Bannerlar</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-uppercase text-muted small">
                                <tr>
                                    <th class="ps-4 py-3" style="width: 50px;">#</th>
                                    <th class="py-3">Görsel</th>
                                    <th class="py-3">Sayfa / Konum</th>
                                    <th class="py-3">Başlık</th>
                                    <th class="py-3 text-end pe-4">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($banners)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="fas fa-bullhorn fa-3x mb-3 text-secondary opacity-50"></i><br>
                                            Henüz hiç banner bulunmuyor.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($banners as $banner): ?>
                                        <tr>
                                            <td class="ps-4 fw-bold text-muted small">#<?php echo $banner['id']; ?></td>
                                            <td>
                                                <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm"
                                                    style="width: 100px; height: 56px;">
                                                    <img src="../<?php echo htmlspecialchars($banner['image_desktop']); ?>"
                                                        class="object-fit-cover" alt="Banner">
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border">
                                                    <?php echo htmlspecialchars($banner['page_identifier']); ?>
                                                </span>
                                            </td>
                                            <td class="fw-medium text-dark"><?php echo htmlspecialchars($banner['title']); ?>
                                            </td>
                                            <td class="text-end pe-4">
                                                <a href="banner-edit.php?id=<?php echo $banner['id']; ?>"
                                                    class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                                    data-bs-toggle="tooltip" title="Düzenle">
                                                    <i class="fas fa-edit me-1"></i> Düzenle
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>