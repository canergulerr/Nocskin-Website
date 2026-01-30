<?php
require_once 'includes/db.php';

$id = $_GET['id'] ?? null;
$item = null;
$error = null;
$success = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM slider_items WHERE id = ?");
    $stmt->execute([$id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $button_text = $_POST['button_text'];
    $button_url = $_POST['button_url'];
    $order_index = $_POST['order_index'];
    $type = $_POST['type'];
    $media_url = $item['media_url'] ?? '';

    // Handle File Upload
    if (isset($_FILES['media_file']) && $_FILES['media_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/uploads/slider/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = time() . '_' . basename($_FILES['media_file']['name']);
        $uploadFile = $uploadDir . $fileName;
        $dbPath = 'assets/uploads/slider/' . $fileName;

        // Basic validation
        $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'mp4', 'webm'];

        if (in_array($fileType, $allowed)) {
            if (move_uploaded_file($_FILES['media_file']['tmp_name'], $uploadFile)) {
                $media_url = $dbPath;
            } else {
                $error = "Dosya yüklenirken bir hata oluştu.";
            }
        } else {
            $error = "Geçersiz dosya türü. Sadece JPG, PNG, MP4, WEBM desteklenir.";
        }
    }

    if (!$error) {
        if ($id) {
            $stmt = $pdo->prepare("UPDATE slider_items SET title=?, subtitle=?, button_text=?, button_url=?, order_index=?, type=?, media_url=? WHERE id=?");
            if ($stmt->execute([$title, $subtitle, $button_text, $button_url, $order_index, $type, $media_url, $id])) {
                $success = "Slider başarıyla güncellendi.";
                // Refresh item
                $stmt = $pdo->prepare("SELECT * FROM slider_items WHERE id = ?");
                $stmt->execute([$id]);
                $item = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        } else {
            $stmt = $pdo->prepare("INSERT INTO slider_items (title, subtitle, button_text, button_url, order_index, type, media_url, status) VALUES (?, ?, ?, ?, ?, ?, ?, 1)");
            if ($stmt->execute([$title, $subtitle, $button_text, $button_url, $order_index, $type, $media_url])) {
                header("Location: slider.php");
                exit;
            }
        }
    }
}

include 'includes/header.php';
?>

<div class="d-flex" id="wrapper">
    <?php include 'includes/sidebar.php'; ?>
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary" id="menu-toggle"><i class="fas fa-bars"></i></button>
            </div>
        </nav>
        <div class="container-fluid px-4 mt-4">
            <h3 class="text-white mb-3"><?php echo $id ? 'Slider Düzenle' : 'Yeni Slider Ekle'; ?></h3>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Başlık</label>
                                <input type="text" name="title" class="form-control bg-dark text-white border-secondary"
                                    value="<?php echo $item['title'] ?? ''; ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Alt Başlık</label>
                                <textarea name="subtitle" class="form-control bg-dark text-white border-secondary"
                                    rows="2"><?php echo $item['subtitle'] ?? ''; ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Buton Metni</label>
                                <input type="text" name="button_text"
                                    class="form-control bg-dark text-white border-secondary"
                                    value="<?php echo $item['button_text'] ?? ''; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Buton Linki (URL)</label>
                                <input type="text" name="button_url"
                                    class="form-control bg-dark text-white border-secondary"
                                    value="<?php echo $item['button_url'] ?? ''; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Medya Türü</label>
                                <select name="type" class="form-select bg-dark text-white border-secondary">
                                    <option value="image" <?php echo ($item['type'] ?? '') == 'image' ? 'selected' : ''; ?>>Görsel (Image)</option>
                                    <option value="video" <?php echo ($item['type'] ?? '') == 'video' ? 'selected' : ''; ?>>Video</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Sıralama (Order)</label>
                                <input type="number" name="order_index"
                                    class="form-control bg-dark text-white border-secondary"
                                    value="<?php echo $item['order_index'] ?? 0; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Medya Dosyası</label>
                                <input type="file" name="media_file"
                                    class="form-control bg-dark text-white border-secondary">
                                <?php if (!empty($item['media_url'])): ?>
                                    <small class="text-light d-block mt-2">Mevcut: <a
                                            href="../<?php echo $item['media_url']; ?>" target="_blank"
                                            class="text-info"><?php echo basename($item['media_url']); ?></a></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Kaydet</button>
                        <a href="slider.php" class="btn btn-secondary">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>