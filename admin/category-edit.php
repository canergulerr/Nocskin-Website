<?php
include 'includes/db.php';
$pageTitle = 'Kategori Düzenle';
include 'includes/header.php';
include 'includes/sidebar.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$category = [
    'name' => '',
    'slug' => '',
    'parent_id' => 0,
    'image' => '',
    'description' => '',
    'sort_order' => 0,
    'status' => 1
];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->execute([$id]);
    $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($fetch) {
        $category = $fetch;
    }
}

// Fetch Potential Parents
$stmtParents = $pdo->query("SELECT * FROM categories WHERE id != $id ORDER BY name ASC");
$parents = $stmtParents->fetchAll();

// Handle Submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $slug = $_POST['slug'] ?: strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
    $parent_id = (int) $_POST['parent_id'];
    $description = $_POST['description'];
    $sort_order = (int) $_POST['sort_order'];
    $status = isset($_POST['status']) ? 1 : 0;

    // Image Upload
    $imagePath = $category['image'];
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = '../assets/uploads/categories/';
        if (!is_dir($uploadDir))
            mkdir($uploadDir, 0777, true);

        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = BASE_URL . '/assets/uploads/categories/' . $fileName;
        }
    }

    if ($id) {
        $sql = "UPDATE categories SET name=?, slug=?, parent_id=?, image=?, description=?, sort_order=?, status=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $slug, $parent_id, $imagePath, $description, $sort_order, $status, $id]);
    } else {
        $sql = "INSERT INTO categories (name, slug, parent_id, image, description, sort_order, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $slug, $parent_id, $imagePath, $description, $sort_order, $status]);
    }

    echo "<script>alert('Kategori başarıyla kaydedildi.'); window.location.href='categories.php';</script>";
}
?>

<div id="page-content-wrapper">
    <div class="container-fluid mt-4">
        <div class="header-area">
            <h1><?= $id ? 'Kategori Düzenle' : 'Yeni Kategori Ekle' ?></h1>
        </div>

        <div class="form-container">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Kategori Bilgileri</h5>
                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">Kategori Adı</label>
                                    <input type="text" name="name" class="form-control"
                                        value="<?= htmlspecialchars($category['name']) ?>" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">Slug (URL)</label>
                                    <input type="text" name="slug" class="form-control"
                                        value="<?= htmlspecialchars($category['slug']) ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">Üst Kategori</label>
                                    <select name="parent_id" class="form-select">
                                        <option value="0">-- Yok (Ana Kategori) --</option>
                                        <?php foreach ($parents as $p): ?>
                                            <option value="<?= $p['id'] ?>" <?= $p['id'] == $category['parent_id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($p['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">Açıklama</label>
                                    <textarea name="description" class="form-control"
                                        rows="5"><?= htmlspecialchars($category['description']) ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card p-3 mb-3">
                            <div class="form-group">
                                <label>Sıralama</label>
                                <input type="number" name="sort_order" class="form-control"
                                    value="<?= $category['sort_order'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Durum</label>
                                <select name="status" class="form-control">
                                    <option value="1" <?= $category['status'] ? 'selected' : '' ?>>Aktif</option>
                                    <option value="0" <?= !$category['status'] ? 'selected' : '' ?>>Pasif</option>
                                </select>
                            </div>
                        </div>

                        <div class="card p-3">
                            <label>Kategori Görseli</label>
                            <?php if ($category['image']): ?>
                                <div class="mb-2">
                                    <img src="<?= htmlspecialchars($category['image']) ?>" class="img-fluid"
                                        style="max-height: 200px;">
                                </div>
                            <?php endif; ?>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success btn-lg">Kaydet</button>
                    <a href="categories.php" class="btn btn-secondary btn-lg">İptal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>