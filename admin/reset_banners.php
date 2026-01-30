<?php
require_once 'includes/db.php';

try {
    $pdo->exec("TRUNCATE TABLE banners");
    echo "Banners table truncated successfully.";
} catch (PDOException $e) {
    echo "Error truncating table: " . $e->getMessage();
}
?>