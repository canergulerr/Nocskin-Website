<?php include dirname(__DIR__) . '/config.php'; ?>
<?php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Fetch all menus ordered by parent_id and position
$stmt = $pdo->prepare("SELECT * FROM menus ORDER BY parent_id ASC, position ASC");
$stmt->execute();
$all_menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

function buildMenuTree($menus, $parentId = NULL, $level = 0)
{
    global $pdo; // For queries if needed, though we passed data
    $branch = array();
    foreach ($menus as $element) {
        if ($element['parent_id'] == $parentId) {
            $children = buildMenuTree($menus, $element['id'], $level + 1);
            $element['children'] = $children;
            $element['level'] = $level;
            $branch[] = $element;
        }
    }
    return $branch;
}

$menuTree = buildMenuTree($all_menus);

function renderMenuTable($tree)
{
    foreach ($tree as $menu) {
        $padding = $menu['level'] * 30;
        $status_badge = $menu['status'] ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-secondary">Pasif</span>';

        echo '<tr>';
        echo '<td style="padding-left: ' . ($padding + 10) . 'px;">';
        if ($menu['level'] > 0)
            echo '<i class="fas fa-level-up-alt fa-rotate-90 me-2 text-muted"></i>';
        echo htmlspecialchars($menu['title']);
        echo '</td>';
        echo '<td>' . htmlspecialchars($menu['url']) . '</td>';
        echo '<td>' . $menu['position'] . '</td>';
        echo '<td>' . $status_badge . '</td>';
        echo '<td>';
        echo '<a href="menu-edit.php?id=' . $menu['id'] . '" class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></a>';
        echo '<a href="menu-delete.php?id=' . $menu['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Bu menüyü silmek istediğinize emin misiniz?\')"><i class="fas fa-trash"></i></a>';
        echo '</td>';
        echo '</tr>';

        if (!empty($menu['children'])) {
            renderMenuTable($menu['children']);
        }
    }
}
?>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-fluid">
            <h4 class="mb-0 fw-bold text-dark">Menü Yönetimi</h4>
        </div>
    </nav>

    <div class="container-fluid mt-4 px-4">
        <div class="d-flex justify-content-end mb-3">
            <a href="menu-edit.php" class="btn btn-primary"><i class="fas fa-plus me-2"></i> Yeni Menü Ekle</a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 border-0">Başlık</th>
                                <th class="py-3 border-0">URL</th>
                                <th class="py-3 border-0">Sıra</th>
                                <th class="py-3 border-0">Durum</th>
                                <th class="py-3 border-0" style="width: 150px;">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($menuTree)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Henüz hiç menü eklenmemiş.</td>
                                </tr>
                            <?php else: ?>
                                <?php renderMenuTable($menuTree); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
