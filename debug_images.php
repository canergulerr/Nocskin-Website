<?php
include 'admin/includes/db.php';
$id = 36;
$stmt = $pdo->prepare("SELECT * FROM product_images WHERE product_id = ? ORDER BY sort_order ASC, id ASC");
$stmt->execute([$id]);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "Found " . count($images) . " images for Product ID $id:\n";
foreach ($images as $img) {
    echo "- ID: {$img['id']}, Path: {$img['image_path']}, Sort: {$img['sort_order']}\n";
}
?>