<?php
require_once 'c:/xampp/htdocs/admin/includes/db.php';
$stmt = $pdo->prepare('SELECT * FROM page_sections WHERE title LIKE "%Neden Ä°htiyacÄ±nÄ±z Var%"');
$stmt->execute();
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
