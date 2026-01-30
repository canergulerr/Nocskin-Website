<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/includes/db.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS blog_posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        slug VARCHAR(255) NOT NULL UNIQUE,
        content LONGTEXT,
        meta_title VARCHAR(255),
        meta_description TEXT,
        hero_image VARCHAR(255),
        status TINYINT(1) DEFAULT 1,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    $pdo->exec($sql);
    echo "Table 'blog_posts' created or already exists.\n";

} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage());
}
?>