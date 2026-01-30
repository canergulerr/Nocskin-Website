<?php
require_once __DIR__ . '/admin/includes/db.php';

$slug = 'leke-karsiti-aydinlatici-serum';
echo "Checking Category: $slug\n";

$stmt = $pdo->prepare("SELECT * FROM categories WHERE slug = ?");
$stmt->execute([$slug]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    die("Category not found in DB.\n");
}

echo "Category ID: " . $category['id'] . "\n";
echo "Category Name: " . $category['name'] . "\n\n";

echo "Linked Products:\n";
$pStmt = $pdo->prepare("
    SELECT p.id, p.name, p.slug 
    FROM products p 
    JOIN product_categories pc ON p.id = pc.product_id 
    WHERE pc.category_id = ?
");
$pStmt->execute([$category['id']]);
$products = $pStmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $p) {
    echo "- [{$p['id']}] {$p['name']} ({$p['slug']})\n";
}
?>