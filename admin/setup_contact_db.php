<?php
include dirname(__DIR__) . '/config.php';
require_once __DIR__ . '/includes/db.php';

try {
    // 1. Create contact_categories table
    $sql_categories = "CREATE TABLE IF NOT EXISTS `contact_categories` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `title` varchar(255) NOT NULL,
      `sort_order` int(11) DEFAULT 0,
      `status` tinyint(1) DEFAULT 1,
      `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
      `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $pdo->exec($sql_categories);
    echo "Table 'contact_categories' created successfully.<br>";

    // 2. Create contact_links table
    $sql_links = "CREATE TABLE IF NOT EXISTS `contact_links` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `category_id` int(11) NOT NULL,
      `title` varchar(255) NOT NULL,
      `url` varchar(500) DEFAULT NULL,
      `sort_order` int(11) DEFAULT 0,
      `status` tinyint(1) DEFAULT 1,
      `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
      `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`),
      FOREIGN KEY (`category_id`) REFERENCES `contact_categories`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $pdo->exec($sql_links);
    echo "Table 'contact_links' created successfully.<br>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>