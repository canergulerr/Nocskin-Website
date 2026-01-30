<?php
include 'admin/includes/db.php';

$stmt = $pdo->query("SELECT count(*) FROM products");
$count = $stmt->fetchColumn();
echo "Total Products in DB: $count\n";

$stmt2 = $pdo->query("SELECT id, name, slug FROM products LIMIT 5");
echo "\nFirst 5 products:\n";
while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    echo "- [{$row['id']}] {$row['name']} ({$row['slug']})\n";
}
?>