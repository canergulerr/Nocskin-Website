<?php
include 'config.php';
require_once 'admin/includes/db.php';

$stmt = $pdo->query("SHOW TABLES");
$tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
echo "Tables:\n";
foreach ($tables as $table) {
    echo "- $table\n";
}
?>