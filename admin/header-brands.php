<?php
// admin/header-brands.php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Pagination
$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch brands
$stmt = $pdo->prepare("SELECT * FROM header_brands ORDER BY order_index ASC LIMIT :limit OFFSET :offset");
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$brands = $stmt->fetchAll();

// Total count
$total_stmt = $pdo->query("SELECT COUNT(*) FROM header_brands");
$total_rows = $total_stmt->fetchColumn();
$total_pages = ceil($total_rows / $limit);
?>

<div id="page-content-wrapper">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Header Marka Yönetimi (Sol Üst)</h1>
            <a href="header-brand-edit.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Marka Ekle
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">ID</th>
                                <th>Logo</th>
                                <th>Başlık</th>
                                <th>URL</th>
                                <th>Sıra</th>
                                <th>Durum</th>
                                <th style="width: 150px;">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($brands as $row): ?>
                                <tr>
                                    <td>
                                        <?php echo $row['id']; ?>
                                    </td>
                                    <td>
                                        <?php if ($row['logo_path']): ?>
                                            <img src="<?php echo BASE_URL . '/' . $row['logo_path']; ?>" alt="Logo"
                                                style="height: 30px; background: #eee; padding: 2px;">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($row['title']); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($row['url']); ?>
                                    </td>
                                    <td>
                                        <?php echo $row['order_index']; ?>
                                    </td>
                                    <td>
                                        <?php if ($row['status']): ?>
                                            <span class="badge bg-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Pasif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="header-brand-edit.php?id=<?php echo $row['id']; ?>"
                                            class="btn btn-sm btn-info text-white me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="header-brand-delete.php?id=<?php echo $row['id']; ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bu markayı silmek istediğinize emin misiniz?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($brands)): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Henüz marka eklenmemiş.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>