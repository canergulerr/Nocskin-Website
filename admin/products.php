<?php
include 'includes/db.php';
$pageTitle = 'Ürün Yönetimi';
include 'includes/header.php';
include 'includes/sidebar.php';

// Pagination
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

// Search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$whereClause = "";
$params = [];
if ($search) {
    $whereClause = "WHERE name LIKE :search OR slug LIKE :search";
    $params[':search'] = "%$search%";
}

// Fetch Products
$stmt = $pdo->prepare("SELECT * FROM products $whereClause ORDER BY id DESC LIMIT $limit OFFSET $offset");
foreach ($params as $key => $val) {
    $stmt->bindValue($key, $val);
}
$stmt->execute();
$products = $stmt->fetchAll();

// Total Count
$countStmt = $pdo->prepare("SELECT COUNT(*) FROM products $whereClause");
foreach ($params as $key => $val) {
    $countStmt->bindValue($key, $val);
}
$countStmt->execute();
$totalProducts = $countStmt->fetchColumn();
$totalPages = ceil($totalProducts / $limit);
?>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-fluid">
            <h4 class="mb-0 fw-bold clr-dark">Ürün Yönetimi</h4>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 fw-bold text-dark">Ürün Listesi</h5>
                <a href="product-edit.php" class="btn btn-primary d-inline-flex align-items-center">
                    <i class="fas fa-plus me-2"></i> Yeni Ürün Ekle
                </a>
            </div>

            <div class="card-body">
                <!-- Search Form -->
                <form action="" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Ürün adı veya slug ara..."
                            value="<?= htmlspecialchars($search) ?>">
                        <button type="submit" class="btn btn-dark">
                            <i class="fas fa-search me-2"></i> Ara
                        </button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;">Resim</th>
                                <th>Ürün Adı</th>
                                <th>Fiyat</th>
                                <th>Slug</th>
                                <th>Durum</th>
                                <th class="text-end">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td>
                                        <?php if ($product['image']): ?>
                                            <img src="<?= htmlspecialchars($product['image']) ?>" class="rounded"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Yok</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-medium"><?= htmlspecialchars($product['name']) ?></td>
                                    <td><?= htmlspecialchars($product['price']) ?>
                                        <small><?= htmlspecialchars($product['currency']) ?></small></td>
                                    <td class="text-muted small"><?= htmlspecialchars($product['slug']) ?></td>
                                    <td>
                                        <?php if ($product['status']): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger bg-opacity-10 text-danger">Pasif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <a href="product-edit.php?id=<?= $product['id'] ?>"
                                            class="btn btn-sm btn-outline-primary me-1" title="Düzenle">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="product-delete.php?id=<?= $product['id'] ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Silmek istediğinize emin misiniz?')" title="Sil">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($products)): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Kayıtlı ürün bulunamadı.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>