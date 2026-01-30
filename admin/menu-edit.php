<?php include dirname(__DIR__) . '/config.php'; ?>
<?php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$menu = null;
$error = '';
$success = '';

// Fetch existing menu if editing
if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM menus WHERE id = ?");
    $stmt->execute([$id]);
    $menu = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$menu) {
        header("Location: menus.php");
        exit;
    }
}

$location = isset($_GET['location']) ? $_GET['location'] : 'header';
if ($menu) {
    // specific checking if location is set in DB
    if (!empty($menu['location'])) {
        $location = $menu['location'];
    }
}

// Parent selection filtering
// If this is a footer link, only show parents from same location group
$parentDataParams = [$id];
$parentSql = "SELECT id, title FROM menus WHERE id != ? ";
if (strpos($location, 'footer') === 0) {
    $parentSql .= "AND location = ? ";
    $parentDataParams[] = $location;
} else {
    // Header menus shouldn't see footer roots as parents usually, but let's keep it flexible or filter
    $parentSql .= "AND location = 'header' ";
}
$parentSql .= "ORDER BY title ASC";

$stmt = $pdo->prepare($parentSql);
$stmt->execute($parentDataParams);
$parent_menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $url = trim($_POST['url']);
    $parent_id = !empty($_POST['parent_id']) ? intval($_POST['parent_id']) : NULL;
    $position = intval($_POST['position']);
    $status = isset($_POST['status']) ? 1 : 0;
    $location = $_POST['location']; // Post overrides

    if (empty($title)) {
        $error = "Menü başlığı zorunludur.";
    } else {
        if ($id > 0) {
            // Update
            $sql = "UPDATE menus SET parent_id = :parent_id, title = :title, url = :url, position = :position, status = :status, location = :location WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
        } else {
            // Insert
            $sql = "INSERT INTO menus (parent_id, title, url, position, status, location) VALUES (:parent_id, :title, :url, :position, :status, :location)";
            $stmt = $pdo->prepare($sql);
        }

        $stmt->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':position', $position, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':location', $location);

        if ($stmt->execute()) {

            // Determine redirect URL
            $redirectUrl = 'menus.php';
            if (strpos($location, 'footer') === 0) {
                $redirectUrl = 'footer-menus.php';
            }

            if ($id > 0) {
                $success = "Menü başarıyla güncellendi.";
                // Refresh menu data
                $stmt = $pdo->prepare("SELECT * FROM menus WHERE id = ?");
                $stmt->execute([$id]);
                $menu = $stmt->fetch(PDO::FETCH_ASSOC);

                // Optional: redirect to list
                header("Location: $redirectUrl");
                exit;
            } else {
                header("Location: $redirectUrl");
                exit;
            }
        } else {
            $error = "Bir hata oluştu.";
        }
    }
}

// Back Link logic
$backLink = 'menus.php';
if (strpos($location, 'footer') === 0) {
    $backLink = 'footer-menus.php';
}
?>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-fluid">
            <h4 class="mb-0 fw-bold text-dark"><?php echo $id > 0 ? 'Menü Düzenle' : 'Yeni Menü Ekle'; ?></h4>
        </div>
    </nav>

    <div class="container-fluid mt-4 px-4">
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="post">
                    <input type="hidden" name="location" value="<?= htmlspecialchars($location) ?>">

                    <div class="mb-3">
                        <label class="form-label">Üst Menü</label>
                        <select name="parent_id" class="form-select">
                            <option value="">-- Ana Menü (Yok) --</option>
                            <?php foreach ($parent_menus as $p_menu): ?>
                                <option value="<?php echo $p_menu['id']; ?>" <?php echo ($menu && $menu['parent_id'] == $p_menu['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($p_menu['title']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text">Eğer bu bir alt menü ise, üst menüsünü seçin.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Başlık</label>
                        <input type="text" name="title" class="form-control"
                            value="<?php echo $menu ? htmlspecialchars($menu['title']) : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="text" name="url" class="form-control"
                            value="<?php echo $menu ? htmlspecialchars($menu['url']) : '#'; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sıra</label>
                        <input type="number" name="position" class="form-control"
                            value="<?php echo $menu ? $menu['position'] : 0; ?>">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="status" class="form-check-input" id="statusCheck" <?php echo (!$menu || $menu['status']) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="statusCheck">Aktif</label>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Kaydet</button>
                    <a href="<?= $backLink ?>" class="btn btn-secondary ms-2">İptal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>