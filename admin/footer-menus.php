<?php
include 'includes/auth_check.php';
include 'includes/db.php';
include 'includes/header.php';
include 'includes/sidebar.php';

// Fetch footer menus
// Strategy: Fetch all menus where location starts with 'footer_'
// Structure them by Position (Column) -> Parent -> Children

$stmt = $pdo->prepare("SELECT * FROM menus WHERE location LIKE 'footer_%' ORDER BY position ASC, id ASC");
$stmt->execute();
$all_menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Group by Location/Type
$columns = []; // For 'footer_column' (Company, Support, etc.)
$bottom_links = []; // For 'footer_bottom' (Legal links)

foreach ($all_menus as $menu) {
    if ($menu['location'] == 'footer_bottom') {
        $bottom_links[] = $menu;
    } else {
        // Group by Parent ID first to find roots
        // Actually, let's build a tree
        $columns[] = $menu;
    }
}

function buildFooterTree($menus, $parentId = 0)
{
    $branch = array();
    foreach ($menus as $element) {
        if ($element['parent_id'] == $parentId) {
            $children = buildFooterTree($menus, $element['id']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }
    return $branch;
}

$columnTree = buildFooterTree($columns);
?>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-fluid">
            <h4 class="mb-0 fw-bold text-dark">Footer Menüleri</h4>
        </div>
    </nav>

    <div class="container-fluid mt-4 px-4">

        <div class="d-flex justify-content-end mb-3">
            <a href="menu-edit.php?location=footer_column" class="btn btn-primary"><i class="fas fa-plus me-2"></i> Yeni
                Footer Sütunu/Linki Ekle</a>
        </div>

        <div class="row">
            <!-- Footer Columns Section -->
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 text-primary">Footer Sütunları (Linkler)</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4">Başlık</th>
                                        <th>URL</th>
                                        <th>Sıra</th>
                                        <th>Konum</th>
                                        <th>İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    function renderRow($item, $level = 0)
                                    {
                                        $padding = $level * 30;
                                        echo '<tr>';
                                        echo '<td style="padding-left: ' . ($padding + 20) . 'px;">';
                                        if ($level > 0)
                                            echo '<i class="fas fa-level-up-alt fa-rotate-90 me-2 text-muted"></i>';
                                        echo '<strong>' . htmlspecialchars($item['title']) . '</strong>';
                                        echo '</td>';
                                        echo '<td>' . htmlspecialchars($item['url']) . '</td>';
                                        echo '<td>' . $item['position'] . '</td>';
                                        echo '<td>' . htmlspecialchars($item['location']) . '</td>';
                                        echo '<td>
                                            <a href="menu-edit.php?id=' . $item['id'] . '&location=footer_column" class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></a>
                                            <a href="menu-delete.php?id=' . $item['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Silmek istediğinize emin misiniz?\')"><i class="fas fa-trash"></i></a>
                                        </td>';
                                        echo '</tr>';

                                        if (isset($item['children'])) {
                                            foreach ($item['children'] as $child) {
                                                renderRow($child, $level + 1);
                                            }
                                        }
                                    }

                                    foreach ($columnTree as $col) {
                                        renderRow($col);
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom Section -->
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary">Alt Kısım Linkleri (Yasal / Copyright Yanı)</h5>
                        <a href="menu-edit.php?location=footer_bottom" class="btn btn-sm btn-outline-primary"><i
                                class="fas fa-plus"></i> Ekle</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4">Başlık</th>
                                        <th>URL</th>
                                        <th>Sıra</th>
                                        <th>İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bottom_links as $link): ?>
                                        <tr>
                                            <td class="ps-4"><?= htmlspecialchars($link['title']) ?></td>
                                            <td><?= htmlspecialchars($link['url']) ?></td>
                                            <td><?= $link['position'] ?></td>
                                            <td>
                                                <a href="menu-edit.php?id=<?= $link['id'] ?>&location=footer_bottom"
                                                    class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></a>
                                                <a href="menu-delete.php?id=<?= $link['id'] ?>"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Silmek istediğinize emin misiniz?')"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>