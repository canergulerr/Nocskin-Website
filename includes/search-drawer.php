<div class="site-search search-drawer">
    <form role="search" class="search-form" action="<?= BASE_URL ?>/search.php" method="get" name="simpleSearch">
        <div class="block_search-field">
            <button class="close-button icon-close btn-close-search js-close-search" aria-label="Clear search keywords"
                title="Clear search keywords"></button>
            <button type="button"
                onclick="const val = this.parentNode.querySelector('input[name=q]').value; if(val) window.location.href='<?= BASE_URL ?>/search.php?q=' + encodeURIComponent(val);"
                class="icon-search search-submit" aria-label="Enter Keyword or Item No."
                title="Enter Keyword or Item No."></button>
            <input class="form-control search-field js-search-field" type="text" name="q" value="" placeholder="search"
                role="combobox" aria-haspopup="listbox" aria-owns="search-results" aria-expanded="false"
                aria-autocomplete="list" aria-activedescendant="" aria-controls="search-results"
                aria-label="Enter Keyword or Item No." autocomplete="off">
        </div>
        <div class="block_search-term-result-divider"></div>
        <div class="no-query-content">
            <?php
            // Fetch products from 'Arama Önerileri' category
            $recommended = [];
            try {
                // Find category ID
                $stmtCat = $pdo->prepare("SELECT id FROM categories WHERE name = 'Arama Önerileri' LIMIT 1");
                $stmtCat->execute();
                $cat = $stmtCat->fetch(PDO::FETCH_ASSOC);

                if ($cat) {
                    $stmtRec = $pdo->prepare("
                        SELECT p.* 
                        FROM products p 
                        JOIN product_categories pc ON p.id = pc.product_id 
                        WHERE pc.category_id = ? AND p.status = '1' 
                        ORDER BY p.id DESC 
                        LIMIT 4
                    ");
                    $stmtRec->execute([$cat['id']]);
                    $recommended = $stmtRec->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    // Fallback to random if category doesn't exist yet
                    $stmtRec = $pdo->query("SELECT * FROM products WHERE status = '1' ORDER BY RAND() LIMIT 4");
                    $recommended = $stmtRec->fetchAll(PDO::FETCH_ASSOC);
                }
            } catch (Exception $e) { /* Ignore */
            }
            ?>
            <?php if (!empty($recommended)): ?>
                <section class="recommendations-section mt-4 mb-4">
                    <p class="suggestion-title mb-3" style="font-weight:bold; font-size: 0.9rem; color:#666;">Recommended
                        For You</p>
                    <ul class="list-unstyled">
                        <?php foreach ($recommended as $rec): ?>
                            <li class="media mb-3 align-items-center">
                                <a href="<?= BASE_URL ?>/product.php?slug=<?= htmlspecialchars($rec['slug']) ?>"
                                    class="d-flex align-items-center text-decoration-none" style="width:100%;">
                                    <?php
                                    $imgSrc = (strpos($rec['image'], 'http') === 0) ? $rec['image'] : BASE_URL . '/assets/images/products/' . $rec['image'];
                                    ?>
                                    <div
                                        style="width: 50px; height: 50px; flex-shrink: 0; background-color: #f8f9fa; display:flex; align-items:center; justify-content:center; margin-right: 15px;">
                                        <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($rec['name']) ?>"
                                            style="max-width: 100%; max-height: 100%;">
                                    </div>
                                    <div class="media-body">
                                        <span class="mt-0 mb-0 text-dark"
                                            style="font-size: 0.9rem; font-weight: 500; display:block; line-height: 1.2;">
                                            <?= htmlspecialchars($rec['name']) ?>
                                        </span>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            <?php endif; ?>

            <section class="previous-searches suggestion-section" data-base-url="/en-us/search">
                <p class="suggestion-title">Previous Searches</p>
                <ul></ul>
            </section>
        </div>
    </form>
</div>