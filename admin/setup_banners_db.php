<?php
require_once 'includes/db.php';

try {
    $sql = file_get_contents('sql/create_banners_table.sql');
    $pdo->exec($sql);
    echo "Banners table created successfully.";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
?>