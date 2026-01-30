<?php include dirname(__DIR__) . '/config.php'; ?>
<?php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';

$id = $_GET['id'] ?? null;
$title = $slug = $body = $summary = "";
$status = 1;
$image = "";
$error = "";
$success = "";
$is_edit = false;

// If ID exists, fetch data for editing
if ($id) {
    if (!is_numeric($id)) {
        header("Location: contents.php");
        exit;
    }

    $is_edit = true;
    $stmt = $pdo->prepare("SELECT * FROM contents WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch();

    if (!$row) {
        header("Location: contents.php");
        exit;
    }

    $title = $row['title'];
    $slug = $row['slug'];
    $body = $row['body'];
    $summary = $row['summary'];
    $status = $row['status'];
    $image = $row['image'];
}

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $slug = trim($_POST['slug']);
    $body = $_POST['body']; // Rich text, allow HTML
    $summary = trim($_POST['summary']);
    $status = isset($_POST['status']) ? 1 : 0;

    // Auto-generate slug if empty
    if (empty($slug)) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', iconv('UTF-8', 'API//TRANSLIT', $title))));
    }

    if (empty($title)) {
        $error = "Başlık gereklidir.";
    } else {
        // Image Upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "../uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $file_ext = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
            $new_filename = uniqid() . '.' . $file_ext;
            $target_file = $target_dir . $new_filename;

            $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (in_array($file_ext, $allowed_types)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = $new_filename; // Update image variable
                } else {
                    $error = "Dosya yüklenirken bir hata oluştu.";
                }
            } else {
                $error = "Sadece JPG, JPEG, PNG, GIF ve WEBP dosyaları yüklenebilir.";
            }
        }

        if (empty($error)) {
            try {
                if ($is_edit) {
                    $sql = "UPDATE contents SET title = :title, slug = :slug, body = :body, summary = :summary, status = :status, image = :image WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $id);
                } else {
                    $sql = "INSERT INTO contents (title, slug, body, summary, status, image) VALUES (:title, :slug, :body, :summary, :status, :image)";
                    $stmt = $pdo->prepare($sql);
                }

                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':slug', $slug);
                $stmt->bindParam(':body', $body);
                $stmt->bindParam(':summary', $summary);
                $stmt->bindParam(':status', $status, PDO::PARAM_INT);
                $stmt->bindParam(':image', $image);

                if ($stmt->execute()) {
                    header("Location: contents.php");
                    exit;
                } else {
                    $error = "Veritabanı hatası.";
                }
            } catch (PDOException $e) {
                // Duplicate slug error mostly
                if ($e->getCode() == 23000) {
                    $error = "Bu URL (Slug) zaten kullanılıyor. Lütfen değiştirin.";
                } else {
                    $error = "Hata: " . $e->getMessage();
                }
            }
        }
    }
}
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>

<!-- Include Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<div id="page-content-wrapper">
    <div class="container-fluid mt-4 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><?php echo $is_edit ? "İçeriği Düzenle" : "Yeni İçerik Ekle"; ?></h1>
            <a href="contents.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Geri Dön</a>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label">Başlık</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="<?php echo htmlspecialchars($title); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="slug" class="form-label">URL (Slug)</label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    value="<?php echo htmlspecialchars($slug); ?>"
                                    placeholder="Boş bırakırsanız başlıktan otomatik üretilir">
                            </div>

                            <div class="mb-3">
                                <label for="summary" class="form-label">Kısa Özet (Meta Description)</label>
                                <textarea name="summary" id="summary" class="form-control"
                                    rows="3"><?php echo htmlspecialchars($summary); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="body" class="form-label">İçerik</label>
                                <textarea name="body" id="summernote"
                                    class="form-control"><?php echo $body; ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header">Yayın Durumu</div>
                                <div class="card-body">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" <?php echo $status ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="status">Aktif</label>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">Öne Çıkan Görsel</div>
                                <div class="card-body">
                                    <?php if ($image): ?>
                                        <div class="mb-2">
                                            <img src="../uploads/<?php echo $image; ?>" class="img-fluid rounded"
                                                alt="Current Image">
                                        </div>
                                    <?php endif; ?>
                                    <input type="file" name="image" class="form-control">
                                    <small class="text-muted">Değiştirmek istemiyorsanız boş bırakın.</small>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit"
                                    class="btn btn-primary btn-lg"><?php echo $is_edit ? "Güncelle" : "Yayınla"; ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include Summernote JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $('#summernote').summernote({
        placeholder: 'İçeriğinizi buraya yazın...',
        tabsize: 2,
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>

<?php require_once 'includes/footer.php'; ?>
