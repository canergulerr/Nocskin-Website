<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include dirname(__DIR__) . '/config.php';
require_once 'includes/db.php';

// BASE_PATH is defined in config.php, typically C:\xampp\htdocs\noc_new
$sourceDir = dirname(__DIR__) . '/en-us';
$files = glob($sourceDir . '/*.php');

$isCli = (php_sapi_name() === 'cli');
$dryRun = true;
if (isset($_GET['run'])) {
    $dryRun = false;
}
if ($isCli && isset($argv[1]) && $argv[1] == 'run') {
    $dryRun = false;
}

echo "<h1>Product Migration Tool</h1>";
if ($dryRun) {
    echo "<div style='background: #fff3cd; padding: 10px; border: 1px solid #ffeeba;'>DRY RUN MODE. Query string <code>?run=1</code> to execute inserts.</div>";
} else {
    echo "<div style='background: #d4edda; padding: 10px; border: 1px solid #c3e6cb;'>EXECUTION MODE. Writing to database...</div>";
}

echo "<table border='1' cellpadding='5' style='border-collapse:collapse; width:100%;'>";
echo "<thead><tr><th>File</th><th>Name</th><th>Slug</th><th>Price</th><th>Category</th><th>Status</th></tr></thead>";
echo "<tbody>";

$count = 0;
foreach ($files as $file) {
    $basename = basename($file);
    if ($basename === 'index.php' || strpos($basename, 'category') !== false) {
        continue;
    }

    $content = file_get_contents($file);

    // 1. Extract Name
    $name = '';
    if (preg_match('/<h1 class="product-name">.*?<span class="sr-only">.*?<\/span>(.*?)<\/h1>/s', $content, $matches)) {
        $name = trim($matches[1]);
    } elseif (preg_match('/<h1 class="product-name">(.*?)<\/h1>/s', $content, $matches)) {
        $name = trim(strip_tags($matches[1]));
    }

    // Fallback to Title tag
    if (empty($name) && preg_match('/<title>\s*(.*?)\s*<\/title>/s', $content, $matches)) {
        $name = trim($matches[1]);
        $name = str_replace('| Noc', '', $name);
    }

    if (empty($name))
        continue;

    // 2. Extract Slug
    $slug = str_replace('.php', '', $basename);

    // 3. Extract Price
    $price = 0.00;
    if (preg_match('/<span class="value"[^>]*>\s*([^\d]*)([\d\.]+)\s*<\/span>/s', $content, $matches)) {
        $price = floatval($matches[2]);
    }

    // 4. Extract Image
    $image = '';
    if (preg_match('/data-full-src="(.*?)"/s', $content, $matches)) {
        $image = $matches[1];
    }

    // 5. Extract Description
    $description = '';
    if (preg_match('/<div class="product-description-text">(.*?)<\/div>/s', $content, $matches)) {
        $description = trim($matches[1]);
    }
    if (empty($description) && preg_match('/<div class="content-asset">(.*?)<\/div>/s', $content, $matches)) {
        $description = trim($matches[1]);
    }
    if (empty($description)) {
        $description = "Imported from $basename. Please update.";
    }

    // 6. Extract Category (Breadcrumb)
    $categoryName = '';
    $categorySlug = '';
    // Look for breadcrumb list items. Often: <a href="category/skincare">Skincare</a>
    // Adjust regex to be flexible with exact path
    if (preg_match('/<a href="[^"]*category\/([^"]+)"[^>]*>([^<]+)<\/a>/', $content, $catMatch)) {
        $categorySlug = trim($catMatch[1]);
        $categoryName = trim($catMatch[2]);
    }

    // DB Insert
    $status = 'Skipped';
    if (!$dryRun) {
        try {
            // INSERT Product
            $stmt = $pdo->prepare("INSERT INTO products (name, slug, price, image, description, status) VALUES (?, ?, ?, ?, ?, 1) ON DUPLICATE KEY UPDATE name=VALUES(name), price=VALUES(price), image=VALUES(image), description=VALUES(description)");
            $stmt->execute([$name, $slug, $price, $image, $description]);
            $productId = $pdo->lastInsertId();
            if ($productId == 0) {
                $stmtId = $pdo->prepare("SELECT id FROM products WHERE slug = ?");
                $stmtId->execute([$slug]);
                $productId = $stmtId->fetchColumn();
            }

            // INSERT Image
            if (!empty($image) && $productId) {
                $stmtImg = $pdo->prepare("INSERT IGNORE INTO product_images (product_id, image_path, is_primary) VALUES (?, ?, 1)");
                $stmtImg->execute([$productId, $image]);
            }

            // INSERT Category and Link
            if ($categoryName) {
                // Check Category
                $stmtCatCheck = $pdo->prepare("SELECT id FROM categories WHERE slug = ?");
                $stmtCatCheck->execute([$categorySlug]);
                $catId = $stmtCatCheck->fetchColumn();

                if (!$catId) {
                    // Create Category
                    $stmtCatIns = $pdo->prepare("INSERT INTO categories (name, slug, parent_id, status) VALUES (?, ?, 0, 1)");
                    $stmtCatIns->execute([$categoryName, $categorySlug]);
                    $catId = $pdo->lastInsertId();
                }

                // Link Product to Category
                if ($productId && $catId) {
                    $stmtLink = $pdo->prepare("INSERT IGNORE INTO product_categories (product_id, category_id) VALUES (?, ?)");
                    $stmtLink->execute([$productId, $catId]);
                }
            }

            $status = 'Imported/Updated';
        } catch (PDOException $e) {
            $status = 'Error: ' . $e->getMessage();
        }
    }

    echo "<tr>";
    echo "<td>$basename</td>";
    echo "<td>$name</td>";
    echo "<td>$slug</td>";
    echo "<td>$price</td>";
    echo "<td>$categoryName ($categorySlug)</td>"; // Show found Category
    echo "<td>$status</td>";
    echo "</tr>";

    $count++;
}
echo "</tbody></table>";
echo "<p>Total Processed: $count</p>";

if ($dryRun) {
    echo "<br><a href='?run=1' class='button' style='display:inline-block; padding:10px 20px; background:blue; color:white; text-decoration:none;'>RUN MIGRATION NOW</a>";
    echo "<p>Or run via CLI: <code>php admin/migrate_products.php run</code></p>";
}
?>