<?php
include 'includes/header.php';
require_once 'includes/db.php';

// Fetch all assets
$stmt = $pdo->query("SELECT * FROM homepage_assets ORDER BY id ASC");
$assets = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <h3 class="m-0 text-white">Anasayfa İçerik Yönetimi</h3>
                <!-- No Add New button for Assets, as they are fixed slots -->
            </div>

            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col" style="width: 150px;">Medya</th>
                                    <th scope="col">Başlık / Açıklama</th>
                                    <th scope="col">Anahtar (Key)</th>
                                    <th scope="col">Tür</th>
                                    <th scope="col" style="width: 100px;">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($assets) > 0): ?>
                                    <?php foreach ($assets as $asset): ?>
                                        <tr>
                                            <td><?php echo $asset['id']; ?></td>
                                            <td>
                                                <?php if ($asset['type'] == 'image'): ?>
                                                    <img src="<?php echo "../" . $asset['file_path']; ?>" alt="Preview"
                                                        style="height: 50px; width: auto; object-fit: cover;">
                                                <?php else: ?>
                                                    <video src="<?php echo "../" . $asset['file_path']; ?>"
                                                        style="height: 50px; width: auto;" muted></video>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($asset['title']); ?></td>
                                            <td><code><?php echo htmlspecialchars($asset['asset_key']); ?></code></td>
                                            <td><span
                                                    class="badge bg-info text-dark"><?php echo ucfirst($asset['type']); ?></span>
                                            </td>
                                            <td>
                                                <a href="asset-edit.php?id=<?php echo $asset['id']; ?>"
                                                    class="btn btn-sm btn-warning me-1"><i class="fas fa-edit"></i> Düzenle</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-3">Görüntülenecek içerik bulunamadı.</td>
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