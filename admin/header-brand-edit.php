<?php
// admin/header-brand-edit.php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$brand = [
    'title' => '',
    'url' => '',
    'logo_path' => '',
    'class_name' => '',
    'order_index' => 10,
    'status' => 1
];

$page_title = "Yeni Marka Ekle";
$success = "";
$error = "";

if ($id > 0) {
    $page_title = "Marka Düzenle";
    $stmt = $pdo->prepare("SELECT * FROM header_brands WHERE id = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    if ($result) {
        $brand = $result;
    } else {
        header("Location: header-brands.php");
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $url = trim($_POST['url']);
    $class_name = trim($_POST['class_name']);
    $order_index = (int)$_POST['order_index'];
    $status = isset($_POST['status']) ? 1 : 0;

    // File Upload Query
    $uploadError = false;
    $logo_path = $brand['logo_path']; // Default to existing

    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $allowed = ['svg', 'png', 'jpg', 'jpeg', 'gif'];
        $filename = $_FILES['logo']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            // Upload dir: assets/images/brands-logo/
            $uploadDir = '../assets/images/brands-logo/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $newFilename = uniqid('brand_') . '.' . $ext;
            $destination = $uploadDir . $newFilename;
            
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $destination)) {
                $logo_path = 'assets/images/brands-logo/' . $newFilename;
            } else {
                $error = "Dosya yüklenirken bir hata oluştu.";
                $uploadError = true;
            }
        } else {
            $error = "Geçersiz dosya formatı. (İzin verilen: SVG, PNG, JPG)";
            $uploadError = true;
        }
    }

    if (!$uploadError) {
        if (empty($title)) {
            $error = "Başlık boş bırakılamaz.";
        } else {
            try {
                if ($id > 0) {
                    // Update
                    $sql = "UPDATE header_brands SET title = ?, url = ?, logo_path = ?, class_name = ?, order_index = ?, status = ? WHERE id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$title, $url, $logo_path, $class_name, $order_index, $status, $id]);
                } else {
                    // Insert
                    $sql = "INSERT INTO header_brands (title, url, logo_path, class_name, order_index, status) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$title, $url, $logo_path, $class_name, $order_index, $status]);
                    $id = $pdo->lastInsertId();
                }
                $success = "Marka başarıyla kaydedildi.";
                
                // Refresh data
                $stmt = $pdo->prepare("SELECT * FROM header_brands WHERE id = ?");
                $stmt->execute([$id]);
                $brand = $stmt->fetch();
                
            } catch (PDOException $e) {
                $error = "Veritabanı hatası: " . $e->getMessage();
            }
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
            <a href="header-brands.php" class="btn btn-outline-secondary">
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
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Başlık (Marka Adı)</label>
                        <input type="text" name="title" id="title" class="form-control" 
                               value="<?php echo htmlspecialchars($brand['title']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="url" class="form-label">Link</label>
                        <input type="text" name="url" id="url" class="form-control" 
                               value="<?php echo htmlspecialchars($brand['url']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo (SVG, PNG, JPG)</label>
                        <?php if ($brand['logo_path']): ?>
                            <div class="mb-2">
                                <img src="<?php echo BASE_URL . '/' . $brand['logo_path']; ?>" alt="Mevcut Logo" style="height: 40px; background: #eee; padding: 5px;">
                                <small class="text-muted ms-2">Mevcut Logo</small>
                            </div>
                        <?php endif; ?>
                        <input type="file" name="logo" id="logo" class="form-control">
                        <div class="form-text">Yeni bir dosya yüklemezseniz mevcut logo korunur.</div>
                    </div>

                    <div class="mb-3">
                        <label for="class_name" class="form-label">CSS Class (Opsiyonel)</label>
                        <input type="text" name="class_name" id="class_name" class="form-control" 
                               placeholder="Örn: brand_theordinary"
                               value="<?php echo htmlspecialchars($brand['class_name']); ?>">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="order_index" class="form-label">Sıralama</label>
                            <input type="number" name="order_index" id="order_index" class="form-control" 
                                   value="<?php echo $brand['order_index']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Durum</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status" 
                                       <?php echo $brand['status'] ? 'checked' : ''; ?>>
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
