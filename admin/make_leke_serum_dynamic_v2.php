<?php
// Read from ORIGINAL to ensure clean source
$sourceFile = __DIR__ . '/../ciltbakim/original-leke-karsiti-aydinlatici-serum.php';
$targetFile = __DIR__ . '/../ciltbakim/leke-karsiti-aydinlatici-serum.php';

if (!file_exists($sourceFile))
    die("Original source file not found.");
$content = file_get_contents($sourceFile);

// Headers
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
    \$category = ['id' => 20, 'slug' => \$slug];
}

\$pStmt = \$pdo->prepare("SELECT p.* FROM products p JOIN product_categories pc ON p.id = pc.product_id WHERE pc.category_id = ? ORDER BY p.id DESC");
\$pStmt->execute([\$category['id']]);
\$products = \$pStmt->fetchAll(PDO::FETCH_ASSOC);

// Dynamic Grid Logic based on Users Design
// 1 Product -> repeat(3, 1fr) (Product 1fr, Content 2fr)
// 2+ Products -> repeat(4, 1fr) (Product 1fr, Product 1fr, Content 2fr)
\$gridTemplateColumns = (count(\$products) == 1) ? 'repeat(3, 1fr)' : 'repeat(4, 1fr)';
?>
<!-- Inject CSS for Banner Width and Hiding Elements -->
<style>
    /* Force Full Width for Banner even inside container */
    .amplience_category_hero { 
        width: 100vw !important; 
        position: relative !important; 
        left: 50% !important; 
        right: 50% !important; 
        margin-left: -50vw !important; 
        margin-right: -50vw !important; 
        max-width: 100vw !important;
        padding: 0 !important;
    }
    .amplience_category_hero .content-wrapper { 
        max-width: 100% !important; 
        padding: 0 !important; 
        margin: 0 !important; 
        
    }
    .amplience_category_hero .hero_banner {
        width: 100%;
        height: auto;
    }
    
    /* Hide specific elements as requested */
    .filter-bar, .result-container, .filter-sort-container, .refinement-bar, .refinement-group-header, .refinements { display: none !important; }
    #regimen-step { display: none !important; } 
    .sort-col { display: none !important; }

    /* LAYOUT FIXES - CSS GRID IMPLEMENTATION */
    /* Force main grid container to be full width */
    .search-results_items-side {
        width: 100% !important;
        max-width: 100% !important;
        flex: 0 0 100% !important;
        padding: 0 !important;
    }

    /* Dynamic Grid Layout */
    [data-brand=theordinary] .product-grid {
        display: grid !important;
        grid-template-columns: <?= \$gridTemplateColumns ?> !important;
        gap: 15px;
    }
    
    /* Ensure Interrupter spans 2 columns to satisfy 2/3 or 2/4 ratio implication */
    .grid-interrupter-tile {
        grid-column: span 2;
        min-width: 100%;
        display: flex;
        flex-direction: column;
    }
    
    /* Ensure Product Tiles fit */
    .product-grid-item {
        width: 100%;
        padding-left: 0;
        padding-right: 0;
    }
</style>
PHP;

// Clean Headers
$content = preg_replace('/^\xEF\xBB\xBF/', '', $content);
$content = trim($content);
$content = preg_replace('/^<\?php.*?\?>\s*<\?php.*?\?>/s', '', $content);
$content = preg_replace('/^<\?php.*?\?>/s', '', $content);
$content = trim($content);
$content = $headerPHP . "\n" . $content;

// REMOVE FILTERS SECTIONS (Cleanup code)
// REMOVE FILTERS SECTIONS (Cleanup code)
// Safer Regex to verify it works without destroying layout markers
$content = preg_replace('/<div class="filter-sort-container\s*">.*?<div class="refinement-bar.*?<\/div>\s*<\/div>\s*<\/div>/s', '', $content);
$content = preg_replace('/<div class="filter-sort-container\s*">.*?class="refinements plp-search-refinements">.*?<\/div>\s*<\/div>\s*<\/div>\s*<\/div>/s', '', $content);
// Fallback cleaner for separate parts if nested removal failed
$content = preg_replace('/<div class="filter-sort-container.*?>.*?<\/div>\s*<\/div>\s*<\/div>/s', '', $content);
$content = preg_replace('/<div class="refinement-bar.*?>.*?<\/div>\s*<\/div>/s', '', $content);


$content = preg_replace('/<ul class="values content list-group ">.*?<\/ul>/s', '', $content);
$content = preg_replace('/<div class="result-container".*?<\/div>\s*<\/div>/s', '', $content);
$content = preg_replace('/<div class="sort-col".*?<\/div>/s', '', $content);

// CLEANUP: Remove local analytics/tracking scripts that cause 404s
$content = preg_replace('/<script[^>]*src="[^"]*29849\.js"[^>]*>.*?<\/script>/s', '', $content);
$content = preg_replace('/<script[^>]*src="[^"]*sms_aff_clicktrack-deciem\.js"[^>]*>.*?<\/script>/s', '', $content);
$content = preg_replace('/<script[^>]*src="[^"]*dwanalytics[^"]*"[^>]*>.*?<\/script>/s', '', $content);
$content = preg_replace('/<script[^>]*src="[^"]*dwac[^"]*"[^>]*>.*?<\/script>/s', '', $content);
$content = preg_replace('/<script[^>]*src="[^"]*gretel\.min\.js"[^>]*>.*?<\/script>/s', '', $content);


// Identify Grid
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

// Interrupter Logic
$interrupterStart = strpos($content, '<div class="grid-interrupter-tile"');
if ($interrupterStart !== false) {
    $interrupterEnd = strpos($content, '<!-- CQuotient Activity Tracking', $interrupterStart);
    $interrupterEnd = strrpos(substr($content, 0, $interrupterEnd), '</div>') + 6;
    $interrupterHTML = substr($content, $interrupterStart, $interrupterEnd - $interrupterStart);
    $interrupterHTML = preg_replace('/src="[^"]*essence-vs-toner-blog-gridbreaker.jpg"/', 'src="https://theordinary.com/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dw7ece4d9c/theordinary/gridbreakers/essence-vs-toner-blog-gridbreaker.jpg"', $interrupterHTML);
    $interrupterHTML = str_replace('<?= BASE_URL ?>', '', $interrupterHTML);
} else {
    $interrupterHTML = "";
}

// Extract Template
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

// PRE-COMPILE TEMPLATE
$processedTpl = $rawTemplate;
$processedTpl = str_replace('769915234404', '<?= $product[\'id\'] ?>', $processedTpl);
$processedTpl = str_replace('100706', '<?= $product[\'id\'] ?>', $processedTpl);
$processedTpl = preg_replace('/>\s*Multi-Active\s+Delivery\s+Essence\s*<\/a>/s', '><?= htmlspecialchars($product[\'name\']) ?></a>', $processedTpl);
$processedTpl = str_replace('class="product-grid-item"', 'class="product-grid-item pb-4"', $processedTpl);
$processedTpl = preg_replace('/\$[0-9]+\.[0-9]+ USD/', '$<?= htmlspecialchars($product[\'price\']) ?> USD', $processedTpl);
$processedTpl = preg_replace('/"price":"[0-9]+\.[0-9]+"/', '"price":"<?= htmlspecialchars($product[\'price\']) ?>"', $processedTpl);
$processedTpl = preg_replace('/content="[0-9]+\.[0-9]+"/', 'content="<?= htmlspecialchars($product[\'price\']) ?>"', $processedTpl);
$processedTpl = preg_replace('/<source[^>]+>/', '', $processedTpl);
$processedTpl = preg_replace(
    '/<img class="tile-image lazy\s?"[^>]+src="[^"]+"[^>]*>/s',
    '<img class="tile-image lazy" src="<?= (strpos($product[\'image\'], \'http\') === 0) ? $product[\'image\'] : BASE_URL . \'/assets/images/products/\' . $product[\'image\'] ?>" alt="<?= htmlspecialchars($product[\'name\']) ?>" title="<?= htmlspecialchars($product[\'name\']) ?>">',
    $processedTpl
);
$processedTpl = preg_replace('/alt="[^"]*"/', 'alt="<?= htmlspecialchars($product[\'name\']) ?>"', $processedTpl);
$processedTpl = preg_replace('/title="[^"]*"/', 'title="<?= htmlspecialchars($product[\'name\']) ?>"', $processedTpl);
$processedTpl = preg_replace('/href="[^"]*multi-active-delivery-essence[^"]*"/', 'href="<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars($product[\'slug\']) ?>"', $processedTpl);

// Build Loop Block using NOWDOC
// START BLOCK
$startBlock = <<<'PHP'
<?php 
$interrupterHTML = <<<HTML
PHP;

// MIDDLE BLOCK
$middleBlock = "\n" . $interrupterHTML . "\nHTML;\n?>\n";

// LOOP START
$loopStart = <<<'PHP'
<?php if (empty($products)): ?>
    <div class="col-12" style="grid-column: 1 / -1;"><p class="text-center">Ürün bulunamadı.</p></div>
    <div class="pb-4 grid-interrupter-tile-wrapper" style="grid-column: span 2;">
         <?= $interrupterHTML ?>
     </div>
<?php else: ?>
    <?php 
    $insertedInterrupter = false;
    foreach ($products as $index => $product): 
        // Logic:
        // Case 1 Item: Insert at Index 0. (P1, Content)
        // Case >= 2 Items: Insert at Index 1. (P1, P2, Content)
        
        $shouldInsert = false;
        if (count($products) == 1 && $index == 0) $shouldInsert = true;
        if (count($products) >= 2 && $index == 1) $shouldInsert = true;
    ?>
PHP;

// LOOP END
$loopEnd = <<<'PHP'

    
    <?php if ($shouldInsert): ?>
         <div class="<?= $colClass ?> pb-4">
             <?= $interrupterHTML ?>
         </div>
         <?php $insertedInterrupter = true; ?>
    <?php endif; ?>

    <?php endforeach; ?>
    
    <?php if (!$insertedInterrupter): ?>
         <div class="<?= $colClass ?> pb-4">
             <?= $interrupterHTML ?>
         </div>
    <?php endif; ?>
<?php endif; ?>
<!-- Grid Footer -->
<div class="col-12 d-none">
     <input type="hidden" class="permalink" value="<?= BASE_URL ?>/category.php?slug=<?= htmlspecialchars($slug) ?>">
</div>
PHP;

// Inject Template variable to replace $processedTpl placeholder
// Construct Grid Logic
$newGridPHP = $startBlock . $middleBlock . $loopStart . "\n" .
    $processedTpl . "\n" .
    <<<'PHP'
    <?php if ($shouldInsert): ?>
         <div class="pb-4 grid-interrupter-tile-wrapper" style="grid-column: span 2;">
             <?= $interrupterHTML ?>
         </div>
         <?php $insertedInterrupter = true; ?>
    <?php endif; ?>
<?php endforeach; ?>
<?php if (!$insertedInterrupter): ?>
     <div class="pb-4 grid-interrupter-tile-wrapper" style="grid-column: span 2;">
         <?= $interrupterHTML ?>
     </div>
<?php endif; ?>
<?php endif; ?>
<!-- Grid Footer -->
<div class="col-12 d-none">
     <input type="hidden" class="permalink" value="<?= BASE_URL ?>/category.php?slug=<?= htmlspecialchars($slug) ?>">
</div>
PHP;

// Injection
$length = $gridEndPos - $gridStartPos;
$newFileContent = substr_replace($content, $newGridPHP, $gridStartPos, $length);

file_put_contents($targetFile, $newFileContent);
echo "Updated leke-karsiti-aydinlatici-serum.php with Flexible Layout Logic.";
?>