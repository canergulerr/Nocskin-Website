<?php
require_once 'includes/db.php';

$sourceDir = dirname(__DIR__) . '/en-us/category/skincare';
$destDir = dirname(__DIR__) . '/ciltbakim';

if (!is_dir($sourceDir)) {
    die("Source directory not found: $sourceDir\n");
}
if (!is_dir($destDir)) {
    mkdir($destDir, 0755, true);
}

// 1. Move Files
$files = scandir($sourceDir);
$filesMoved = 0;

foreach ($files as $file) {
    if ($file === '.' || $file === '..')
        continue;

    $sourcePath = $sourceDir . '/' . $file;
    $destPath = $destDir . '/' . $file;

    if (is_dir($sourcePath)) {
        // Handle subdirectory move (recursive or just move the folder)
        // For simplicity, let's move the directory entirely
        // But check if dest exists
        if (file_exists($destPath)) {
            echo "Skipping Directory (already exists): $file\n";
        } else {
            rename($sourcePath, $destPath);
            echo "Moved Directory: $file\n";
        }
    } else {
        // It's a file
        if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
            $content = file_get_contents($sourcePath);

            // Adjust include paths
            // Previous: dirname(__DIR__, 3)
            // New: dirname(__DIR__)
            $newContent = str_replace(
                "dirname(__DIR__, 3) . '/config.php'",
                "dirname(__DIR__) . '/config.php'",
                $content
            );

            // Also fix other potential relative paths if any (e.g., ../../assets)
            // But we standardized on BASE_URL, so checking for legacy relative paths
            $newContent = str_replace(
                "../../../../",
                "../",
                $newContent
            );

            file_put_contents($destPath, $newContent);
            unlink($sourcePath); // Remove original after successful write
            echo "Moved and Updated File: $file\n";
            $filesMoved++;
        } else {
            rename($sourcePath, $destPath);
            echo "Moved Asset/File: $file\n";
        }
    }
}

echo "Total Files Moved: $filesMoved\n";

// 2. Update Database Menus
echo "Updating Database Menu Links...\n";

// Original URL pattern part to search
$searchPath = '/en-us/category/skincare/';
$replacePath = '/ciltbakim/';

// Fetch all menus to inspect first (safer)
$stmt = $pdo->query("SELECT id, link_url FROM menus WHERE link_url LIKE '%$searchPath%'");
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

$updatedLinks = 0;
foreach ($menus as $menu) {
    $newUrl = str_replace($searchPath, $replacePath, $menu['link_url']);

    $updateStmt = $pdo->prepare("UPDATE menus SET link_url = ? WHERE id = ?");
    $updateStmt->execute([$newUrl, $menu['id']]);

    echo "Updated Menu ID {$menu['id']}: {$menu['link_url']} -> $newUrl\n";
    $updatedLinks++;
}

echo "Total DB Links Updated: $updatedLinks\n";
?>