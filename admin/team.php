<?php
include 'includes/header.php';
require_once 'includes/db.php';

// Fetch all team members
$stmt = $pdo->query("SELECT * FROM team_members ORDER BY order_index ASC");
$teamMembers = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <h3 class="m-0 text-white">Ekip Yönetimi</h3>
                <a href="team-edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> Yeni Üye Ekle</a>
            </div>

            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col" style="width: 100px;">Fotoğraf</th>
                                    <th scope="col">Ad Soyad</th>
                                    <th scope="col">Ünvan</th>
                                    <th scope="col" style="width: 100px;">Sıra</th>
                                    <th scope="col" style="width: 150px;">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($teamMembers) > 0): ?>
                                    <?php foreach ($teamMembers as $member): ?>
                                        <tr>
                                            <td><?php echo $member['id']; ?></td>
                                            <td>
                                                <img src="<?php echo "../" . $member['image_url']; ?>"
                                                    alt="<?php echo htmlspecialchars($member['name']); ?>"
                                                    style="height: 50px; width: 50px; object-fit: cover; border-radius: 50%;">
                                            </td>
                                            <td><?php echo htmlspecialchars($member['name']); ?></td>
                                            <td><?php echo htmlspecialchars($member['title']); ?></td>
                                            <td><?php echo $member['order_index']; ?></td>
                                            <td>
                                                <a href="team-edit.php?id=<?php echo $member['id']; ?>"
                                                    class="btn btn-sm btn-warning me-1"><i class="fas fa-edit"></i></a>
                                                <a href="team-delete.php?id=<?php echo $member['id']; ?>"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Bu ekip üyesini silmek istediğinize emin misiniz?');"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-3">Henüz ekip üyesi eklenmemiş.</td>
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