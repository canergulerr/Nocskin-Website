<?php
include dirname(__DIR__) . '/config.php';
require_once 'includes/auth_check.php';
require_once 'includes/db.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

$id = $_GET['id'] ?? null;
$category_id = $_GET['category_id'] ?? null;
$link = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM contact_links WHERE id = ?");
    $stmt->execute([$id]);
    $link = $stmt->fetch();
    if ($link) {
        $category_id = $link['category_id'];
    }
}

if (!$category_id) {
    die("Kategori ID gerekli.");
}

// Fetch Category Name for display
$stmtCat = $pdo->prepare("SELECT title FROM contact_categories WHERE id = ?");
$stmtCat->execute([$category_id]);
$categoryTitle = $stmtCat->fetchColumn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $url = $_POST['url'];
    $sort_order = $_POST['sort_order'];
    $status = isset($_POST['status']) ? 1 : 0;

    if ($id) {
        $stmt = $pdo->prepare("UPDATE contact_links SET title = ?, url = ?, sort_order = ?, status = ? WHERE id = ?");
        $stmt->execute([$title, $url, $sort_order, $status, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO contact_links (category_id, title, url, sort_order, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$category_id, $title, $url, $sort_order, $status]);
    }

    header("Location: contact-links.php?category_id=" . $category_id);
    exit;
}
?>

<div id="page-content-wrapper">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0 fw-bold clr-dark"><?php echo $id ? 'Link Düzenle' : 'Yeni Link Ekle'; ?>
                (<?php echo htmlspecialchars($categoryTitle); ?>)</h3>
            <a href="contact-links.php?category_id=<?php echo $category_id; ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Geri Dön
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Link Başlığı</label>
                        <input type="text" name="title" class="form-control" required
                            value="<?php echo $link['title'] ?? ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">URL</label>
                        <input type="text" name="url" class="form-control" placeholder="https://..." required
                            value="<?php echo $link['url'] ?? ''; ?>">
                        <div class="form-text">Tam URL (https://...) veya site içi yol (/iletisim) girebilirsiniz.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Sıralama</label>
                        <input type="number" name="sort_order" class="form-control"
                            value="<?php echo $link['sort_order'] ?? 0; ?>">
                    </div>

                    <div class="mb-3 form-check form-switch">
                        <input type="checkbox" name="status" class="form-check-input" id="statusCheck" <?php echo ($link['status'] ?? 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="statusCheck">Aktif</label>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i> Kaydet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>