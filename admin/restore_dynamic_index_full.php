<?php
// Run phase: Restoration V3 (Nowdoc)
$file = 'index.php';
$lines = file($file);
if (!$lines)
    die("Could not read index.php");

$newContent = "";

// 1. Fix Header Imports (Line 0)
$newContent .= "<?php include 'config.php'; include 'includes/wp_shims.php'; ?>\n";

// 2. Keep Lines 1 to 160 (Up to experience-component)
for ($i = 1; $i <= 160; $i++) {
    $newContent .= $lines[$i];
}

// 3. Append DB Connection logic (start of dynamic section)
// Using Nowdoc to avoid variable interpolation
$dynamicBlock = <<<'DYNAMIC_CODE'
                                        <?php
                                        require_once 'admin/includes/db.php';
                                        
                                        // Fetch bestsellers
                                        $stmt = $pdo->query("SELECT * FROM products LIMIT 10");
                                        ?>
                                        <div class="amp_swiper swiper disabled standard" data-slide-count="<?php echo $stmt->rowCount(); ?>">
                                            <div class="swiper-wrapper">
                                            <?php
                                            try {
                                                while ($prod = $stmt->fetch(PDO::FETCH_ASSOC)):
                                                    // Determine image URL
                                                    $pImg = $prod['image'];
                                                    if (!filter_var($pImg, FILTER_VALIDATE_URL)) {
                                                        $pImg = BASE_URL . '/images/' . $pImg;
                                                    }
                                                    // Determine link
                                                    $pLink = 'product.php?id=' . $prod['id'];
                                                    $pName = htmlspecialchars($prod['name']);
                                                    $pPrice = htmlspecialchars($prod['price']);
                                                    ?>
                                                    <div class="swiper-slide">
                                                        <div class="product-grid-item">
                                                            <div class="product">
                                                                <div class="product-tile">
                                                                    <div class="tile-container">
                                                                        <div class="image-container">
                                                                            <a href="<?= $pLink ?>">
                                                                                <img class="tile-image lazy" src="<?= $pImg ?>" alt="<?= $pName ?>">
                                                                            </a>
                                                                        </div>
                                                                        <div class="tile-body">
                                                                            <div class="pdp-link">
                                                                                <a href="<?= $pLink ?>" class="link"><?= $pName ?></a>
                                                                            </div>
                                                                            <?php if (!empty($prod['volume'])): ?>
                                                                                <div class="volume"><?= htmlspecialchars($prod['volume']) ?></div>
                                                                            <?php endif; ?>
                                                                            <div class="price">
                                                                                <span class="value"><?= $pPrice ?></span>
                                                                                <span class="currency-symbol">USD</span>
                                                                            </div>
                                                                            <div class="cta-block">
                                                                                 <a href="<?= $pLink ?>" class="btn btn-outline-dark btn-sm"><?php _e('Add to Bag', 'neat_ordinary'); ?></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endwhile;
                                            } catch (PDOException $e) {
                                                echo "<!-- Error loading products: " . $e->getMessage() . " -->";
                                            }
                                            ?>
                                            </div>
                                            <div class="swiper-scrollbar"></div>
                                        </div>
DYNAMIC_CODE;

$newContent .= $dynamicBlock . "\n";

// 4. Skip Old Static Swiper
// Resume at index 1641 (Line 1642).
for ($i = 1641; $i < count($lines); $i++) {
    $newContent .= $lines[$i];
}

file_put_contents($file, $newContent);
echo "Restored Dynamic index.php V3\n";
?>