<?php
include dirname(__DIR__) . '/config.php';
require_once __DIR__ . '/includes/db.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS `page_sections` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `page_identifier` varchar(100) NOT NULL COMMENT 'e.g. yaslanma-karsiti',
      `title` varchar(255) DEFAULT NULL,
      `subtitle` varchar(255) DEFAULT NULL,
      `image_url` varchar(255) DEFAULT NULL,
      `button_text` varchar(100) DEFAULT NULL,
      `button_url` varchar(255) DEFAULT NULL,
      `status` tinyint(1) DEFAULT 1,
      `sort_order` int(11) DEFAULT 0,
      `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
      `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $pdo->exec($sql);
    echo "Table 'page_sections' created successfully.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>