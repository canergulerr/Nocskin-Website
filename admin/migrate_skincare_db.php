<?php
require_once 'includes/db.php';

// 2. Update Database Menus
echo "Updating Database Menu Links (Column: url)...\n";

// Original URL pattern part to search
$searchPath = '/en-us/category/skincare/';
$replacePath = '/ciltbakim/';

// Fetch all menus to inspect first (safer)
$stmt = $pdo->query("SELECT id, url FROM menus WHERE url LIKE '%$searchPath%'");
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

$updatedLinks = 0;
foreach ($menus as $menu) {
    if (empty($menu['url']))
        continue;

    $newUrl = str_replace($searchPath, $replacePath, $menu['url']);

    // Ensure we don't double replace if ran multiple times (though LIKE clause prevents it)
    $updateStmt = $pdo->prepare("UPDATE menus SET url = ? WHERE id = ?");
    $updateStmt->execute([$newUrl, $menu['id']]);

    echo "Updated Menu ID {$menu['id']}: {$menu['url']} -> $newUrl\n";
    $updatedLinks++;
}

echo "Total DB Links Updated: $updatedLinks\n";
?>