<?php
require_once 'includes/db.php';

$id = $_GET['id'] ?? null;
$asset = null;
$error = '';
$success = '';

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM homepage_assets WHERE id = ?");
    $stmt->execute([$id]);
    $asset = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$asset) {
        die("Asset not found!");
    }
} else {
    die("ID required!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    // Asset key shouldn't be changed ideally, but title can be for admin reference.

    // File Upload Handling
    $filePath = $asset['file_path']; // Default to existing

    if (isset($_FILES['media_file']) && $_FILES['media_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileExt = strtolower(pathinfo($_FILES['media_file']['name'], PATHINFO_EXTENSION));
        $allowed = ($asset['type'] == 'image') ? ['jpg', 'jpeg', 'png', 'webp'] : ['mp4', 'webm'];

        if (in_array($fileExt, $allowed)) {
            $newFileName = $asset['asset_key'] . '_' . time() . '.' . $fileExt;
            $uploadFile = $uploadDir . $newFileName;

            if (move_uploaded_file($_FILES['media_file']['tmp_name'], $uploadFile)) {
                // Determine relative path for DB
                $filePath = 'assets/uploads/' . $newFileName;
            } else {
                $error = "Dosya yüklenirken bir hata oluştu.";
            }
        } else {
            $error = "Geçersiz dosya formatı. Beklenen: " . implode(', ', $allowed);
        }
    }

    if (empty($error)) {
        // Update query with new fields
        $sql = "UPDATE homepage_assets SET title = ?, display_title = ?, description = ?, button_text = ?, link_url = ?, file_path = ? WHERE id = ?";
        $updateStmt = $pdo->prepare($sql);
        $display_title = $_POST['display_title'] ?? '';
        $description = $_POST['description'] ?? null;
        $button_text = $_POST['button_text'] ?? '';
        $link_url = $_POST['link_url'] ?? '';

        $updateStmt->execute([$title, $display_title, $description, $button_text, $link_url, $filePath, $id]);

        header("Location: assets.php");
        exit;
    }
}

include 'includes/header.php';
?>

<div class="d-flex" id="wrapper">
    <?php include 'includes/sidebar.php'; ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary" id="menu-toggle"><i class="fas fa-bars"></i></button>
            </div>
        </nav>

        <div class="container-fluid px-4 mt-4">
            <h3 class="mb-4 text-white">İçerik Düzenle: <?php echo htmlspecialchars($asset['asset_key']); ?></h3>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Yönetim Başlığı (Sadece Admin Görür)</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="title"
                                    name="title" value="<?php echo htmlspecialchars($asset['title']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="display_title" class="form-label">Görünen Başlık (Sitede Görünür)</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary"
                                    id="display_title" name="display_title"
                                    value="<?php echo htmlspecialchars($asset['display_title']); ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="link_url" class="form-label">Link URL</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary" id="link_url"
                                name="link_url" value="<?php echo htmlspecialchars($asset['link_url']); ?>">
                        </div>

                        <!-- Video ve Ingredients için ek alanlar -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Açıklama Metni (Varsa)</label>
                            <textarea class="form-control bg-dark text-white border-secondary" id="description"
                                name="description"
                                rows="3"><?php echo htmlspecialchars($asset['description']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="button_text" class="form-label">Buton Metni (Varsa)</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary" id="button_text"
                                name="button_text" value="<?php echo htmlspecialchars($asset['button_text']); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mevcut Medya</label>
                            <div class="mb-2">
                                <?php if ($asset['type'] == 'image'): ?>
                                    <img src="<?php echo "../" . $asset['file_path']; ?>" alt="Current"
                                        style="max-height: 200px; max-width: 100%;">
                                <?php else: ?>
                                    <video src="<?php echo "../" . $asset['file_path']; ?>" controls
                                        style="max-height: 200px; max-width: 100%;"></video>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="existing_path"
                                value="<?php echo htmlspecialchars($asset['file_path']); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="media_file" class="form-label">Yeni Dosya Yükle (İsteğe Bağlı)</label>
                            <input type="file" class="form-control bg-dark text-white border-secondary" id="media_file"
                                name="media_file">
                            <div class="form-text text-light">Mevcut dosyayı değiştirmek istemiyorsanız boş bırakın.
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Güncelle</button>
                        <a href="assets.php" class="btn btn-outline-light">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>