<?php
// admin/announcement-delete.php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM announcements WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: announcements.php?deleted=success");
    } catch (PDOException $e) {
        die("Hata: " . $e->getMessage());
    }
} else {
    header("Location: announcements.php");
}
exit;
?>