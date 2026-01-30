<?php
// admin/announcement-edit.php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$announcement = [
    'text' => '',
    'url' => '',
    'order_index' => 10,
    'status' => 1
];

$page_title = "Yeni Duyuru Ekle";
$success = "";
$error = "";

if ($id > 0) {
    $page_title = "Duyuru Düzenle";
    $stmt = $pdo->prepare("SELECT * FROM announcements WHERE id = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    if ($result) {
        $announcement = $result;
    } else {
        header("Location: announcements.php");
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = trim($_POST['text']);
    $url = trim($_POST['url']);
    $order_index = (int)$_POST['order_index'];
    $status = isset($_POST['status']) ? 1 : 0;

    if (empty($text)) {
        $error = "Duyuru metni boş bırakılamaz.";
    } else {
        try {
            if ($id > 0) {
                // Update
                $sql = "UPDATE announcements SET text = ?, url = ?, order_index = ?, status = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$text, $url, $order_index, $status, $id]);
            } else {
                // Insert
                $sql = "INSERT INTO announcements (text, url, order_index, status) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$text, $url, $order_index, $status]);
                $id = $pdo->lastInsertId();
            }
            $success = "Duyuru başarıyla kaydedildi.";
            
            // Refresh data
            $stmt = $pdo->prepare("SELECT * FROM announcements WHERE id = ?");
            $stmt->execute([$id]);
            $announcement = $stmt->fetch();
            
        } catch (PDOException $e) {
            $error = "Veritabanı hatası: " . $e->getMessage();
        }
    }
}

require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>

<div id="page-content-wrapper">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0"><?php echo $page_title; ?></h1>
            <a href="announcements.php" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Geri Dön
            </a>
        </div>

        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="text" class="form-label">Duyuru Metni</label>
                        <input type="text" name="text" id="text" class="form-control" 
                               value="<?php echo htmlspecialchars($announcement['text']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="url" class="form-label">Link (Opsiyonel)</label>
                        <input type="text" name="url" id="url" class="form-control" 
                               placeholder="https://... veya # veya boş bırakın"
                               value="<?php echo htmlspecialchars($announcement['url']); ?>">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="order_index" class="form-label">Sıralama</label>
                            <input type="number" name="order_index" id="order_index" class="form-control" 
                                   value="<?php echo $announcement['order_index']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Durum</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status" 
                                       <?php echo $announcement['status'] ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="status">Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
