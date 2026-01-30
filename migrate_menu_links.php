<?php
include 'admin/includes/db.php';

echo "Migrating Menu Links...\n";

// 1. Migrate Categories
// Example: /en-us/category/best-sellers -> category.php?slug=best-sellers
$stmt = $pdo->query("SELECT id, url FROM menus WHERE url LIKE '%/category/%'");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $oldUrl = $row['url'];
    // Extract slug
    if (preg_match('/\/category\/(.+)$/', $oldUrl, $matches)) {
        $slug = $matches[1];
        // Remove trailing query params or hashes if any (simple approach)
        $slug = explode('#', $slug)[0];
        $slug = explode('?', $slug)[0];

        $newUrl = "category.php?slug=" . $slug;

        $update = $pdo->prepare("UPDATE menus SET url = ? WHERE id = ?");
        $update->execute([$newUrl, $row['id']]);
        echo "Updated [{$row['id']}]: $oldUrl -> $newUrl\n";
    }
}

// 2. Migrate Products (if any in menu)
// Example: /en-us/glycolic-acid...php -> product.php?slug=glycolic-acid...
$stmt2 = $pdo->query("SELECT id, url FROM menus WHERE url LIKE '%/en-us/%' AND url NOT LIKE '%/category/%'");
while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $oldUrl = $row['url'];
    // Check if it ends in .php
    if (preg_match('/\/en-us\/(.+)\.php$/', $oldUrl, $matches)) {
        $slug = $matches[1];
        $newUrl = "product.php?slug=" . $slug;

        $update = $pdo->prepare("UPDATE menus SET url = ? WHERE id = ?");
        $update->execute([$newUrl, $row['id']]);
        echo "Updated [{$row['id']}]: $oldUrl -> $newUrl\n";
    }
}

echo "Done.\n";
?>