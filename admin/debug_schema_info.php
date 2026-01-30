<?php
require_once 'includes/db.php';
echo "--- TABLES ---\n";
$tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
print_r($tables);

if (in_array('categories', $tables)) {
    echo "\n--- CATEGORIES SCHEMA ---\n";
    $stm = $pdo->query('DESCRIBE categories');
    print_r($stm->fetchAll(PDO::FETCH_ASSOC));
}

if (in_array('product_categories', $tables)) {
    echo "\n--- PRODUCT_CATEGORIES SCHEMA ---\n";
    $stm = $pdo->query('DESCRIBE product_categories');
    print_r($stm->fetchAll(PDO::FETCH_ASSOC));
} else {
    echo "\n[INFO] product_categories table NOT FOUND.\n";
}
?>