<?php
include dirname(__DIR__) . '/config.php';
require_once 'includes/auth_check.php';
require_once 'includes/db.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

$category_id = $_GET['category_id'] ?? null;

if (!$category_id) {
    header("Location: contact-categories.php");
    exit;
}

// Fetch Category Info
$stmtCat = $pdo->prepare("SELECT * FROM contact_categories WHERE id = ?");
$stmtCat->execute([$category_id]);
$category = $stmtCat->fetch();

if (!$category) {
    die("Kategori bulunamadı.");
}

// Delete Logic
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM contact_links WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: contact-links.php?category_id=" . $category_id . "&msg=deleted");
    exit;
}

// Fetch Links
$stmt = $pdo->prepare("SELECT * FROM contact_links WHERE category_id = ? ORDER BY sort_order ASC, id ASC");
$stmt->execute([$category_id]);
$links = $stmt->fetchAll();
?>

<div id="page-content-wrapper">
    <div class="container-fluid mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="contact-categories.php">Kategoriler</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php echo htmlspecialchars($category['title']); ?></li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0 fw-bold clr-dark">Linkler: <?php echo htmlspecialchars($category['title']); ?></h3>
            <a href="contact-link-edit.php?category_id=<?php echo $category_id; ?>" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Yeni Link Ekle
            </a>
        </div>

        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
            <div class="alert alert-success">Link başarıyla silindi.</div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">Sıra</th>
                                <th>Link Başlığı</th>
                                <th>URL</th>
                                <th style="width: 100px;">Durum</th>
                                <th style="width: 150px;">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($links) > 0): ?>
                                <?php foreach ($links as $link): ?>
                                    <tr>
                                        <td><?php echo $link['sort_order']; ?></td>
                                        <td class="fw-bold"><?php echo htmlspecialchars($link['title']); ?></td>
                                        <td><small class="text-muted"><?php echo htmlspecialchars($link['url']); ?></small></td>
                                        <td>
                                            <?php if ($link['status']): ?>
                                                <span class="badge bg-success-soft text-success">Aktif</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary-soft text-secondary">Pasif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="contact-link-edit.php?id=<?php echo $link['id']; ?>&category_id=<?php echo $category_id; ?>"
                                                class="btn btn-warning btn-sm text-white me-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="contact-links.php?delete=<?php echo $link['id']; ?>&category_id=<?php echo $category_id; ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Silmek istediğinize emin misiniz?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Bu kategoride henüz link yok.</td>
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