<?php
include 'admin/includes/db.php';

// Check if size column exists
$stmt = $pdo->query("SHOW COLUMNS FROM products LIKE 'size'");
if ($stmt->rowCount() == 0) {
    $pdo->exec("ALTER TABLE products ADD COLUMN size VARCHAR(50) AFTER format");
    echo "Added 'size' column.\n";
}

// Update Product 36
$id = 36;
$size = "240ml";
$attributes = [
    'is_water_free' => 1,
    'is_alcohol_free' => 1,
    'is_oil_free' => 1,
    'is_silicone_free' => 1,
    'is_vegan' => 1,
    'is_gluten_free' => 0, // Example false
    'is_cruelty_free' => 1
];

$sql = "UPDATE products SET size = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$size, $id]);

echo "Updated Product $id size to $size.\n";
?>