<?php
require_once 'admin/includes/db.php';

echo "Checking Product Slugs...\n";
$stmt = $pdo->query("SELECT id, name, slug FROM products LIMIT 10");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: " . $row['id'] . " | Name: " . $row['name'] . " | Slug: [" . $row['slug'] . "]\n";
}
?>