<?php
include 'includes/db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    // Optionally delete the file from server if you want cleanup
    /*
    $stmt = $pdo->prepare("SELECT media_url FROM slider_items WHERE id = ?");
    $stmt->execute([$id]);
    $file = $stmt->fetchColumn();
    if ($file && file_exists("../" . $file)) {
        unlink("../" . $file);
    }
    */

    $stmt = $pdo->prepare("DELETE FROM slider_items WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: slider.php");
exit;
?>