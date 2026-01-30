<?php
$file = __DIR__ . '/../category.php';
$content = file_get_contents($file);

// 1. Find the Start: <div class="row product-grid js-product-grid" ...>
$startMarker = '<div class="row product-grid js-product-grid"';
$startPos = strpos($content, $startMarker);

if ($startPos === false) {
    die("Start marker not found.");
}

// Find the first > after start marker to locate the end of the opening tag
$tagEndPos = strpos($content, '>', $startPos);
$contentStart = $tagEndPos + 1;

// 2. Find the End: We need the closing </div> for this row.
// Since there are nested divs, we need to balance them.
// Alternatively, we know the line numbers roughly, but string matching is safer.
// We know the grid is followed by `</div>` then a `<div class="recently-viewed-section">` (Line 4277).
// Let's look for `<div class="recently-viewed-section">` and find the `</div>` before it.
$endMarker = '<div class="recently-viewed-section">';
$endMarkerPos = strpos($content, $endMarker);

if ($endMarkerPos === false) {
    die("End marker not found.");
}

// Search backwards from endMarker to find the closing </div> of the product grid wrapper(?)
// The structure is:
// <div class="row product-grid ..."> (Grid Row)
//    ... content ...
//    <div class="col-12 grid-footer ...">...</div>
// </div> <!-- Grid Row Ends -->
// </div> <!-- Container Ends? No, let's check -->
// <div class="recently-viewed-section">

// Let's verify the context.
// Line 4268: </div> (Closes row)
// Line 4273: </div> (Closes main container?)
// Line 4277: <div class="recently-viewed-section">

// So we want the content UP TO the `</div>` that is before the `</div>` that is before `<div class="recently-viewed-section">`.
// That sounds fragile.

// Alternative: We replace specific known start and end blocks if we can't parse HTML.
// But we want to be safe.

// Let's try to identify the "Grid Footer" and use that as an anchor if we want to keep it?
// Or just replace everything inside the row.

// Let's iterate and count divs? No, regex?
// Let's use the explicit markers relevant to the file structure we saw.
// We saw `<!-- CQuotient Activity Tracking` as the first thing inside.
// We saw the grid footer at the end.

// Let's replace from $contentStart to the last `</div>` before the `</div>` that precedes `<div class="recently-viewed-section">`.

// Searching backwards from $endMarkerPos:
$lastDiv = strrpos(substr($content, 0, $endMarkerPos), '</div>'); // Closes container
$secondLastDiv = strrpos(substr($content, 0, $lastDiv), '</div>'); // Closes row
// We want to replace everything up to $secondLastDiv (exclusive).
$contentEnd = $secondLastDiv;

// The New Content (The Loop)
$newContent = <<<PHP
<?php if (empty(\$products)): ?>
    <div class="col-12">
        <p class="text-center">Bu kategoride henüz ürün bulunmamaktadır.</p>
    </div>
<?php else: ?>
    <?php foreach (\$products as \$product): ?>
    <div class="product-grid-item col-6 col-lg-4 pb-4">
        <div class="product" data-pid="<?= \$product['id'] ?>" data-available="true">
            <div class="product-tile product-detail js-product-tile" data-pid="<?= \$product['id'] ?>">
                <div class="tile-container">
                    <div class="image-container">
                         <?php if (!empty(\$product['price'])): // Example logic for badges ?>
                            <!-- <div class="bestseller-tag">New</div> -->
                         <?php endif; ?>
                        
                        <a class="product-link" href="<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars(\$product['slug']) ?>">
                            <picture>
                                <img class="tile-image lazy" src="<?= BASE_URL ?>/assets/images/products/<?= htmlspecialchars(\$product['image']) ?>" alt="<?= htmlspecialchars(\$product['name']) ?>" title="<?= htmlspecialchars(\$product['name']) ?>" style="width: 100%; height: auto;">
                            </picture>
                        </a>

                        <button class="quickview js-quickview hidden-md-down btn btn-primary btn-block" 
                            data-toggle="modal" 
                            data-target="#quickViewModal" 
                            title="Quick View">
                            <span class="quickview-btn-icon"></span>
                            <span class="quickview-btn">Hızlı Bakış</span>
                        </button>
                    </div>

                    <div class="tile-body">
                         <!-- AM/PM Icons if we had that data -->
                         <div class="am-pm"></div>

                        <h2 class="pdp-link">
                            <a class="link product-link" href="<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars(\$product['slug']) ?>">
                                <?= htmlspecialchars(\$product['name']) ?>
                            </a>
                        </h2>
                    </div>

                    <div class="tile-body-footer">
                        <div class="ratings">
                           <!-- Placeholder for ratings -->
                        </div>
                        <h3 class="title-descriptor">
                            <div class="title-descriptor-value"><?= htmlspecialchars(\$product['volume'] ?? '') ?></div>
                        </h3>
                         <div class="prices">
                            <div class="price">
                                <span class="product-prices">
                                    <span class="sales">
                                        <span class="value">
                                            $<?= htmlspecialchars(\$product['price']) ?>
                                        </span>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
<!-- Grid Footer / Pagination Placeholder -->
<div class="col-12 grid-footer js-grid-footer"></div>
PHP;

// Perform Replacement
$newFileContent = substr_replace($content, $newContent, $contentStart, $contentEnd - $contentStart);

// Write Back
if (file_put_contents($file, $newFileContent)) {
    echo "Successfully updated category.php product grid.";
} else {
    echo "Failed to write to category.php";
}
?>