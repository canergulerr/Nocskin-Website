<?php
require_once __DIR__ . '/includes/db.php';

$stmt = $pdo->prepare("SELECT content FROM blog_posts WHERE id = 3");
$stmt->execute();
$content = $stmt->fetchColumn();

echo "Content Length: " . strlen($content) . "\n";
echo "Preview: " . substr($content, 0, 200) . "\n";
?>