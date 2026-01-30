<?php
include dirname(__DIR__) . '/config.php';
require_once 'includes/auth_check.php';
require_once 'includes/db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Optional: Delete image file from server if needed
    // $stmt = $pdo->prepare("SELECT image_url FROM page_sections WHERE id = ?");
    // ...

    $stmt = $pdo->prepare("DELETE FROM page_sections WHERE id = ?");
    if ($stmt->execute([$id])) {
        header("Location: page-sections.php?msg=deleted");
    } else {
        header("Location: page-sections.php?error=delete_failed");
    }
} else {
    header("Location: page-sections.php");
}
?>