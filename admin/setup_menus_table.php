<?php include dirname(__DIR__) . '/config.php'; ?>
<?php
require_once 'includes/db.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS `menus` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `parent_id` int(11) DEFAULT NULL,
        `title` varchar(255) NOT NULL,
        `url` varchar(255) NOT NULL DEFAULT '#',
        `position` int(11) NOT NULL DEFAULT 0,
        `status` tinyint(1) NOT NULL DEFAULT 1,
        `image_url` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    $pdo->exec($sql);
    echo "Table 'menus' created successfully.";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
?>
