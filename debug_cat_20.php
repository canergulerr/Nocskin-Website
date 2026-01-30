<?php
require_once 'admin/includes/db.php';

// Check ID 20
$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = 20");
$stmt->execute();
$cat20 = $stmt->fetch(PDO::FETCH_ASSOC);

echo "Category ID 20:\n";
print_r($cat20);

// Check Slug 'leke-karsiti-aydinlatici-serum'
$slug = 'leke-karsiti-aydinlatici-serum';
$stmt2 = $pdo->prepare("SELECT * FROM categories WHERE slug = ?");
$stmt2->execute([$slug]);
$catSlug = $stmt2->fetch(PDO::FETCH_ASSOC);

echo "\nCategory with slug '$slug':\n";
print_r($catSlug);

// Check Products in Cat 20
echo "\nProducts in Category 20:\n";
$stmt3 = $pdo->prepare("SELECT * FROM product_categories WHERE category_id = 20");
$stmt3->execute();
$prods = $stmt3->fetchAll(PDO::FETCH_ASSOC);
print_r($prods);
?>