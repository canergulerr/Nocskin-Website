<?php
include 'admin/includes/db.php';

$stmt = $pdo->query("SELECT id, title, url FROM menus WHERE url LIKE '%en-us%' LIMIT 10");
echo "Sample Menu Links with 'en-us':\n";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "- [{$row['id']}] {$row['title']} -> {$row['url']}\n";
}

$stmt2 = $pdo->query("SELECT id, title, url FROM menus WHERE url LIKE '%product.php%' LIMIT 10");
echo "\nSample Menu Links with 'product.php':\n";
while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    echo "- [{$row['id']}] {$row['title']} -> {$row['url']}\n";
}
?>