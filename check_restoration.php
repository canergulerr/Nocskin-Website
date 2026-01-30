<?php
include 'admin/includes/db.php';
$stmt = $pdo->prepare("SELECT description, ingredients FROM products WHERE id = 36");
$stmt->execute();
$p = $stmt->fetch(PDO::FETCH_ASSOC);
echo "Description Length: " . strlen($p['description']) . "\n";
echo "Ingredients Start: " . substr($p['ingredients'], 0, 50) . "...\n";
?>