<?php
require_once __DIR__ . '/includes/db.php';
$identifier = 'leke-karsiti-aydinlatici-serum';
$stmt = $pdo->prepare("SELECT id, page_identifier, title, status FROM page_sections WHERE page_identifier = ?");
$stmt->execute([$identifier]);
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($res);
?>