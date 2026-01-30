<?php
require_once 'includes/db.php';

$id = $_GET['id'] ?? null;
$member = null;
$error = '';

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM team_members WHERE id = ?");
    $stmt->execute([$id]);
    $member = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $title = $_POST['title'] ?? '';
    $order_index = $_POST['order_index'] ?? 0;

    // File Upload Logic
    $imageUrl = $member ? $member['image_url'] : ''; // Default to existing

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/uploads/team/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileExt = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($fileExt, $allowed)) {
            // Clean filename
            $safeName = preg_replace('/[^a-zA-Z0-9]/', '', $name);
            $newFileName = $safeName . '_' . time() . '.' . $fileExt;
            $uploadFile = $uploadDir . $newFileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $imageUrl = 'assets/uploads/team/' . $newFileName;
            } else {
                $error = "Dosya yüklenirken bir hata oluştu.";
            }
        } else {
            $error = "Sadece resim dosyaları yüklenebilir (JPG, PNG, WEBP).";
        }
    }

    if (empty($error)) {
        if ($id) {
            // Update
            $sql = "UPDATE team_members SET name = ?, title = ?, image_url = ?, order_index = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $title, $imageUrl, $order_index, $id]);
        } else {
            // Insert
            $sql = "INSERT INTO team_members (name, title, image_url, order_index) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $title, $imageUrl, $order_index]);
        }

        header("Location: team.php");
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
            <h3 class="mb-4 text-white"><?php echo $id ? 'Ekip Üyesi Düzenle' : 'Yeni Ekip Üyesi Ekle'; ?></h3>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Ad Soyad</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="name"
                                    name="name" value="<?php echo $member ? htmlspecialchars($member['name']) : ''; ?>"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Ünvan</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="title"
                                    name="title"
                                    value="<?php echo $member ? htmlspecialchars($member['title']) : ''; ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="order_index" class="form-label">Sıralama</label>
                            <input type="number" class="form-control bg-dark text-white border-secondary"
                                id="order_index" name="order_index"
                                value="<?php echo $member ? $member['order_index'] : 0; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Fotoğraf</label>
                            <input type="file" class="form-control bg-dark text-white border-secondary" id="image"
                                name="image">
                            <?php if ($member && $member['image_url']): ?>
                                <div class="mt-2 text-warning">
                                    <small>Mevcut Görsel:</small><br>
                                    <img src="<?php echo "../" . $member['image_url']; ?>" alt="Current"
                                        style="height: 100px; border-radius: 5px;">
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit"
                            class="btn btn-success"><?php echo $id ? 'Güncelle' : 'Kaydet'; ?></button>
                        <a href="team.php" class="btn btn-outline-light">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>