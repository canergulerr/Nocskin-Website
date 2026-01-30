<?php
include 'includes/db.php';
$pageTitle = 'Kategori Yönetimi';
include 'includes/header.php';
include 'includes/sidebar.php';

// Fetch Categories
$stmt = $pdo->query("SELECT * FROM categories ORDER BY sort_order ASC, name ASC");
$categories = $stmt->fetchAll();
?>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-fluid">
            <h4 class="mb-0 fw-bold clr-dark">Kategori Yönetimi</h4>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 fw-bold text-dark">Kategori Listesi</h5>
                <a href="category-edit.php" class="btn btn-primary d-inline-flex align-items-center">
                    <i class="fas fa-plus me-2"></i> Yeni Kategori Ekle
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;">Resim</th>
                                <th>Kategori Adı</th>
                                <th>Slug</th>
                                <th>Sıra</th>
                                <th>Durum</th>
                                <th class="text-end">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $cat): ?>
                                <tr>
                                    <td>
                                        <?php if ($cat['image']): ?>
                                            <img src="<?= htmlspecialchars($cat['image']) ?>" class="rounded"
                                                style="width: 40px; height: 40px; object-fit: cover;">
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Yok</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-medium"><?= htmlspecialchars($cat['name']) ?></td>
                                    <td class="text-muted small"><?= htmlspecialchars($cat['slug']) ?></td>
                                    <td><span class="badge bg-light text-dark border"><?= $cat['sort_order'] ?></span></td>
                                    <td>
                                        <?php if ($cat['status']): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger bg-opacity-10 text-danger">Pasif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <a href="category-edit.php?id=<?= $cat['id'] ?>"
                                            class="btn btn-sm btn-outline-primary me-1" title="Düzenle">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="category-delete.php?id=<?= $cat['id'] ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Silmek istediğinize emin misiniz?')" title="Sil">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($categories)): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Henüz kategori eklenmemiş.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>