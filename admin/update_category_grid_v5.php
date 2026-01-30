<?php
$file = __DIR__ . '/../category.php';
$baseFile = __DIR__ . '/../ciltbakim/original-leke-karsiti-aydinlatici-serum.php';

if (!file_exists($baseFile))
    die("Original base file not found.");
$content = file_get_contents($baseFile);

// 1. Inject Header PHP
$headerPHP = <<<PHP
<?php
require_once __DIR__ . '/admin/includes/db.php';
include __DIR__ . '/config.php';
include __DIR__ . '/includes/wp_shims.php';
require_once __DIR__ . '/includes/banner_helper.php';
require_once __DIR__ . '/includes/page_content_helper.php';

\$slug = \$_GET['slug'] ?? '';
\$stmt = \$pdo->prepare("SELECT * FROM categories WHERE slug = ?");
\$stmt->execute([\$_GET['slug']]);
\$category = \$stmt->fetch(PDO::FETCH_ASSOC);

if (!\$category) {
    \$category = ['name' => 'Kategori Bulunamadı', 'description' => '', 'id' => 0, 'slug' => ''];
}

\$pStmt = \$pdo->prepare("SELECT p.* FROM products p JOIN product_categories pc ON p.id = pc.product_id WHERE pc.category_id = ? ORDER BY p.id DESC");
\$pStmt->execute([\$category['id']]);
\$products = \$pStmt->fetchAll(PDO::FETCH_ASSOC);
?>
PHP;

$content = preg_replace('/<\?php require_once.*?page_content_helper\.php\'; \?>/s', $headerPHP, $content, 1);
$content = str_replace("<?php include dirname(__DIR__) . '/config.php'; ?>", "", $content);

// 2. Extract Interrupter
$interrupterStart = strpos($content, '<div class="grid-interrupter-tile"');
$interrupterEnd = strpos($content, '<!-- CQuotient Activity Tracking', $interrupterStart);
$interrupterEnd = strrpos(substr($content, 0, $interrupterEnd), '</div>') + 6;
$interrupterHTML = substr($content, $interrupterStart, $interrupterEnd - $interrupterStart); // Raw HTML of interrupter

// 3. Extract FIRST Product Item Template
$itemStartMarker = '<div class="product-grid-item col-6 col-lg-4 pb-4">';
$itemStartPos = strpos($content, $itemStartMarker);
$scriptMarker = '<!-- CQuotient Activity Tracking';
$itemEndPos = strpos($content, $scriptMarker, $itemStartPos);
// Backtrack to closing div of item
$itemEndPos = strrpos(substr($content, 0, $itemEndPos), '</div>');
// The extracted block should include the starting div and the closing div
$itemLength = $itemEndPos - $itemStartPos + 6;
$templateHTML = substr($content, $itemStartPos, $itemLength);

// 4. Construct the Loop with Template Replacement
// We will embed the template as a PHP string (Heredoc) and do replacements at runtime?
// No, simpler: Do replacements in THIS script to generate the PHP code.
// We'll escape the templateHTML for use in a PHP string.
// Be careful with single quotes/dollars.
$templateHTMLSafe = addslashes($templateHTML);
$templateHTMLSafe = str_replace('$', '\$', $templateHTMLSafe); // Escape variable interpolation issues?

// Prepare the Code Block
$newContent = <<<PHP
<?php 
\$interrupterHTML = <<<HTML
{$interrupterHTML}
HTML;
?>

<?php if (empty(\$products)): ?>
    <div class="col-12"><p class="text-center">Bu kategoride henüz ürün bulunmamaktadır.</p></div>
<?php else: ?>
    <?php 
    \$interrupterShown = false;
    foreach (\$products as \$index => \$product): 
        if (\$index == 2) { echo \$interrupterHTML; \$interrupterShown = true; }
        
        // Dynamic Data Preparation
        \$pid = \$product['id']; // We'll use this for IDs
        \$name = htmlspecialchars(\$product['name']);
        \$slug = htmlspecialchars(\$product['slug']);
        \$img = BASE_URL . '/assets/images/products/' . htmlspecialchars(\$product['image']);
        \$price = htmlspecialchars(\$product['price']);
        \$vol = htmlspecialchars(\$product['volume'] ?? 'Standard');
        \$link = BASE_URL . '/product.php?slug=' . \$slug;
        
        // TEMPLATE HTML
        // We output the template with PHP injections
        // We can't easily perform many str_replaces on a massive block in runtime efficiently/cleanly 
        // without cluttering the output file.
        // BETTER: We just output the HTML block below, with inline PHP tags where we found the static values.
    ?>
PHP;

// NOW: We take $templateHTML and surgically replace known static strings with PHP tags.
// Static Values in Template (from Original File):
// Name: Multi-Active Delivery Essence
// PID/ID: 769915234404
// Slug/Link: ../../multi-active-delivery-essence-100706  (Need to regex replace HREF)
// Price: $12.00 USD  (Replace number)
// Image: data:image... OR https://... (Replace SRC)

$t = $templateHTML;

// Replace Names
$t = str_replace('Multi-Active Delivery Essence', '<?= $name ?>', $t);

// Replace PIDs (769915234404 was the PID in original view)
// Also "100706" appeared in links.
// Let's replace both with PID just in case, or keep them distinct? 
// Our DB "id" (1, 5) might be too short for some JS regex? Let's hope not.
$t = str_replace('769915234404', '<?= $pid ?>', $t);
$t = str_replace('100706', '<?= $pid ?>', $t);

// Replace Links
// href="../../multi-active-delivery-essence-100706"
// Regex replace href to product page
$t = preg_replace('/href="\.\.\/\.\.\/[^"]+"/', 'href="<?= $link ?>"', $t);

// Replace Price
// $12.00 USD
// Search for $12.00 or similar
// $12.00
$t = preg_replace('/\$[0-9]+\.[0-9]+ USD/', '$<?= $price ?> USD', $t);
$t = preg_replace('/content="[0-9]+\.[0-9]+"/', 'content="<?= $price ?>"', $t); // meta content

// Replace Image
// src="data:image..." or src="https..."
// The original had a `picture` tag with `source` sets.
// We should replace the `img` src and maybe clear the `source` tags or replace them too?
// For simplicity and "Strict" design, we should try to preserve `picture`, but we only have 1 image.
// Let's replace `src` of `img`.
$t = preg_replace('/src="[^"]+"/', 'src="<?= $img ?>"', $t);
// We should probably remove the `source` tags to prevent them from overriding our img src if they point to static assets
$t = preg_replace('/<source[^>]+>/', '', $t); // Remove static sources so the IMG tag works

// Replace Volume ??
// "100ml" appeared in select options.
$t = str_replace('100ml', '<?= $vol ?>', $t);
// Also "Standard"
$t = str_replace('Standard', '<?= $vol ?>', $t);


// Append result to newContent
$newContent .= $t;

$newContent .= <<<PHP
    <?php endforeach; ?>
    <?php if (!\$interrupterShown) echo \$interrupterHTML; ?>
<?php endif; ?>
<!-- Grid Footer -->
<div class="col-12 grid-footer js-grid-footer">
     <input type="hidden" class="permalink" value="<?= BASE_URL ?>/category.php?slug=<?= htmlspecialchars(\$slug) ?>">
     <input type="hidden" class="category-id" value="<?= htmlspecialchars(\$category['slug']) ?>">
</div>
PHP;

// Find insertion point
$startMarker = '<div class="row product-grid js-product-grid"';
$startPos = strpos($content, $startMarker);
$tagEndPos = strpos($content, '>', $startPos);
$contentStart = $tagEndPos + 1;
$endMarker = '<div class="recently-viewed-section">';
$endMarkerPos = strpos($content, $endMarker);
$lastDiv = strrpos(substr($content, 0, $endMarkerPos), '</div>');
$secondLastDiv = strrpos(substr($content, 0, $lastDiv), '</div>');
$contentEnd = $secondLastDiv;

$newFileContent = substr_replace($content, $newContent, $contentStart, $contentEnd - $contentStart);

if (file_put_contents($file, $newFileContent)) {
    echo "Successfully updated category.php (v5) with Hydrated Template.";
} else {
    echo "Failed to update category.php";
}
?>