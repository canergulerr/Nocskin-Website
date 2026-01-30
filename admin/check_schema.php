<?php
require_once __DIR__ . '/includes/db.php';
$s = $pdo->query('SHOW CREATE TABLE blog_post_sections');
print_r($s->fetchColumn(1));
?>