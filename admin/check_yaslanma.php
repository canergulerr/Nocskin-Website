<?php
require_once __DIR__ . '/includes/db.php';

$slug = 'yaslanma-karsiti-serum';
$id = 21;

echo "Checking Category: $slug (Fallback ID: $id)\n";

$stmt = $pdo->prepare("SELECT * FROM categories WHERE slug = ? OR id = ?");
$stmt->execute([$slug, $id]);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

print_r($categories);

if (!empty($categories)) {
    $catId = $categories[0]['id'];
    echo "Using ID: $catId\n";
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM product_categories WHERE category_id = ?");
    $stmt->execute([$catId]);
    echo "Product Count: " . $stmt->fetchColumn() . "\n";
}
?>