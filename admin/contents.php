<?php include dirname(__DIR__) . '/config.php'; ?>
<?php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Pagination and sorting could be added here
$sql = "SELECT * FROM contents ORDER BY created_at DESC";
$stmt = $pdo->query($sql);
$contents = $stmt->fetchAll();
?>

<div id="page-content-wrapper">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>İçerik Yönetimi</h1>
            <a href="content-edit.php" class="btn btn-success"><i class="fas fa-plus me-1"></i> Yeni Ekle</a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Başlık</th>
                                <th>Slug (URL)</th>
                                <th>Durum</th>
                                <th>Tarih</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($contents) > 0): ?>
                                <?php foreach ($contents as $content): ?>
                                    <tr>
                                        <td><?php echo $content['id']; ?></td>
                                        <td><?php echo htmlspecialchars($content['title']); ?></td>
                                        <td><?php echo htmlspecialchars($content['slug']); ?></td>
                                        <td>
                                            <?php if ($content['status']): ?>
                                                <span class="badge bg-success">Aktif</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Pasif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo date('d.m.Y H:i', strtotime($content['created_at'])); ?></td>
                                        <td>
                                            <a href="content-edit.php?id=<?php echo $content['id']; ?>"
                                                class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i> Düzenle</a>
                                            <a href="content-delete.php?id=<?php echo $content['id']; ?>"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bu içeriği silmek istediğinize emin misiniz?');"><i
                                                    class="fas fa-trash"></i> Sil</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Henüz içerik eklenmemiş.</td>
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
