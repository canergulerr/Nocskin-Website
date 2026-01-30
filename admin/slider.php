<?php
include 'includes/header.php';
require_once 'includes/db.php';

// Fetch all slider items
$stmt = $pdo->query("SELECT * FROM slider_items ORDER BY order_index ASC");
$sliders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="d-flex" id="wrapper">
    <?php include 'includes/sidebar.php'; ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary" id="menu-toggle"><i class="fas fa-bars"></i></button>
            </div>
        </nav>

        <div class="container-fluid px-4 mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="m-0 text-white">Slider Yönetimi</h3>
                <a href="slider-edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> Yeni Ekle</a>
            </div>

            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col" style="width: 150px;">Medya</th>
                                    <th scope="col">Başlık</th>
                                    <th scope="col">Tür</th>
                                    <th scope="col" style="width: 100px;">Sıra</th>
                                    <th scope="col" style="width: 150px;">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($sliders) > 0): ?>
                                    <?php foreach ($sliders as $slide): ?>
                                        <tr>
                                            <td><?php echo $slide['id']; ?></td>
                                            <td>
                                                <?php if ($slide['type'] == 'image'): ?>
                                                    <img src="<?php echo "../" . $slide['media_url']; ?>" alt="Preview"
                                                        style="height: 50px; width: auto; object-fit: cover;">
                                                <?php else: ?>
                                                    <video src="<?php echo "../" . $slide['media_url']; ?>"
                                                        style="height: 50px; width: auto;" muted></video>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($slide['title']); ?></td>
                                            <td><span
                                                    class="badge bg-info text-dark"><?php echo ucfirst($slide['type']); ?></span>
                                            </td>
                                            <td><?php echo $slide['order_index']; ?></td>
                                            <td>
                                                <a href="slider-edit.php?id=<?php echo $slide['id']; ?>"
                                                    class="btn btn-sm btn-warning me-1"><i class="fas fa-edit"></i></a>
                                                <a href="slider-delete.php?id=<?php echo $slide['id']; ?>"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Bu slider öğesini silmek istediğinize emin misiniz?');"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-3">Henüz slider eklenmemiş.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>