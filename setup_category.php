<?php
require_once 'admin/includes/db.php';
$name = 'Arama Önerileri';
$slug = 'arama-onerileri';
try {
    $stmt = $pdo->prepare("SELECT id FROM categories WHERE name = ?");
    $stmt->execute([$name]);
    if (!$stmt->fetch()) {
        $stmt = $pdo->prepare("INSERT INTO categories (name, slug, parent_id, status, created_at) VALUES (?, ?, 0, 1, NOW())");
        $stmt->execute([$name, $slug]);
        echo "Category '$name' created successfully.";
    } else {
        echo "Category '$name' already exists.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>