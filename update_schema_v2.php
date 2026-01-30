<?php
include 'admin/includes/db.php';

try {
    // 1. Create product_variants table
    $sql = "CREATE TABLE IF NOT EXISTS product_variants (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT NOT NULL,
        size VARCHAR(50) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        image_path VARCHAR(255),
        is_default TINYINT(1) DEFAULT 0,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $pdo->exec($sql);
    echo "Created table 'product_variants'.\n";

    // 2. Add columns to products if not exist
    $cols = $pdo->query("SHOW COLUMNS FROM products")->fetchAll(PDO::FETCH_COLUMN);

    if (!in_array('key_ingredients', $cols)) {
        $pdo->exec("ALTER TABLE products ADD COLUMN key_ingredients TEXT AFTER ingredients");
        echo "Added 'key_ingredients' to products.\n";
    }

    if (!in_array('add_to_cart_url', $cols)) {
        $pdo->exec("ALTER TABLE products ADD COLUMN add_to_cart_url VARCHAR(255) AFTER price");
        echo "Added 'add_to_cart_url' to products.\n";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>