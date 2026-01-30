<?php include dirname(__DIR__) . '/config.php'; ?>
<?php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Optional: Delete children or move them to root? For now, we'll let MySQL handle it or delete them too manually.
    // Better logic: Update children's parent_id to NULL or delete them. 
    // Let's implement cascade delete manually to be safe.

    // First delete children (or update to parent)
    // $pdo->prepare("UPDATE menus SET parent_id = NULL WHERE parent_id = ?")->execute([$id]); // This moves children to root

    $stmt = $pdo->prepare("DELETE FROM menus WHERE id = ?");
    if ($stmt->execute([$id])) {
        // Also delete children? Let's assume a simple structure for now. 
        // If we want to delete children strictly:
        $pdo->prepare("DELETE FROM menus WHERE parent_id = ?")->execute([$id]);

        header("Location: menus.php?msg=deleted");
    } else {
        header("Location: menus.php?error=delete_failed");
    }
} else {
    header("Location: menus.php");
}
exit;
?>
