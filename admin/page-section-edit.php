<?php include dirname(__DIR__) . '/config.php'; ?>
<?php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$section = null;
$error = '';
$success = '';

if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM page_sections WHERE id = ?");
    $stmt->execute([$id]);
    $section = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $page_identifier = trim($_POST['page_identifier']);
    $title = trim($_POST['title']);
    $subtitle = trim($_POST['subtitle']);
    $button_text = trim($_POST['button_text']);
    $button_url = trim($_POST['button_url']);
    $sort_order = intval($_POST['sort_order']);
    $status = isset($_POST['status']) ? 1 : 0;

    // Image Upload Handling
    $image_url = $section ? $section['image_url'] : '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = '../uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileInfo = pathinfo($_FILES['image']['name']);
        $extension = strtolower($fileInfo['extension']);
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'mp4'])) {
            $newFileName = 'section_' . time() . '_' . rand(1000, 9999) . '.' . $extension;
            $uploadFile = $uploadDir . $newFileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $image_url = 'uploads/' . $newFileName;
            } else {
                $error = "Dosya yüklenirken bir hata oluştu.";
            }
        } else {
            $error = "Geçersiz dosya formatı. Sadece JPG, PNG, GIF, WEBP ve MP4 dosyaları yüklenebilir.";
        }
    }

    if (empty($error)) {
        if ($id > 0) {
            $sql = "UPDATE page_sections SET page_identifier=?, title=?, subtitle=?, image_url=?, button_text=?, button_url=?, sort_order=?, status=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$page_identifier, $title, $subtitle, $image_url, $button_text, $button_url, $sort_order, $status, $id])) {
                $success = "Blok başarıyla güncellendi.";
                // Refresh data
                $stmt = $pdo->prepare("SELECT * FROM page_sections WHERE id = ?");
                $stmt->execute([$id]);
                $section = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $error = "Veritabanı hatası.";
            }
        } else {
            $sql = "INSERT INTO page_sections (page_identifier, title, subtitle, image_url, button_text, button_url, sort_order, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$page_identifier, $title, $subtitle, $image_url, $button_text, $button_url, $sort_order, $status])) {
                $success = "Yeni blok başarıyla eklendi.";
                $id = $pdo->lastInsertId();
                // Refresh data or redirect
                header("Location: page-sections.php");
                exit;
            } else {
                $error = "Veritabanı hatası.";
            }
        }
    }
}
?>

<div id="page-content-wrapper">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0"><?php echo $id > 0 ? 'Bloğu Düzenle' : 'Yeni Blok Ekle'; ?></h4>
                    </div>
                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <?php if ($success): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>

                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Sayfa Tanımlayıcı (ID)</label>
                                <input type="text" name="page_identifier" class="form-control"
                                    value="<?php echo $section ? htmlspecialchars($section['page_identifier']) : 'yaslanma-karsiti'; ?>"
                                    required>
                                <div class="form-text">Hangi sayfada görüneceğini belirtir. Örn:
                                    <code>yaslanma-karsiti</code>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Görsel</label>
                                <?php if ($section && $section['image_url']): ?>
                                    <div class="mb-2">
                                        <img src="<?= BASE_URL . '/' . htmlspecialchars($section['image_url']) ?>"
                                            alt="Current Image" style="max-height: 150px;" class="img-thumbnail">
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Başlık</label>
                                <input type="text" name="title" class="form-control"
                                    value="<?php echo $section ? htmlspecialchars($section['title']) : ''; ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alt Başlık</label>
                                <textarea name="subtitle" class="form-control"
                                    rows="2"><?php echo $section ? htmlspecialchars($section['subtitle']) : ''; ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Buton Yazısı</label>
                                    <input type="text" name="button_text" class="form-control"
                                        value="<?php echo $section ? htmlspecialchars($section['button_text']) : ''; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Buton URL</label>
                                    <input type="text" name="button_url" class="form-control"
                                        value="<?php echo $section ? htmlspecialchars($section['button_url']) : ''; ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Sıra</label>
                                    <input type="number" name="sort_order" class="form-control"
                                        value="<?php echo $section ? $section['sort_order'] : 0; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Durum</label>
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" name="status" id="statusSwitch"
                                            <?php echo (!$section || $section['status']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="statusSwitch">Aktif</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>
                                    Kaydet</button>
                                <a href="page-sections.php" class="btn btn-secondary">İptal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>