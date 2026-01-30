<?php
include dirname(__DIR__) . '/config.php';
require_once 'includes/auth_check.php';
require_once 'includes/db.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Delete Logic
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM contact_categories WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: contact-categories.php?msg=deleted");
    exit;
}

// Fetch Categories
$stmt = $pdo->query("SELECT * FROM contact_categories ORDER BY sort_order ASC, id ASC");
$categories = $stmt->fetchAll();
?>

<div id="page-content-wrapper">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0 fw-bold clr-dark">İletişim Sayfası Kategorileri</h3>
            <div>
                <a href="contact-settings.php" class="btn btn-secondary me-2">
                    <i class="fas fa-cog me-2"></i> Sayfa Ayarları
                </a>
                <a href="contact-category-edit.php" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Yeni Giriş
                </a>
            </div>
        </div>

        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
            <div class="alert alert-success">Kategori başarıyla silindi.</div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">Sıra</th>
                                <th>Kategori Başlığı</th>
                                <th style="width: 100px;">Durum</th>
                                <th style="width: 250px;">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($categories) > 0): ?>
                                <?php foreach ($categories as $cat): ?>
                                    <tr>
                                        <td><?php echo $cat['sort_order']; ?></td>
                                        <td class="fw-bold"><?php echo htmlspecialchars($cat['title']); ?></td>
                                        <td>
                                            <?php if ($cat['status']): ?>
                                                <span class="badge bg-success-soft text-success">Aktif</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary-soft text-secondary">Pasif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="contact-links.php?category_id=<?php echo $cat['id']; ?>"
                                                class="btn btn-info btn-sm text-white me-1">
                                                <i class="fas fa-link"></i> Linkler
                                            </a>
                                            <a href="contact-category-edit.php?id=<?php echo $cat['id']; ?>"
                                                class="btn btn-warning btn-sm text-white me-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="contact-categories.php?delete=<?php echo $cat['id']; ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bu kategoriyi silmek istediğinize emin misiniz? Altındaki tüm linkler de silinecektir.');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">Henüz kategori eklenmemiş.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>