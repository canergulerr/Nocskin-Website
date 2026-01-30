<?php
require_once 'includes/auth_check.php';
include 'includes/db.php';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$product = [
    'name' => '',
    'slug' => '',
    'sku' => '',
    'price' => '0.00',
    'currency' => 'TRY',
    'volume' => '',
    'short_description' => '',
    'description' => '',
    'how_to_use' => '',
    'ingredients' => '',
    'image' => '',
    'status' => 1,
    'targets' => '',
    'suited_to' => '',
    'format' => '',
    'regimen_step' => '',
    'ph_range' => '',
    'is_water_free' => 0,
    'is_alcohol_free' => 0,
    'is_oil_free' => 0,
    'is_silicone_free' => 0,
    'is_vegan' => 0,
    'is_gluten_free' => 0,
    'is_cruelty_free' => 0,
    'testing_results' => '',
    'awards_image' => '',
    'key_ingredients' => '',
    'add_to_cart_url' => ''
];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($fetch) {
        $product = $fetch;
    }
}

// Fetch Variants
$variants = [];
if ($id) {
    $stmtVar = $pdo->prepare("SELECT * FROM product_variants WHERE product_id = ? ORDER BY price ASC");
    $stmtVar->execute([$id]);
    $variants = $stmtVar->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch Gallery
$galleryImages = [];
if ($id) {
    $stmtImg = $pdo->prepare("SELECT * FROM product_images WHERE product_id = ? ORDER BY sort_order ASC");
    $stmtImg->execute([$id]);
    $galleryImages = $stmtImg->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch Categories
$stmtCat = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
$allCategories = $stmtCat->fetchAll();
$productCategories = [];
if ($id) {
    $stmtPC = $pdo->prepare("SELECT category_id FROM product_categories WHERE product_id = ?");
    $stmtPC->execute([$id]);
    $productCategories = $stmtPC->fetchAll(PDO::FETCH_COLUMN);
}

// Handle POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Product Actions (Update/Create)
    if (isset($_POST['action']) && $_POST['action'] == 'save_product') {
        $name = $_POST['name'];
        $slug = $_POST['slug'] ?: strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
        $sku = $_POST['sku'];
        $price = $_POST['price'];
        $volume = $_POST['volume'];
        $description = $_POST['description'];
        $short_description = $_POST['short_description'];
        $how_to_use = isset($_POST['how_to_use']) ? $_POST['how_to_use'] : '';
        $ingredients = isset($_POST['ingredients']) ? $_POST['ingredients'] : '';
        $key_ingredients = isset($_POST['key_ingredients']) ? $_POST['key_ingredients'] : '';
        $add_to_cart_url = isset($_POST['add_to_cart_url']) ? $_POST['add_to_cart_url'] : '';
        $status = isset($_POST['status']) ? 1 : 0;

        $targets = $_POST['targets'];
        $suited_to = $_POST['suited_to'];
        $format = $_POST['format'];
        $regimen_step = $_POST['regimen_step'];
        $ph_range = $_POST['ph_range'];
        $testing_results = $_POST['testing_results'];

        // Booleans
        $is_water_free = isset($_POST['is_water_free']) ? 1 : 0;
        $is_alcohol_free = isset($_POST['is_alcohol_free']) ? 1 : 0;
        $is_oil_free = isset($_POST['is_oil_free']) ? 1 : 0;
        $is_silicone_free = isset($_POST['is_silicone_free']) ? 1 : 0;
        $is_vegan = isset($_POST['is_vegan']) ? 1 : 0;
        $is_gluten_free = isset($_POST['is_gluten_free']) ? 1 : 0;
        $is_cruelty_free = isset($_POST['is_cruelty_free']) ? 1 : 0;

        $selectedCategories = isset($_POST['categories']) ? $_POST['categories'] : [];

        // Image Logic
        $imagePath = $product['image'];
        if (!empty($_FILES['image']['name'])) {
            $uploadDir = '../assets/uploads/products/';
            if (!is_dir($uploadDir))
                mkdir($uploadDir, 0777, true);
            $fileName = time() . '_' . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName)) {
                $imagePath = BASE_URL . '/assets/uploads/products/' . $fileName;
            }
        }

        $awardsImagePath = $product['awards_image'];
        if (!empty($_FILES['awards_image']['name'])) {
            $uploadDir = '../assets/uploads/products/';
            if (!is_dir($uploadDir))
                mkdir($uploadDir, 0777, true);
            $fileName = time() . '_awards_' . basename($_FILES['awards_image']['name']);
            if (move_uploaded_file($_FILES['awards_image']['tmp_name'], $uploadDir . $fileName)) {
                $awardsImagePath = BASE_URL . '/assets/uploads/products/' . $fileName;
            }
        }

        if ($id) {
            $sql = "UPDATE products SET name=?, slug=?, sku=?, price=?, volume=?, short_description=?, description=?, how_to_use=?, ingredients=?, key_ingredients=?, add_to_cart_url=?, image=?, status=?, targets=?, suited_to=?, format=?, regimen_step=?, ph_range=?, is_water_free=?, is_alcohol_free=?, is_oil_free=?, is_silicone_free=?, is_vegan=?, is_gluten_free=?, is_cruelty_free=?, testing_results=?, awards_image=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $slug, $sku, $price, $volume, $short_description, $description, $how_to_use, $ingredients, $key_ingredients, $add_to_cart_url, $imagePath, $status, $targets, $suited_to, $format, $regimen_step, $ph_range, $is_water_free, $is_alcohol_free, $is_oil_free, $is_silicone_free, $is_vegan, $is_gluten_free, $is_cruelty_free, $testing_results, $awardsImagePath, $id]);
        } else {
            $sql = "INSERT INTO products (name, slug, sku, price, volume, short_description, description, how_to_use, ingredients, key_ingredients, add_to_cart_url, image, status, targets, suited_to, format, regimen_step, ph_range, is_water_free, is_alcohol_free, is_oil_free, is_silicone_free, is_vegan, is_gluten_free, is_cruelty_free, testing_results, awards_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $slug, $sku, $price, $volume, $short_description, $description, $how_to_use, $ingredients, $key_ingredients, $add_to_cart_url, $imagePath, $status, $targets, $suited_to, $format, $regimen_step, $ph_range, $is_water_free, $is_alcohol_free, $is_oil_free, $is_silicone_free, $is_vegan, $is_gluten_free, $is_cruelty_free, $testing_results, $awardsImagePath]);
            $id = $pdo->lastInsertId();
        }

        // Categories
        $pdo->prepare("DELETE FROM product_categories WHERE product_id = ?")->execute([$id]);
        if (!empty($selectedCategories)) {
            $insertCat = $pdo->prepare("INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)");
            foreach ($selectedCategories as $catId)
                $insertCat->execute([$id, $catId]);
        }

        $_SESSION['flash_success'] = "Ürün başarıyla güncellendi.";
        header("Location: product-edit.php?id=$id");
        exit;
    }

    // 2. Add Variant
    if (isset($_POST['action']) && $_POST['action'] == 'add_variant') {
        $size = $_POST['v_size'];
        $price = $_POST['v_price'];

        $vImagePath = '';
        if (!empty($_FILES['v_image']['name'])) {
            $uploadDir = '../assets/uploads/products/';
            if (!is_dir($uploadDir))
                mkdir($uploadDir, 0777, true);
            $fileName = time() . '_var_' . basename($_FILES['v_image']['name']);
            if (move_uploaded_file($_FILES['v_image']['tmp_name'], $uploadDir . $fileName)) {
                $vImagePath = BASE_URL . '/assets/uploads/products/' . $fileName;
            }
        }

        $stmt = $pdo->prepare("INSERT INTO product_variants (product_id, size, price, image_path) VALUES (?, ?, ?, ?)");
        $stmt->execute([$id, $size, $price, $vImagePath]);
        echo "<script>window.location.href='product-edit.php?id=$id&tab=variants';</script>";
        exit;
    }

    // 3. Delete Variant
    if (isset($_POST['action']) && $_POST['action'] == 'delete_variant') {
        $vid = $_POST['variant_id'];
        $pdo->prepare("DELETE FROM product_variants WHERE id = ?")->execute([$vid]);
        echo "<script>window.location.href='product-edit.php?id=$id&tab=variants';</script>";
        exit;
    }

    // 4. Gallery Upload
    if (isset($_POST['action']) && $_POST['action'] == 'upload_gallery') {
        if (!empty($_FILES['gallery']['name'][0])) {
            $uploadDir = '../assets/uploads/products/';
            if (!is_dir($uploadDir))
                mkdir($uploadDir, 0777, true);

            foreach ($_FILES['gallery']['name'] as $key => $name) {
                if ($_FILES['gallery']['error'][$key] == 0) {
                    $fileName = time() . '_gal_' . basename($name);
                    if (move_uploaded_file($_FILES['gallery']['tmp_name'][$key], $uploadDir . $fileName)) {
                        $path = BASE_URL . '/assets/uploads/products/' . $fileName;
                        $pdo->prepare("INSERT INTO product_images (product_id, image_path, sort_order) VALUES (?, ?, ?)")
                            ->execute([$id, $path, 10]);
                    }
                }
            }
        }
        echo "<script>window.location.href='product-edit.php?id=$id&tab=gallery';</script>";
        exit;
    }

    // 5. Delete Gallery Image
    if (isset($_POST['action']) && $_POST['action'] == 'delete_gallery_image') {
        $imgId = $_POST['image_id'];
        $pdo->prepare("DELETE FROM product_images WHERE id = ?")->execute([$imgId]);
        echo "<script>window.location.href='product-edit.php?id=$id&tab=gallery';</script>";
        exit;
    }
}

$pageTitle = 'Ürün Düzenle';
include 'includes/header.php';
include 'includes/sidebar.php';


?>

<div id="page-content-wrapper">
    <div class="container-fluid mt-4">
        <div class="header-area d-flex justify-content-between align-items-center">
            <h1><?= $id ? 'Ürün Düzenle: ' . htmlspecialchars($product['name']) : 'Yeni Ürün Ekle' ?></h1>
            <a href="products.php" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Ürünlere Dön
            </a>
        </div>

        <!-- Flash Messages -->
        <?php if (isset($_SESSION['flash_success'])): ?>
            <div class="alert alert-success shadow-sm border-0 rounded-3 mt-4 mb-0">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-2 me-3 text-success">
                        <i class="fas fa-check-circle fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Başarılı!</h6>
                        <p class="mb-0 text-muted small"><?php echo $_SESSION['flash_success']; ?></p>
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <?php unset($_SESSION['flash_success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['flash_error'])): ?>
            <div class="alert alert-danger shadow-sm border-0 rounded-3 mt-4 mb-0">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-danger bg-opacity-10 p-2 me-3 text-danger">
                        <i class="fas fa-exclamation-circle fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Hata!</h6>
                        <p class="mb-0 text-muted small"><?php echo $_SESSION['flash_error']; ?></p>
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <?php unset($_SESSION['flash_error']); ?>
        <?php endif; ?>

        <div class="form-container mt-3">
            <ul class="nav nav-tabs mb-4" id="mainTabs">
                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#general">Genel Bilgiler</a>
                </li>
                <?php if ($id): ?>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#variants">Varyasyonlar
                            (ml/Fiyat)</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#gallery">Galeri</a></li>
                <?php endif; ?>
            </ul>

            <div class="tab-content">
                <!-- GENERAL TAB -->
                <div class="tab-pane fade show active" id="general">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="save_product">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Temel</h5>
                                        <div class="mb-3">
                                            <label class="form-label">Ürün Adı</label>
                                            <input type="text" name="name" class="form-control"
                                                value="<?= htmlspecialchars($product['name']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Slug</label>
                                            <input type="text" name="slug" class="form-control"
                                                value="<?= htmlspecialchars($product['slug']) ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kısa Açıklama</label>
                                            <textarea name="short_description" class="form-control"
                                                rows="2"><?= htmlspecialchars($product['short_description']) ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Detaylı Açıklama (HTML)</label>
                                            <textarea name="description" class="form-control"
                                                rows="5"><?= htmlspecialchars($product['description']) ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Key Ingredients (Virgülle ayır)</label>
                                            <input type="text" name="key_ingredients" class="form-control"
                                                value="<?= htmlspecialchars($product['key_ingredients']) ?>"
                                                placeholder="Glycolic Acid, Aloe Vera...">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">İçerik Listesi (Full Ingredients)</label>
                                            <textarea name="ingredients" class="form-control"
                                                rows="3"><?= htmlspecialchars($product['ingredients']) ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Test Sonuçları (HTML)</label>
                                            <textarea name="testing_results" class="form-control"
                                                rows="3"><?= htmlspecialchars($product['testing_results']) ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Özellikler</h5>
                                        <div class="row">
                                            <div class="col-md-4 mb-3"><label class="form-label">Targets</label><input
                                                    type="text" name="targets" class="form-control"
                                                    value="<?= htmlspecialchars($product['targets']) ?>"></div>
                                            <div class="col-md-4 mb-3"><label class="form-label">Suited To</label><input
                                                    type="text" name="suited_to" class="form-control"
                                                    value="<?= htmlspecialchars($product['suited_to']) ?>"></div>
                                            <div class="col-md-4 mb-3"><label class="form-label">Format</label><input
                                                    type="text" name="format" class="form-control"
                                                    value="<?= htmlspecialchars($product['format']) ?>"></div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Regimen Step</label>
                                                <select name="regimen_step" class="form-select">
                                                    <option value="">Seçiniz</option>
                                                    <option value="Prep" <?= $product['regimen_step'] == 'Prep' ? 'selected' : '' ?>>Step 1: Prep</option>
                                                    <option value="Treat" <?= $product['regimen_step'] == 'Treat' ? 'selected' : '' ?>>Step 2: Treat</option>
                                                    <option value="Seal" <?= $product['regimen_step'] == 'Seal' ? 'selected' : '' ?>>Step 3: Seal</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3"><label class="form-label">pH Range</label><input
                                                    type="text" name="ph_range" class="form-control"
                                                    value="<?= htmlspecialchars($product['ph_range']) ?>"></div>
                                        </div>

                                        <label class="form-label fw-bold mt-2">Highlights</label>
                                        <div class="row">
                                            <?php
                                            $bools = ['is_water_free', 'is_alcohol_free', 'is_oil_free', 'is_silicone_free', 'is_vegan', 'is_gluten_free', 'is_cruelty_free'];
                                            foreach ($bools as $b): ?>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="<?= $b ?>"
                                                            value="1" <?= $product[$b] ? 'checked' : '' ?>>
                                                        <label
                                                            class="form-check-label"><?= ucfirst(str_replace(['is_', '_'], ['', ' '], $b)) ?></label>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card p-3 mb-3">
                                    <label class="fw-bold">Fiyat & Stok</label>
                                    <div class="mb-2">
                                        <label>Varsayılan Fiyat</label>
                                        <input type="number" step="0.01" name="price" class="form-control"
                                            value="<?= htmlspecialchars($product['price']) ?>">
                                    </div>
                                    <div class="mb-2">
                                        <label>SKU</label>
                                        <input type="text" name="sku" class="form-control"
                                            value="<?= htmlspecialchars($product['sku']) ?>">
                                    </div>
                                    <div class="mb-2">
                                        <label>Hacim (Default)</label>
                                        <input type="text" name="volume" class="form-control"
                                            value="<?= htmlspecialchars($product['volume']) ?>">
                                    </div>
                                    <div class="mb-2">
                                        <label>Durum</label>
                                        <select name="status" class="form-control">
                                            <option value="1" <?= $product['status'] ? 'selected' : '' ?>>Aktif</option>
                                            <option value="0" <?= !$product['status'] ? 'selected' : '' ?>>Pasif</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label>Özel Sepet URL'si (Opsiyonel)</label>
                                        <input type="text" name="add_to_cart_url" class="form-control"
                                            value="<?= htmlspecialchars($product['add_to_cart_url']) ?>"
                                            placeholder="https://...">
                                    </div>
                                </div>

                                <div class="card p-3 mb-3">
                                    <label class="fw-bold">Kategoriler</label>
                                    <input type="text" id="categorySearch" class="form-control mb-2 form-control-sm"
                                        placeholder="Kategori ara...">
                                    <div id="categoryList" style="max-height: 200px; overflow-y: auto;">
                                        <?php foreach ($allCategories as $cat): ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="categories[]"
                                                    value="<?= $cat['id'] ?>" <?= in_array($cat['id'], $productCategories) ? 'checked' : '' ?>>
                                                <label class="form-check-label"><?= htmlspecialchars($cat['name']) ?></label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <script>
                                        document.getElementById('categorySearch').addEventListener('keyup', function() {
                                            var filter = this.value.toLowerCase();
                                            var list = document.getElementById('categoryList');
                                            var items = list.getElementsByClassName('form-check');
                                            for (var i = 0; i < items.length; i++) {
                                                var label = items[i].getElementsByClassName('form-check-label')[0];
                                                var txtValue = label.textContent || label.innerText;
                                                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                                                    items[i].style.display = "";
                                                } else {
                                                    items[i].style.display = "none";
                                                }
                                            }
                                        });
                                    </script>
                                </div>

                                <div class="card p-3 mb-3">
                                    <label class="fw-bold">Ana Görsel</label>
                                    <?php if ($product['image']): ?>
                                        <img src="<?= htmlspecialchars($product['image']) ?>" class="img-fluid mb-2"
                                            style="height: auto;">
                                    <?php endif; ?>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <div class="card p-3 mb-3">
                                    <label class="fw-bold">Ödül Görseli</label>
                                    <?php if ($product['awards_image']): ?>
                                        <img src="<?= htmlspecialchars($product['awards_image']) ?>" class="img-fluid mb-2"
                                            style="height: auto;">
                                    <?php endif; ?>
                                    <input type="file" name="awards_image" class="form-control">
                                </div>
                            </div>
                        </div> <!-- row -->

                        <button type="submit" class="btn btn-primary btn-lg w-100">KAYDET</button>
                    </form>
                </div>

                <?php if ($id): ?>
                    <!-- VARIANTS TAB -->
                    <div class="tab-pane fade" id="variants">
                        <div class="card border-0 shadow-sm mt-3">
                            <div class="card-body">
                                <h5>Mevcut Varyasyonlar</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Beden/Hacim</th>
                                            <th>Fiyat</th>
                                            <th>Görsel</th>
                                            <th>İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($variants as $var): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($var['size']) ?></td>
                                                <td><?= htmlspecialchars($var['price']) ?></td>
                                                <td>
                                                    <?php if ($var['image_path']): ?>
                                                        <img src="<?= $var['image_path'] ?>" style="height:40px;">
                                                    <?php else:
                                                        echo "Ana Görsel Kullanılıyor";
                                                    endif; ?>
                                                </td>
                                                <td>
                                                    <form method="POST" onsubmit="return confirm('Silinsin mi?');">
                                                        <input type="hidden" name="action" value="delete_variant">
                                                        <input type="hidden" name="variant_id" value="<?= $var['id'] ?>">
                                                        <button class="btn btn-danger btn-sm">Sil</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <hr>
                                <h5>Yeni Varyasyon Ekle</h5>
                                <form method="POST" enctype="multipart/form-data" class="row align-items-end">
                                    <input type="hidden" name="action" value="add_variant">
                                    <div class="col-md-3">
                                        <label>Boyut (Örn: 50ml)</label>
                                        <input type="text" name="v_size" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Fiyat</label>
                                        <input type="number" step="0.01" name="v_price" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Görsel (Opsiyonel)</label>
                                        <input type="file" name="v_image" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-success w-100">Ekle</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- GALLERY TAB -->
                    <div class="tab-pane fade" id="gallery">
                        <div class="card border-0 shadow-sm mt-3">
                            <div class="card-body">
                                <h5>Galeri Görselleri</h5>
                                <div class="row">
                                    <?php foreach ($galleryImages as $img): ?>
                                        <div class="col-md-2 text-center mb-3">
                                            <div class="border p-2">
                                                <img src="<?= $img['image_path'] ?>" class="img-fluid"
                                                    style="height:100px; object-fit:contain;">
                                                <form method="POST" class="mt-2">
                                                    <input type="hidden" name="action" value="delete_gallery_image">
                                                    <input type="hidden" name="image_id" value="<?= $img['id'] ?>">
                                                    <button class="btn btn-danger btn-sm w-100">Sil</button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <hr>
                                <h5>Toplu Yükle</h5>
                                <form method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="upload_gallery">
                                    <div class="mb-3">
                                        <label>Görseller Seçin (Çoklu)</label>
                                        <input type="file" name="gallery[]" class="form-control" multiple>
                                    </div>
                                    <button class="btn btn-primary">Yükle</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<script>
    // Keep tab active on reload if hash exists
    document.addEventListener("DOMContentLoaded", function () {
        var hash = window.location.hash || "<?= isset($_GET['tab']) ? '#' . $_GET['tab'] : '' ?>";
        if (hash) {
            var triggerEl = document.querySelector('a[href="' + hash + '"]');
            if (triggerEl) {
                new bootstrap.Tab(triggerEl).show();
            }
        }
    });
</script>

<?php include 'includes/footer.php'; ?>