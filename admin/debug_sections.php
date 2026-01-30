<?php
require_once __DIR__ . '/includes/db.php';
require_once dirname(__DIR__) . '/config.php';

$stmt = $pdo->prepare("SELECT id FROM blog_posts WHERE slug = 'katmanlama-kilavuzu'");
$stmt->execute();
$post = $stmt->fetch();

if ($post) {
    echo "Post ID: " . $post['id'] . "<br>";
    $stmtSec = $pdo->prepare("SELECT section_key, length(section_value) as len, left(section_value, 50) as val FROM blog_post_sections WHERE post_id = ?");
    $stmtSec->execute([$post['id']]);
    $rows = $stmtSec->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($rows);
    echo "</pre>";
} else {
    echo "Post not found";
}
?>