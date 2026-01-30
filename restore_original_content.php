<?php
include 'admin/includes/db.php';

$id = 36;
$description_short = "A daily glycolic acid toner that smooths skin texture, evens tone, and enhances luminosity.";
$ingredients = "Aqua (Water), Glycolic Acid, Rosa Damascena Flower Water, Centaurea Cyanus Flower Water, Aloe Barbadensis Leaf Water, Propanediol, Glycerin, Triethanolamine, Aminomethyl Propanol, Panax Ginseng Root Extract, Tasmannia Lanceolata Fruit/Leaf Extract, Aspartic Acid, Alanine, Glycine, Serine, Valine, Isoleucine, Proline, Threonine, Histidine, Phenylalanine, Glutamic Acid, Arginine, Pca, Sodium Pca, Sodium Lactate, Fructose, Glucose, Sucrose, Urea, Hexyl Nicotinate, Dextrin, Citric Acid, Polysorbate 20, Gellan Gum, Trisodium Ethylenediamine Disuccinate, Sodium Chloride, Hexylene Glycol, Potassium Sorbate, Sodium Benzoate, 1,2-Hexanediol, Caprylyl Glycol.";

$description_html = urldecode("%3Cp%3EGlycolic%20Acid%207%25%20Exfoliating%20Toner%20is%20a%20water-based,%20exfoliating%20toner%20formulated%20with%207%25%20glycolic%20acid,%20a%20proven%20alpha-hydroxy%20acid%20(AHA)%20that%20effectively%20exfoliates%20the%20skin.%20It%20helps%20to%20remove%20dead%20skin%20cells,%20revealing%20a%20smoother,%20more%20even%20texture.%20Regular%20use%20of%20this%20glycolic%20acid%20toner%20promotes%20the%20appearance%20of%20more%20luminous%20and%20radiant%20skin%20while%20reducing%20the%20visibility%20of%20fine%20lines,%20wrinkles,%20and%20other%20signs%20of%20aging.%3C/p%3E%0D%0A%0D%0A%3Cp%3EThis%20formulation%20also%20features%20a%20Tasmanian%20Pepperberry%20derivative,%20a%20plant%20extract%20that%20helps%20soothe%20the%20skin%20and%20reduce%20irritation%20commonly%20associated%20with%20exfoliation,%20making%20it%20suitable%20for%20frequent%20use.%20The%20presence%20of%20this%20natural%20ingredient%20may%20cause%20seasonal%20colour%20variation%20in%20the%20formula.%20With%20a%20carefully%20calibrated%20pH%20of%20approximately%203.6,%20the%20toner%20has%20an%20optimal%20balance%20between%20salt%20and%20acidity.%3C/p%3E%0D%0A%0D%0A%3Cp%3EThis%20multi-functional%20toner%20is%20not%20only%20effective%20on%20the%20face,%20but%20can%20also%20be%20applied%20to%20the%20scalp%20to%20help%20rebalance,%20hydrate,%20and%20reduce%20dryness.%20This%20formulation%20should%20not%20be%20used%20on%20sensitive,%20peeling,%20or%20compromised%20skin.%20For%20best%20results,%20it%20is%20recommended%20to%20follow%20sun%20protection%20guidance%20due%20to%20increased%20skin%20sensitivity%20to%20sunlight%20after%20use.%3C/p%3E%0D%0A%0D%0A%3Cp%3EThe%20Ordinary%20Tip:%3C/p%3E%0D%0A%3Cul%3E%0D%0A%3Cli%3ETo%20maximize%20the%20benefits%20of%20glycolic%20acid,%20consider%20incorporating%20the%20toner%20into%20your%20evening%20routine,%20and%20always%20follow%20with%20an%20SPF%20product%20during%20the%20day.%3C/li%3E%0D%0A%3Cli%3EApply%20this%20product%20to%20exfoliate%20small%20areas%20of%20the%20body%20experiencing%20rough%20and%20bumpy%20skin.%3C/li%3E%0D%0A%3C/ul%3E");

$testing_results_html = urldecode("%3Cul%3E%0D%0A%09%3Cli%3EBoosts%20skin%20luminosity,%20evens%20skin%20tone%20appearance%20and%20smooths%20texture.%3C/li%3E%0D%0A%09%3Cli%3ESignificantly%20smooths%20skin%20texture.%3C/li%3E%0D%0A%09%3Cli%3EPromotes%20the%20appearance%20of%20more%20even%20skin%20tone%20and%20more%20luminous%20skin.%3C/li%3E%0D%0A%09%3Cli%3EReduces%20the%20appearance%20of%20lines%20and%20wrinkles.%3C/li%3E%0D%0A%3C/ul%3E");

$targets = "Textural Irregularities, Dullness, Uneven Skin Tone";
$suited_to = "All Skin Types";
$format = "Toner: Water-Based";
$regimen_step = "Prep";
$ph_range = "3.5-3.9";

// Update Query
$sql = "UPDATE products SET 
        short_description = ?,
        description = ?,
        ingredients = ?,
        targets = ?,
        suited_to = ?,
        format = ?,
        regimen_step = ?,
        testing_results = ?,
        ph_range = ?,
        is_water_free = 1,
        is_alcohol_free = 1,
        is_oil_free = 1,
        is_silicone_free = 1,
        is_vegan = 1,
        is_gluten_free = 1,
        is_cruelty_free = 1
        WHERE id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $description_short,
    $description_html,
    $ingredients,
    $targets,
    $suited_to,
    $format,
    $regimen_step,
    $testing_results_html,
    $ph_range,
    $id
]);

echo "Restored original content for Product ID $id.";
?>