<?php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    try {
        // First get the image paths to delete files if needed
        // (Optional: Implement file deletion if desired, but often safer to keep or separate cleanup)
        // For now, we will just delete the DB record to avoid breaking other references if images are shared.

        $stmt = $pdo->prepare("DELETE FROM banners WHERE id = ?");
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        // Handle error if needed
    }
}

header("Location: banners.php");
exit;
?>