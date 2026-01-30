<?php
require_once 'admin/includes/db.php';
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = 36");
$stmt->execute();
print_r($stmt->fetch(PDO::FETCH_ASSOC));
?>