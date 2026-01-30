<?php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';
include 'includes/header.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

// Only allow editing existing banners
if (!$id) {
    header("Location: banners.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM banners WHERE id = ?");
$stmt->execute([$id]);
$banner = $stmt->fetch();

if (!$banner) {
    header("Location: banners.php");
    exit;
}

$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $button_text = $_POST['button_text'];
    $button_url = $_POST['button_url'];
    $shop_link_text = $_POST['shop_link_text'];
    $shop_link_url = $_POST['shop_link_url'];

    // File Upload Handling
    $image_desktop = $banner['image_desktop'] ?? '';
    $image_mobile = $banner['image_mobile'] ?? '';

    $upload_dir = '../assets/images/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Custom function to handle strict re-casing of file extensions
    // Not critical here, but good practice

    // Desktop Image
    if (isset($_FILES['image_desktop']) && $_FILES['image_desktop']['error'] === UPLOAD_ERR_OK) {
        $file_ext = strtolower(pathinfo($_FILES['image_desktop']['name'], PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($file_ext, $allowed_ext)) {
            $new_filename = 'banner_' . ($banner['page_identifier']) . '_desktop_' . time() . '.' . $file_ext;
            if (move_uploaded_file($_FILES['image_desktop']['tmp_name'], $upload_dir . $new_filename)) {
                $image_desktop = 'assets/images/' . $new_filename;
            }
        }
    }

    // Mobile Image
    if (isset($_FILES['image_mobile']) && $_FILES['image_mobile']['error'] === UPLOAD_ERR_OK) {
        $file_ext = strtolower(pathinfo($_FILES['image_mobile']['name'], PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($file_ext, $allowed_ext)) {
            $new_filename = 'banner_' . ($banner['page_identifier']) . '_mobile_' . time() . '.' . $file_ext;
            if (move_uploaded_file($_FILES['image_mobile']['tmp_name'], $upload_dir . $new_filename)) {
                $image_mobile = 'assets/images/' . $new_filename;
            }
        }
    }

    try {
        $stmt = $pdo->prepare("UPDATE banners SET 
            title = ?, 
            description = ?, 
            button_text = ?, 
            button_url = ?, 
            shop_link_text = ?, 
            shop_link_url = ?, 
            image_desktop = ?, 
            image_mobile = ? 
            WHERE id = ?");
        $stmt->execute([
            $title,
            $description,
            $button_text,
            $button_url,
            $shop_link_text,
            $shop_link_url,
            $image_desktop,
            $image_mobile,
            $id
        ]);
        $success = "Banner başarıyla güncellendi.";

        // Refresh data
        $stmt = $pdo->prepare("SELECT * FROM banners WHERE id = ?");
        $stmt->execute([$id]);
        $banner = $stmt->fetch();

    } catch (PDOException $e) {
        $error = "Veritabanı hatası: " . $e->getMessage();
    }
}
?>

<div class="d-flex" id="wrapper">
    <?php include 'includes/sidebar.php'; ?>

    <div id="page-content-wrapper" class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
            <div class="container-fluid">
                <button class="btn btn-link text-dark" id="sidebarToggle"><i class="fas fa-bars"></i></button>
                <div class="ms-2 d-flex flex-column">
                    <span class="fw-bold text-uppercase small text-muted" style="letter-spacing: 0.1em;">Banner
                        Yönetimi</span>
                    <span class="fs-6 fw-bold">Banner Düzenle</span>
                </div>
            </div>
        </nav>

        <div class="container-fluid px-4 py-4">

            <?php if ($success): ?>
                <div class="alert alert-success shadow-sm border-0 rounded-3 mb-4">
                    <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
                </div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-danger shadow-sm border-0 rounded-3 mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
                </div>
            <?php endif; ?>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-4">
                            <form action="" method="POST" enctype="multipart/form-data">

                                <div class="mb-4 pb-3 border-bottom">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Sayfa /
                                        Konum</label>
                                    <input type="text" class="form-control form-control-lg bg-light"
                                        value="<?php echo htmlspecialchars($banner['page_identifier']); ?>" readonly>
                                    <div class="form-text">Bu alan sistem tarafından otomatik belirlenmiştir ve
                                        değiştirilemez.</div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <div class="card h-100 border bg-light">
                                            <div class="card-body p-3">
                                                <label class="form-label fw-bold mb-3">Masaüstü Görseli</label>
                                                <?php if (!empty($banner['image_desktop'])): ?>
                                                    <div class="mb-3 rounded overflow-hidden shadow-sm"
                                                        style="max-height: 150px;">
                                                        <img src="../<?php echo htmlspecialchars($banner['image_desktop']); ?>"
                                                            class="w-100 object-fit-cover" style="height: 150px;">
                                                    </div>
                                                <?php endif; ?>
                                                <input type="file" name="image_desktop" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card h-100 border bg-light">
                                            <div class="card-body p-3">
                                                <label class="form-label fw-bold mb-3">Mobil Görseli</label>
                                                <?php if (!empty($banner['image_mobile'])): ?>
                                                    <div class="mb-3 rounded overflow-hidden shadow-sm"
                                                        style="max-height: 150px;">
                                                        <img src="../<?php echo htmlspecialchars($banner['image_mobile']); ?>"
                                                            class="w-100 object-fit-cover" style="height: 150px;">
                                                    </div>
                                                <?php endif; ?>
                                                <input type="file" name="image_mobile" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Başlık</label>
                                    <input type="text" name="title" class="form-control form-control-lg"
                                        value="<?php echo htmlspecialchars($banner['title'] ?? ''); ?>">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Açıklama</label>
                                    <textarea name="description" class="form-control"
                                        rows="4"><?php echo htmlspecialchars($banner['description'] ?? ''); ?></textarea>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Ana Buton Metni</label>
                                        <input type="text" name="button_text" class="form-control"
                                            value="<?php echo htmlspecialchars($banner['button_text'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Ana Buton URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-link"></i></span>
                                            <input type="text" name="button_url" class="form-control"
                                                value="<?php echo htmlspecialchars($banner['button_url'] ?? ''); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Alışveriş Link Metni</label>
                                        <input type="text" name="shop_link_text" class="form-control"
                                            value="<?php echo htmlspecialchars($banner['shop_link_text'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Alışveriş Link URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i
                                                    class="fas fa-shopping-bag"></i></span>
                                            <input type="text" name="shop_link_url" class="form-control"
                                                value="<?php echo htmlspecialchars($banner['shop_link_url'] ?? ''); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between pt-3 border-top">
                                    <a href="banners.php" class="btn btn-outline-secondary px-4">
                                        <i class="fas fa-arrow-left me-2"></i>Geri Dön
                                    </a>
                                    <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                                        <i class="fas fa-save me-2"></i>Değişiklikleri Kaydet
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>