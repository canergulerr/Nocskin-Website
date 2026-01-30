<?php
include dirname(__DIR__) . '/config.php';
require_once 'includes/db.php';

try {
    // 1. Categories Table
    $sql = "CREATE TABLE IF NOT EXISTS `categories` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `parent_id` int(11) DEFAULT NULL,
        `name` varchar(255) NOT NULL,
        `slug` varchar(255) NOT NULL UNIQUE,
        `image` varchar(255) DEFAULT NULL,
        `description` text,
        `sort_order` int(11) DEFAULT 0,
        `status` tinyint(1) DEFAULT 1,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $pdo->exec($sql);
    echo "Table 'categories' created or exists.<br>";

    // 2. Products Table
    $sql = "CREATE TABLE IF NOT EXISTS `products` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `slug` varchar(255) NOT NULL UNIQUE,
        `sku` varchar(100) DEFAULT NULL,
        `price` decimal(10,2) DEFAULT 0.00,
        `currency` varchar(10) DEFAULT 'TRY',
        `volume` varchar(50) DEFAULT NULL, -- e.g. 30ml
        `short_description` text,
        `description` longtext, -- Overview
        `how_to_use` longtext,
        `ingredients` longtext,
        `image` varchar(255) DEFAULT NULL, -- Main image
        `status` tinyint(1) DEFAULT 1,
        `is_new` tinyint(1) DEFAULT 0,
        `is_bestseller` tinyint(1) DEFAULT 0,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $pdo->exec($sql);
    echo "Table 'products' created or exists.<br>";

    // 3. Product Categories (Many-to-Many)
    $sql = "CREATE TABLE IF NOT EXISTS `product_categories` (
        `product_id` int(11) NOT NULL,
        `category_id` int(11) NOT NULL,
        PRIMARY KEY (`product_id`, `category_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $pdo->exec($sql);
    echo "Table 'product_categories' created or exists.<br>";

    // 4. Product Images (Gallery)
    $sql = "CREATE TABLE IF NOT EXISTS `product_images` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `product_id` int(11) NOT NULL,
        `image_path` varchar(255) NOT NULL,
        `is_primary` tinyint(1) DEFAULT 0,
        `sort_order` int(11) DEFAULT 0,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $pdo->exec($sql);
    echo "Table 'product_images' created or exists.<br>";

    // 5. Product Labels (Optional, if we want flexible tagging like 'New', 'Best Seller')
    // We already added is_new and is_bestseller columns, which is simpler for now.

    echo "Database setup completed successfully.";

} catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}
?>