<?php
include dirname(__DIR__) . '/config.php';
require_once 'includes/auth_check.php';
require_once 'includes/db.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Helper for file upload
function handleUpload($inputName)
{
    global $pdo; // Not needed here but good context
    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];
        $filename = $_FILES[$inputName]['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $uploadDir = dirname(__DIR__) . '/assets/uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Unique filename
            $newFilename = uniqid('img_') . '.' . $ext;
            $destPath = $uploadDir . $newFilename;

            if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $destPath)) {
                return 'assets/uploads/' . $newFilename;
            }
        }
    }
    return null;
}

// Handle Settings Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_settings'])) {

    // 1. Handle Text Fields
    $textKeys = [
        'cs_title',
        'cs_hours',
        'media_title',
        'media_url',
        'dist_title',
        'dist_url'
    ];

    foreach ($textKeys as $key) {
        if (isset($_POST[$key])) {
            $val = $_POST[$key];
            $stmt = $pdo->prepare("INSERT INTO contact_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
            $stmt->execute([$key, $val]);
        }
    }

    // 2. Handle File Uploads
    $fileKeys = ['logo_image', 'store_image', 'bg_image_frequency', 'bg_image_tower'];

    foreach ($fileKeys as $key) {
        // Try upload
        $uploadedPath = handleUpload($key);

        if ($uploadedPath) {
            // Update DB with new path
            $stmt = $pdo->prepare("INSERT INTO contact_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
            $stmt->execute([$key, $uploadedPath]);
        }
        // If no upload, do nothing (keep existing)
    }

    $success = "Ayarlar başarıyla kaydedildi.";
}

// Fetch Settings
$settings = [];
$stmt = $pdo->query("SELECT * FROM contact_settings");
while ($row = $stmt->fetch()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>

<div id="page-content-wrapper">
    <div class="container-fluid mt-4 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0 fw-bold clr-dark">İletişim Sayfası Ayarları</h3>
            <div>
                <a href="contact-phones.php" class="btn btn-info text-white me-2">
                    <i class="fas fa-phone me-2"></i> Telefon Numaraları
                </a>
                <a href="contact-categories.php" class="btn btn-secondary">
                    <i class="fas fa-list me-2"></i> Kategoriler
                </a>
            </div>
        </div>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-8">

                    <!-- Texts Section -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h6 class="mb-0 fw-bold">Genel Metinler</h6>
                        </div>
                        <div class="card-body p-4">
                            <h6 class="text-primary mb-3">Müşteri Hizmetleri Bölümü</h6>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Bölüm Başlığı</label>
                                <input type="text" name="cs_title" class="form-control"
                                    value="<?php echo htmlspecialchars($settings['cs_title'] ?? ''); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Çalışma Saatleri Metni</label>
                                <input type="text" name="cs_hours" class="form-control"
                                    value="<?php echo htmlspecialchars($settings['cs_hours'] ?? ''); ?>">
                            </div>

                            <hr class="my-4">

                            <h6 class="text-primary mb-3">Medya & Dağıtım</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Medya Başlığı</label>
                                        <input type="text" name="media_title" class="form-control"
                                            value="<?php echo htmlspecialchars($settings['media_title'] ?? ''); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Medya Linki (URL)</label>
                                        <input type="text" name="media_url" class="form-control"
                                            value="<?php echo htmlspecialchars($settings['media_url'] ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Dağıtım Başlığı</label>
                                        <input type="text" name="dist_title" class="form-control"
                                            value="<?php echo htmlspecialchars($settings['dist_title'] ?? ''); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Dağıtım Linki (URL)</label>
                                        <input type="text" name="dist_url" class="form-control"
                                            value="<?php echo htmlspecialchars($settings['dist_url'] ?? ''); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Images Section -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h6 class="mb-0 fw-bold">Görsel Yönetimi</h6>
                        </div>
                        <div class="card-body p-4">

                            <!-- Logo -->
                            <div class="mb-4">
                                <label class="form-label fw-bold d-block">Logo Görseli (Header üstü)</label>
                                <?php if (!empty($settings['logo_image'])): ?>
                                    <div class="mb-2 p-2 border rounded d-inline-block bg-light">
                                        <img src="<?php echo '../' . htmlspecialchars($settings['logo_image']); ?>"
                                            alt="Logo" style="height: 50px; wdtih: auto;">
                                        <small class="d-block text-muted text-center mt-1">Mevcut</small>
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="logo_image" class="form-control">
                                <div class="form-text">Değiştirmek için dosya seçin. (png, svg, jpg)</div>
                            </div>

                            <hr>

                            <!-- Store Image -->
                            <div class="mb-4">
                                <label class="form-label fw-bold d-block">Mağaza Görseli (Alt Kısım)</label>
                                <?php if (!empty($settings['store_image'])): ?>
                                    <div class="mb-2">
                                        <!-- Check if external URL or local -->
                                        <?php $storeSrc = (strpos($settings['store_image'], 'http') === 0) ? $settings['store_image'] : '../' . $settings['store_image']; ?>
                                        <img src="<?php echo htmlspecialchars($storeSrc); ?>" alt="Store"
                                            class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="store_image" class="form-control">
                            </div>

                            <hr>

                            <!-- Backgrounds -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label fw-bold d-block">Arkaplan 1 (Frequency)</label>
                                        <?php if (!empty($settings['bg_image_frequency'])): ?>
                                            <div class="mb-2">
                                                <?php $bg1Src = (strpos($settings['bg_image_frequency'], 'http') === 0) ? $settings['bg_image_frequency'] : '../' . $settings['bg_image_frequency']; ?>
                                                <img src="<?php echo htmlspecialchars($bg1Src); ?>" alt="Bg1"
                                                    class="img-thumbnail" style="max-height: 100px;">
                                            </div>
                                        <?php endif; ?>
                                        <input type="file" name="bg_image_frequency" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label fw-bold d-block">Arkaplan 2 (Tower)</label>
                                        <?php if (!empty($settings['bg_image_tower'])): ?>
                                            <div class="mb-2">
                                                <?php $bg2Src = (strpos($settings['bg_image_tower'], 'http') === 0) ? $settings['bg_image_tower'] : '../' . $settings['bg_image_tower']; ?>
                                                <img src="<?php echo htmlspecialchars($bg2Src); ?>" alt="Bg2"
                                                    class="img-thumbnail" style="max-height: 100px;">
                                            </div>
                                        <?php endif; ?>
                                        <input type="file" name="bg_image_tower" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info small">
                                <i class="fas fa-info-circle me-1"></i> Yüklenen görseller <code>assets/uploads/</code>
                                klasörüne kaydedilir.
                            </div>

                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                        <button type="submit" name="update_settings" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-save me-2"></i> Ayarları ve Görselleri Kaydet
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>