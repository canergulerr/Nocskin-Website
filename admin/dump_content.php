<?php
require_once 'includes/db.php';

$stmt = $pdo->prepare("SELECT content FROM blog_posts WHERE slug = 'rejim-rehberi'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    echo $row['content'];
} else {
    echo "No content found.";
}
?>