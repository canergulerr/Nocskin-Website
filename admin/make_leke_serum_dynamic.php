<?php
// Read from ORIGINAL to ensure clean source
$sourceFile = __DIR__ . '/../ciltbakim/original-leke-karsiti-aydinlatici-serum.php';
$targetFile = __DIR__ . '/../ciltbakim/leke-karsiti-aydinlatici-serum.php';

if (!file_exists($sourceFile))
    die("Original source file not found.");
$content = file_get_contents($sourceFile);

// 1. Inject DB Headers
$headerPHP = <<<PHP
<?php
require_once __DIR__ . '/../admin/includes/db.php';
include __DIR__ . '/../config.php';
include __DIR__ . '/../includes/wp_shims.php';
require_once __DIR__ . '/../includes/banner_helper.php';
require_once __DIR__ . '/../includes/page_content_helper.php';

\$slug = 'leke-karsiti-aydinlatici-gozenek-sikilastirici-serum';
\$stmt = \$pdo->prepare("SELECT * FROM categories WHERE slug = ?");
\$stmt->execute([\$slug]);
\$category = \$stmt->fetch(PDO::FETCH_ASSOC);

if (!\$category) {
    // ID 20 fallback
    \$category = ['id' => 20, 'slug' => \$slug];
}

\$pStmt = \$pdo->prepare("SELECT p.* FROM products p JOIN product_categories pc ON p.id = pc.product_id WHERE pc.category_id = ? ORDER BY p.id DESC");
\$pStmt->execute([\$category['id']]);
\$products = \$pStmt->fetchAll(PDO::FETCH_ASSOC);
?>
PHP;

// Remove BOM if present
$content = preg_replace('/^\xEF\xBB\xBF/', '', $content);
$content = trim($content);

// Remove existing PHP headers (imports)
// Match one or two blocks of PHP at the start
$content = preg_replace('/^<\?php.*?\?>\s*<\?php.*?\?>/s', '', $content);
$content = preg_replace('/^<\?php.*?\?>/s', '', $content);
$content = trim($content);

// Inject full header
$content = $headerPHP . "\n" . $content;

// 2. Identify Grid Section
$gridStartRegex = '/<div class="row product-grid js-product-grid"[^>]*>/';
if (preg_match($gridStartRegex, $content, $matches, PREG_OFFSET_CAPTURE)) {
    $gridStartTag = $matches[0][0];
    $gridStartPos = $matches[0][1] + strlen($gridStartTag);
} else {
    die("Product grid wrapper not found.");
}

$endMarker = '<div class="recently-viewed-section">';
$endPos = strpos($content, $endMarker);
$gridEndPos = strrpos(substr($content, 0, $endPos), '</div>');

// 3. Extract Interrupter
$interrupterStart = strpos($content, '<div class="grid-interrupter-tile"');
if ($interrupterStart !== false) {
    $interrupterEnd = strpos($content, '<!-- CQuotient Activity Tracking', $interrupterStart);
    $interrupterEnd = strrpos(substr($content, 0, $interrupterEnd), '</div>') + 6;
    $interrupterHTML = substr($content, $interrupterStart, $interrupterEnd - $interrupterStart);
} else {
    $interrupterHTML = "";
}

// 4. Extract Template from First Item
$itemStartRegex = '/<div class="product-grid-item[^"]*"/';
if (preg_match($itemStartRegex, $content, $matches, PREG_OFFSET_CAPTURE, $gridStartPos)) {
    $itemStartPos = $matches[0][1];
    $offset = $itemStartPos;
    $openCount = 0;
    $len = strlen($content);
    $templateEnd = 0;

    for ($i = $offset; $i < $len; $i++) {
        if (substr($content, $i, 4) === '<div') {
            $openCount++;
        }
        if (substr($content, $i, 5) === '/div>') {
            $openCount--;
            if ($openCount === 0) {
                $templateEnd = $i + 6;
                break;
            }
        }
    }
    $rawTemplate = substr($content, $itemStartPos, $templateEnd - $itemStartPos);
} else {
    die("Product Grid Item not found.");
}

// 5. Create Dynamic Section
// FIX: Custom escaping for Single Quoted String
$templateSafe = str_replace(
    ['\\', "'"],
    ['\\\\', "\'"],
    $rawTemplate
);

$newGridPHP = <<<PHP
<?php 
\$interrupterHTML = <<<HTML
{$interrupterHTML}
HTML;
?>
<?php if (empty(\$products)): ?>
    <div class="col-12"><p class="text-center">Ürün bulunamadı.</p></div>
<?php else: ?>
    <?php 
    \$interrupterShown = false;
    foreach (\$products as \$index => \$product): 
        if (\$index == 2) { echo \$interrupterHTML; \$interrupterShown = true; }
        
        \$pid = \$product['id'];
        \$name = htmlspecialchars(\$product['name']);
        \$slug = htmlspecialchars(\$product['slug']);
        \$img = BASE_URL . '/assets/images/products/' . htmlspecialchars(\$product['image']);
        \$price = htmlspecialchars(\$product['price']);
        \$vol = htmlspecialchars(\$product['volume'] ?? 'Standard');
        \$link = BASE_URL . '/product.php?slug=' . \$slug;
        
        // Template Replacement
        \$t = '{$templateSafe}';
        
        // 1. Replace PIDs globally (Data attributes, Links, etc.)
        // Static PIDs seen: 769915234404, 100706.
        \$t = str_replace(['769915234404', '100706'], '<?= \$pid ?>', \$t);
        
        // 2. Replace Name globally
        // Handle HTML entities in data attributes
        \$t = str_replace('Multi-Active Delivery Essence', '<?= \$name ?>', \$t);
        
        // 3. Replace Price globally
        // $12.00 USD, "price":"12.00", content="12.00"
        \$t = preg_replace('/\$[0-9]+\.[0-9]+ USD/', '\$<?= \$price ?> USD', \$t); 
        \$t = preg_replace('/"price":"[0-9]+\.[0-9]+"/', '"price":"<?= \$price ?>"', \$t);
        \$t = preg_replace('/content="[0-9]+\.[0-9]+"/', 'content="<?= \$price ?>"', \$t);

        // 4. Replace Image
        // Replace src of the img tag
        \$t = preg_replace('/<img class="tile-image lazy"[^>]+src="[^"]+"/', '<img class="tile-image lazy" src="<?= \$img ?>"', \$t);
        // Remove <source> tags to ensure the img tag is the primary source (responsive images might vary)
        \$t = preg_replace('/<source[^>]+>/', '', \$t);
        // Replace alt and title attributes on the image
        \$t = preg_replace('/alt="[^"]*"/', 'alt="<?= \$name ?>"', \$t);
        \$t = preg_replace('/title="[^"]*"/', 'title="<?= \$name ?>"', \$t);

        // 5. Replace Link HREF
        // Matches href="../../..." or href="/..." containing the slug-like text
        \$t = preg_replace('/href="[^"]*multi-active-delivery-essence[^"]*"/', 'href="<?= \$link ?>"', \$t);
        
        // 6. Fix "New" Tag -> Dynamic? 
        // For now keep "New" or logic? User said "just products". 
        // We can optionally hide it if not new.
        // \$t = str_replace('<div class="bestseller-tag">New</div>', '', \$t); // Optional

        echo \$t;
    ?>
    <?php endforeach; ?>
    <?php if (!\$interrupterShown) echo \$interrupterHTML; ?>
<?php endif; ?>
<!-- Grid Footer Hidden fields -->
<div class="col-12 d-none">
     <input type="hidden" class="permalink" value="<?= BASE_URL ?>/category.php?slug=<?= htmlspecialchars(\$slug) ?>">
</div>
PHP;

// 6. Injection
// Important: $gridStartPos relies on $content from SOURCE file.
$length = $gridEndPos - $gridStartPos;
$newFileContent = substr_replace($content, $newGridPHP, $gridStartPos, $length);

file_put_contents($targetFile, $newFileContent);
echo "Updated leke-karsiti-aydinlatici-serum.php with DB loop (Fixed Escaping).";
?>