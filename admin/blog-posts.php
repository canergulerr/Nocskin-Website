<?php
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/db.php';

// Pagination
$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch posts
$stmt = $pdo->prepare("SELECT * FROM blog_posts ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll();

// Total count
$total_stmt = $pdo->query("SELECT COUNT(*) FROM blog_posts");
$total_rows = $total_stmt->fetchColumn();
$total_pages = ceil($total_rows / $limit);
?>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Blog Yazıları</h2>
        <!-- Future: Add New Post Button -->
        <!-- <a href="blog-post-edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> Yeni Ekle</a> -->
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Başlık</th>
                            <th>Slug</th>
                            <th>Durum</th>
                            <th>Tarih</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($post['title']); ?></td>
                                <td><?php echo htmlspecialchars($post['slug']); ?></td>
                                <td>
                                    <?php if ($post['status']): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Pasif</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo date('d.m.Y', strtotime($post['created_at'])); ?></td>
                                <td>
                                    <a href="blog-post-edit.php?id=<?php echo $post['id']; ?>"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Düzenle
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($posts)): ?>
                            <tr>
                                <td colspan="5" class="text-center">Henüz yazı yok.</td>
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
                            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>