<?php
require_once __DIR__ . '/admin/includes/db.php';
$stmt = $pdo->query("DESCRIBE products");
$columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
echo "Columns in products table:\n";
print_r($columns);
?>