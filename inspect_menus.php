<?php
require 'admin/includes/db.php';
$stmt = $pdo->query("SELECT id, title, parent_id, location, position FROM menus WHERE location LIKE 'footer_%' ORDER BY location, position");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
