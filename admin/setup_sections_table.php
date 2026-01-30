<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/includes/db.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS blog_post_sections (
        id INT AUTO_INCREMENT PRIMARY KEY,
        post_id INT NOT NULL,
        section_key VARCHAR(255) NOT NULL,
        section_value LONGTEXT,
        section_type VARCHAR(50) DEFAULT 'text',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        image_url VARCHAR(500), 
        FOREIGN KEY (post_id) REFERENCES blog_posts(id) ON DELETE CASCADE,
        UNIQUE KEY unique_section (post_id, section_key)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    // Added image_url column specifically if we want to separate value vs image? 
    // Actually, let's keep it simple: section_value holds the text OR the url. 
    // User asked for "texts and images". 
    // But sometimes a section has BOTH text and image? 
    // The user prompts says: "Kaç ürüne ihtiyacım var? başlığı ve altındaki paragraf ve solundaki görsel".
    // This implies grouping. 
    // I can stick to flattening: `how_many_products_title`, `how_many_products_text`, `how_many_products_image`.
    // So the previous schema `section_key`, `section_value` is enough.

    $pdo->exec($sql);
    echo "Table 'blog_post_sections' created.\n";

} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage());
}
?>