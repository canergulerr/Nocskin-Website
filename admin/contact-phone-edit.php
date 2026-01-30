<?php
include dirname(__DIR__) . '/config.php';
require_once 'includes/auth_check.php';
require_once 'includes/db.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

$id = $_GET['id'] ?? null;
$phone = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM contact_phones WHERE id = ?");
    $stmt->execute([$id]);
    $phone = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $phone_number = $_POST['phone_number'];
    $country_name = $_POST['country_name'];
    $sort_order = $_POST['sort_order'];
    $status = isset($_POST['status']) ? 1 : 0;

    if ($id) {
        $stmt = $pdo->prepare("UPDATE contact_phones SET title = ?, phone_number = ?, country_name = ?, sort_order = ?, status = ? WHERE id = ?");
        $stmt->execute([$title, $phone_number, $country_name, $sort_order, $status, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO contact_phones (title, phone_number, country_name, sort_order, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $phone_number, $country_name, $sort_order, $status]);
    }

    header("Location: contact-phones.php");
    exit;
}
?>

<div id="page-content-wrapper">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0 fw-bold clr-dark"><?php echo $id ? 'Numara Düzenle' : 'Yeni Numara Ekle'; ?></h3>
            <a href="contact-phones.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Geri Dön
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Başlık (Örn: Toll Free)</label>
                            <input type="text" name="title" class="form-control"
                                value="<?php echo $phone['title'] ?? 'Toll Free'; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Telefon Numarası</label>
                            <input type="text" name="phone_number" class="form-control" required
                                value="<?php echo $phone['phone_number'] ?? ''; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Ülke / Bölge Adı</label>
                            <input type="text" name="country_name" class="form-control" required
                                value="<?php echo $phone['country_name'] ?? ''; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Sıralama</label>
                            <input type="number" name="sort_order" class="form-control"
                                value="<?php echo $phone['sort_order'] ?? 0; ?>">
                        </div>
                    </div>

                    <div class="mb-3 form-check form-switch">
                        <input type="checkbox" name="status" class="form-check-input" id="statusCheck" <?php echo ($phone['status'] ?? 1) ? 'checked' : ''; ?>>
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