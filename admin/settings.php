<?php include dirname(__DIR__) . '/config.php'; ?>
<?php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';

// Fetch current settings
$stmt = $pdo->query("SELECT * FROM settings WHERE id = 1");
$settings = $stmt->fetch();

if (!$settings) {
    // Insert default if not exists
    $pdo->exec("INSERT INTO settings (site_title) VALUES ('My Website')");
    header("Refresh:0");
    exit;
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $site_title = trim($_POST['site_title']);
    $site_description = trim($_POST['site_description']);
    $contact_email = trim($_POST['contact_email']);
    $contact_phone = trim($_POST['contact_phone']);
    $facebook_url = trim($_POST['facebook_url']);
    $instagram_url = trim($_POST['instagram_url']);
    $twitter_url = trim($_POST['twitter_url']);

    if (empty($site_title)) {
        $error = "Site başlığı boş bırakılamaz.";
    } else {
        try {
            // Handle Logo Uploads
            $uploadDir = '../assets/images/brands-logo/'; // Using brands-logo folder for main logos too
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $allowed = ['svg', 'png', 'jpg', 'jpeg', 'gif'];

            // Mobile Logo
            if (isset($_FILES['logo_mobile']) && $_FILES['logo_mobile']['error'] == 0) {
                $ext = strtolower(pathinfo($_FILES['logo_mobile']['name'], PATHINFO_EXTENSION));
                if (in_array($ext, $allowed)) {
                    $newFilename = 'logo_mobile_' . uniqid() . '.' . $ext;
                    if (move_uploaded_file($_FILES['logo_mobile']['tmp_name'], $uploadDir . $newFilename)) {
                        $pdo->prepare("UPDATE settings SET logo_mobile = ? WHERE id = 1")
                            ->execute(['assets/images/brands-logo/' . $newFilename]);
                    }
                }
            }

            // Desktop Logo
            if (isset($_FILES['logo_desktop']) && $_FILES['logo_desktop']['error'] == 0) {
                $ext = strtolower(pathinfo($_FILES['logo_desktop']['name'], PATHINFO_EXTENSION));
                if (in_array($ext, $allowed)) {
                    $newFilename = 'logo_desktop_' . uniqid() . '.' . $ext;
                    if (move_uploaded_file($_FILES['logo_desktop']['tmp_name'], $uploadDir . $newFilename)) {
                        $pdo->prepare("UPDATE settings SET logo_desktop = ? WHERE id = 1")
                            ->execute(['assets/images/brands-logo/' . $newFilename]);
                    }
                }
            }

            $sql = "UPDATE settings SET 
                site_title = :site_title,
                site_description = :site_description,
                contact_email = :contact_email,
                contact_phone = :contact_phone,
                facebook_url = :facebook_url,
                instagram_url = :instagram_url,
                twitter_url = :twitter_url
                WHERE id = 1";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':site_title', $site_title);
            $stmt->bindParam(':site_description', $site_description);
            $stmt->bindParam(':contact_email', $contact_email);
            $stmt->bindParam(':contact_phone', $contact_phone);
            $stmt->bindParam(':facebook_url', $facebook_url);
            $stmt->bindParam(':instagram_url', $instagram_url);
            $stmt->bindParam(':twitter_url', $twitter_url);

            if ($stmt->execute()) {
                $success = "Ayarlar başarıyla güncellendi.";
                // Refresh data
                $stmt = $pdo->query("SELECT * FROM settings WHERE id = 1");
                $settings = $stmt->fetch();
            } else {
                $error = "Veritabanı hatası.";
            }
        } catch (PDOException $e) {
            $error = "Hata: " . $e->getMessage();
        }
    }
}

require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>

<div id="page-content-wrapper">
    <div class="container-fluid mt-4 mb-5">
        <h1 class="mb-4">Genel Ayarlar</h1>

        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header bg-white">
                <i class="fas fa-cogs me-1"></i> Site Bilgileri
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="site_title" class="form-label">Site Başlığı</label>
                            <input type="text" name="site_title" id="site_title" class="form-control"
                                value="<?php echo htmlspecialchars($settings['site_title']); ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="contact_email" class="form-label">İletişim E-posta</label>
                            <input type="email" name="contact_email" id="contact_email" class="form-control"
                                value="<?php echo htmlspecialchars($settings['contact_email']); ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="contact_phone" class="form-label">İletişim Telefon</label>
                            <input type="text" name="contact_phone" id="contact_phone" class="form-control"
                                value="<?php echo htmlspecialchars($settings['contact_phone']); ?>">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="site_description" class="form-label">Site Açıklaması (Meta Description)</label>
                            <textarea name="site_description" id="site_description" class="form-control"
                                rows="2"><?php echo htmlspecialchars($settings['site_description']); ?></textarea>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Logolar</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="logo_mobile" class="form-label">Mobil Logo (Ana Header Logosu)</label>
                            <?php if (!empty($settings['logo_mobile'])): ?>
                                <div class="mb-2">
                                    <img src="<?php echo BASE_URL . '/' . $settings['logo_mobile']; ?>" alt="Mobil Logo"
                                        style="height: 40px; background: #eee; padding: 5px;">
                                </div>
                            <?php endif; ?>
                            <input type="file" name="logo_mobile" id="logo_mobile" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="logo_desktop" class="form-label">Desktop / İç Sayfa Logosu</label>
                            <?php if (!empty($settings['logo_desktop'])): ?>
                                <div class="mb-2">
                                    <img src="<?php echo BASE_URL . '/' . $settings['logo_desktop']; ?>" alt="Desktop Logo"
                                        style="height: 40px; background: #eee; padding: 5px;">
                                </div>
                            <?php endif; ?>
                            <input type="file" name="logo_desktop" id="logo_desktop" class="form-control">
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Sosyal Medya</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-facebook-f"></i></span>
                                <input type="text" name="facebook_url" class="form-control" placeholder="Facebook URL"
                                    value="<?php echo htmlspecialchars($settings['facebook_url']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                <input type="text" name="instagram_url" class="form-control" placeholder="Instagram URL"
                                    value="<?php echo htmlspecialchars($settings['instagram_url']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                <input type="text" name="twitter_url" class="form-control" placeholder="Twitter URL"
                                    value="<?php echo htmlspecialchars($settings['twitter_url']); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">Ayarları Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>