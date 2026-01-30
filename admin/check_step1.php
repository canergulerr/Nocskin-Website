<?php
require_once 'config.php';
require_once 'admin/includes/db.php';

$stmt = $pdo->prepare("SELECT section_value FROM blog_post_sections WHERE section_key = 'step1_text'");
$stmt->execute();
echo $stmt->fetchColumn();
?>