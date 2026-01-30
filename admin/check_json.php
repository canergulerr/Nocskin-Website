<?php
require_once __DIR__ . '/includes/db.php';

$stmt = $pdo->prepare("SELECT section_value FROM blog_post_sections WHERE post_id = 3 AND section_key = 'section_list'");
$stmt->execute();
$json = $stmt->fetchColumn();

// Print first 500 chars to check Title encoding
echo substr($json, 0, 500);
?>