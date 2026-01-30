<?php
require_once __DIR__ . '/includes/db.php';

$postId = 3;
$key = 'header_image';
$value = 'https://publicfiles10em.blob.core.windows.net/cdn/Images/Deciem/brands/logos/white/ORD-O-Icon.png';
$type = 'image';

$stmt = $pdo->prepare("INSERT INTO blog_post_sections (post_id, section_key, section_value, section_type) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE section_value = VALUES(section_value)");
$stmt->execute([$postId, $key, $value, $type]);

echo "Header Image set successfully to: $value";
?>