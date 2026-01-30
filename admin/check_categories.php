<?php
require_once 'includes/db.php';
$stmt = $pdo->query("SELECT * FROM categories WHERE name LIKE '%Gozenek%' OR slug LIKE '%gozenek%'");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
