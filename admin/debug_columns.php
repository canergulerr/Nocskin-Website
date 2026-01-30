<?php
require_once 'includes/db.php';
$stmt = $pdo->query("SELECT * FROM products LIMIT 1");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
print_r(array_keys($row));
?>