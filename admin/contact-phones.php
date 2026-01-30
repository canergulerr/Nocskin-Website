<?php
include dirname(__DIR__) . '/config.php';
require_once 'includes/auth_check.php';
require_once 'includes/db.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

// Delete Logic
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM contact_phones WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: contact-phones.php?msg=deleted");
    exit;
}

// Fetch Phones
$stmt = $pdo->query("SELECT * FROM contact_phones ORDER BY sort_order ASC, id ASC");
$phones = $stmt->fetchAll();
?>

<div id="page-content-wrapper">
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0 fw-bold clr-dark">Telefon Numaraları</h3>
            <div>
                <a href="contact-settings.php" class="btn btn-light border me-2">
                    <i class="fas fa-arrow-left me-2"></i> Ayarlara Dön
                </a>
                <a href="contact-phone-edit.php" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Yeni Numara Ekle
                </a>
            </div>
        </div>

        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
            <div class="alert alert-success">Numara başarıyla silindi.</div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">Sıra</th>
                                <th>Başlık</th>
                                <th>Numara</th>
                                <th>Ülke</th>
                                <th style="width: 100px;">Durum</th>
                                <th style="width: 150px;">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($phones) > 0): ?>
                                <?php foreach ($phones as $phone): ?>
                                    <tr>
                                        <td><?php echo $phone['sort_order']; ?></td>
                                        <td class="fw-bold"><?php echo htmlspecialchars($phone['title']); ?></td>
                                        <td><?php echo htmlspecialchars($phone['phone_number']); ?></td>
                                        <td><small
                                                class="text-uppercase"><?php echo htmlspecialchars($phone['country_name']); ?></small>
                                        </td>
                                        <td>
                                            <?php if ($phone['status']): ?>
                                                <span class="badge bg-success-soft text-success">Aktif</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary-soft text-secondary">Pasif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="contact-phone-edit.php?id=<?php echo $phone['id']; ?>"
                                                class="btn btn-warning btn-sm text-white me-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="contact-phones.php?delete=<?php echo $phone['id']; ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bu numarayı silmek istediğinize emin misiniz?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Henüz numara eklenmemiş.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>