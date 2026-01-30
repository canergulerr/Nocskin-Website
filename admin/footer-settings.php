<?php
include 'includes/auth_check.php';
include 'includes/db.php';
include 'includes/header.php';
include 'includes/sidebar.php';

// Fetch current settings
$stmt = $pdo->query("SELECT * FROM footer_settings LIMIT 1");
$settings = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newsletter_title = $_POST['newsletter_title'];
    $newsletter_description = $_POST['newsletter_description'];
    $newsletter_disclaimer = $_POST['newsletter_disclaimer'];
    $social_facebook = $_POST['social_facebook'];
    $social_instagram = $_POST['social_instagram'];
    $social_youtube = $_POST['social_youtube'];
    $social_tiktok = $_POST['social_tiktok'];
    $copyright_text = $_POST['copyright_text'];

    if ($settings) {
        $stmt = $pdo->prepare("UPDATE footer_settings SET 
            newsletter_title = ?, 
            newsletter_description = ?, 
            newsletter_disclaimer = ?, 
            social_facebook = ?, 
            social_instagram = ?, 
            social_youtube = ?, 
            social_tiktok = ?, 
            copyright_text = ? 
            WHERE id = ?");
        $stmt->execute([
            $newsletter_title,
            $newsletter_description,
            $newsletter_disclaimer,
            $social_facebook,
            $social_instagram,
            $social_youtube,
            $social_tiktok,
            $copyright_text,
            $settings['id']
        ]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO footer_settings (newsletter_title, newsletter_description, newsletter_disclaimer, social_facebook, social_instagram, social_youtube, social_tiktok, copyright_text) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $newsletter_title,
            $newsletter_description,
            $newsletter_disclaimer,
            $social_facebook,
            $social_instagram,
            $social_youtube,
            $social_tiktok,
            $copyright_text
        ]);
    }

    // Refresh
    echo "<script>window.location.href = 'footer-settings.php?success=1';</script>";
    exit;
}
?>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-fluid">
            <h4 class="mb-0 fw-bold text-dark">Footer Ayarları</h4>
        </div>
    </nav>

    <div class="container-fluid mt-4 px-4">
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Ayarlar başarıyla güncellendi.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form method="POST">
                    <h5 class="mb-3 text-primary">Bülten (Newsletter) Alanı</h5>
                    <div class="mb-3">
                        <label class="form-label">Başlık</label>
                        <input type="text" name="newsletter_title" class="form-control"
                            value="<?= htmlspecialchars($settings['newsletter_title'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Açıklama</label>
                        <textarea name="newsletter_description" class="form-control"
                            rows="2"><?= htmlspecialchars($settings['newsletter_description'] ?? '') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Yasal Uyarı (Disclaimer)</label>
                        <textarea name="newsletter_disclaimer" class="form-control"
                            rows="3"><?= htmlspecialchars($settings['newsletter_disclaimer'] ?? '') ?></textarea>
                    </div>

                    <hr>
                    <h5 class="mb-3 text-primary">Sosyal Medya Linkleri</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fab fa-facebook text-primary"></i> Facebook</label>
                            <input type="text" name="social_facebook" class="form-control"
                                value="<?= htmlspecialchars($settings['social_facebook'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fab fa-instagram text-danger"></i> Instagram</label>
                            <input type="text" name="social_instagram" class="form-control"
                                value="<?= htmlspecialchars($settings['social_instagram'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fab fa-youtube text-danger"></i> YouTube</label>
                            <input type="text" name="social_youtube" class="form-control"
                                value="<?= htmlspecialchars($settings['social_youtube'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fab fa-tiktok text-dark"></i> TikTok</label>
                            <input type="text" name="social_tiktok" class="form-control"
                                value="<?= htmlspecialchars($settings['social_tiktok'] ?? '') ?>">
                        </div>
                    </div>

                    <hr>
                    <h5 class="mb-3 text-primary">Alt Kısım (Footer Bottom)</h5>
                    <div class="mb-3">
                        <label class="form-label">Telif Hakkı Metni (Copyright)</label>
                        <input type="text" name="copyright_text" class="form-control"
                            value="<?= htmlspecialchars($settings['copyright_text'] ?? '') ?>">
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>