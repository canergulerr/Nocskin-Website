<?php include dirname(__DIR__) . '/config.php'; ?>
<?php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Pagination and sorting could be added here
$sql = "SELECT * FROM page_sections ORDER BY page_identifier ASC, sort_order ASC";
$stmt = $pdo->query($sql);
$sections = $stmt->fetchAll();
?>

<div id="page-content-wrapper">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Sayfa İçerik Blokları</h1>
            <a href="page-section-edit.php" class="btn btn-success"><i class="fas fa-plus me-1"></i> Yeni Blok Ekle</a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Sayfa</th>
                                <th>Görsel</th>
                                <th>Başlık</th>
                                <th>Sıra</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($sections) > 0): ?>
                                <?php foreach ($sections as $section): ?>
                                    <tr>
                                        <td><span
                                                class="badge bg-info text-dark"><?= htmlspecialchars($section['page_identifier']) ?></span>
                                        </td>
                                        <td>
                                            <?php if ($section['image_url']): ?>
                                                <img src="<?= BASE_URL . '/' . htmlspecialchars($section['image_url']) ?>" alt="Img"
                                                    style="height: 50px; object-fit: cover;">
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="fw-bold"><?= htmlspecialchars($section['title']) ?></div>
                                            <small class="text-muted"><?= htmlspecialchars($section['subtitle']) ?></small>
                                        </td>
                                        <td><?= $section['sort_order'] ?></td>
                                        <td>
                                            <?php if ($section['status']): ?>
                                                <span class="badge bg-success">Aktif</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Pasif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="page-section-edit.php?id=<?php echo $section['id']; ?>"
                                                class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i> Düzenle</a>
                                            <a href="page-section-delete.php?id=<?php echo $section['id']; ?>"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bu bloğu silmek istediğinize emin misiniz?');"><i
                                                    class="fas fa-trash"></i> Sil</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Henüz içerik bloğu eklenmemiş.</td>
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