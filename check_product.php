<?php
include 'admin/includes/db.php';

$id = 36;
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if ($product) {
    echo "JSON_START\n";
    echo json_encode($product, JSON_PRETTY_PRINT);
    echo "\nJSON_END";
} else {
    echo "Product ID $id not found.\n";
}
?>