<?php
require_once 'includes/db.php';

// 1. Create/Get Category
$catSlug = 'leke-karsiti-aydinlatici-serum'; // Matching the existing static file name for realism
$catName = 'Leke Karşıtı & Aydınlatıcı Serum';
$catDesc = 'Cildinize ışıltı katan test edilmiş formüller.';

$stmt = $pdo->prepare("SELECT id FROM categories WHERE slug = ?");
$stmt->execute([$catSlug]);
$catId = $stmt->fetchColumn();

if (!$catId) {
    echo "Creating category: $catName... ";
    $ins = $pdo->prepare("INSERT INTO categories (name, slug, description, status) VALUES (?, ?, ?, 1)");
    $ins->execute([$catName, $catSlug, $catDesc]);
    $catId = $pdo->lastInsertId();
    echo "Done (ID: $catId)\n";
} else {
    echo "Category exists (ID: $catId)\n";
}

// 2. Link some products
// Let's link the first 5 products to this category for testing
$products = $pdo->query("SELECT id, name FROM products LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);

$linkStmt = $pdo->prepare("INSERT IGNORE INTO product_categories (product_id, category_id) VALUES (?, ?)");

echo "Linking products:\n";
foreach ($products as $p) {
    $linkStmt->execute([$p['id'], $catId]);
    echo " - Linked: " . $p['name'] . "\n";
}

echo "\nTest URL: category.php?slug=$catSlug\n";
?>