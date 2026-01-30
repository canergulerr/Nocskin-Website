<?php
include 'admin/includes/db.php';

$productId = 36;

echo "Seeding data for Product ID: $productId\n";

try {
    // 1. Clear existing variants/images for clean state
    $pdo->query("DELETE FROM product_variants WHERE product_id = $productId");
    $pdo->query("DELETE FROM product_images WHERE product_id = $productId");

    // 2. Insert Variants
    $variants = [
        ['size' => '100ml', 'price' => 12.50, 'image_path' => 'https://theordinary.com/dw/image/v2/BFKJ_PRD/on/demandware.static/-/Sites-deciem-master/default/dw28279863/Images/products/The%20Ordinary/rdn-glycolic-acid-7pct-exfoliating-toner-100ml.png'],
        ['size' => '240ml', 'price' => 20.00, 'image_path' => 'https://theordinary.com/dw/image/v2/BFKJ_PRD/on/demandware.static/-/Sites-deciem-master/default/dw28279863/Images/products/The%20Ordinary/rdn-glycolic-acid-7pct-exfoliating-toner-240ml.png']
    ];

    $stmtVar = $pdo->prepare("INSERT INTO product_variants (product_id, size, price, image_path) VALUES (?, ?, ?, ?)");
    foreach ($variants as $var) {
        $stmtVar->execute([$productId, $var['size'], $var['price'], $var['image_path']]);
        echo "Inserted variant: {$var['size']}\n";
    }

    // 3. Insert Gallery Images
    $gallery = [
        'https://theordinary.com/dw/image/v2/BFKJ_PRD/on/demandware.static/-/Sites-deciem-master/default/dw28279863/Images/products/The%20Ordinary/rdn-glycolic-acid-7pct-exfoliating-toner-240ml.png',
        'https://theordinary.com/dw/image/v2/BFKJ_PRD/on/demandware.static/-/Sites-deciem-master/default/dw1e0b5b1a/Images/products/The%20Ordinary/rdn-glycolic-acid-7pct-exfoliating-toner-texture.jpg'
    ];

    $stmtImg = $pdo->prepare("INSERT INTO product_images (product_id, image_path, sort_order) VALUES (?, ?, 10)");
    foreach ($gallery as $img) {
        $stmtImg->execute([$productId, $img]);
        echo "Inserted gallery image\n";
    }

    // 4. Update Product Fields
    $keyIng = "Glycolic Acid, Aloe Barbadensis Leaf Water, Panax Ginseng Root Extract, Tasmannia Lanceolata Fruit/Leaf Extract";
    $cartUrl = "https://theordinary.com/en-us/glycolic-acid-7-exfoliating-toner-100418.html"; // Example external link
    // Using a placeholder award image
    $awardImg = "https://theordinary.com/on/demandware.static/-/Sites-deciem-us-Site/-/en_US/v1761278445707/images/awards-logo.svg";

    $stmtUpd = $pdo->prepare("UPDATE products SET key_ingredients = ?, add_to_cart_url = ?, awards_image = ?, regimen_step = 'Prep', ph_range = '3.5-3.8' WHERE id = ?");
    $stmtUpd->execute([$keyIng, $cartUrl, $awardImg, $productId]);
    echo "Updated product fields (Key Ingredients, Cart URL, Awards)\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>