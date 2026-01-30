<?php
include 'admin/includes/db.php';

$id = 36;
$description = "Glycolic Acid 7% Exfoliating Toner is a water-based toner that provides effective surface degradation for smoother-looking skin. This formula acts as an exfoliant to target skin texture and dullness, while promoting more radiant skin. It also includes a Tasmanian Pepperberry derivative to help reduce irritation associated with acid use.";
$ingredients = "Aqua (Water), Glycolic Acid, Rosa Damascena Flower Water, Centaurea Cyanus Flower Water, Aloe Barbadensis Leaf Water, Propanediol, Glycerin, Triethanolamine, Aminomethyl Propanol, Panax Ginseng Root Extract, Tasmannia Lanceolata Fruit/Leaf Extract, Aspartic Acid, Alanine, Glycine, Serine, Valine, Isoleucine, Proline, Threonine, Histidine, Phenylalanine, Glutamic Acid, Arginine, PCA, Sodium PCA, Sodium Lactate, Fructose, Glucose, Sucrose, Urea, Hexyl Nicotinate, Dextrin, Citric Acid, Polysorbate 20, Gellan Gum, Trisodium Ethylenediamine Disuccinate, Sodium Chloride, Hexylene Glycol, Potassium Sorbate, Sodium Benzoate, 1,2-Hexanediol, Caprylyl Glycol.";
$targets = "Dullness, Uneven Texture, Signs of Aging";
$suited_to = "All Skin Types";
$format = "Water-Based Toner";
$regimen_step = "Use after cleansing, before serums";

$sql = "UPDATE products SET 
        description = IF(description = '' OR description IS NULL, ?, description),
        targets = IF(targets = '' OR targets IS NULL, ?, targets),
        suited_to = IF(suited_to = '' OR suited_to IS NULL, ?, suited_to),
        format = IF(format = '' OR format IS NULL, ?, format),
        regimen_step = IF(regimen_step = '' OR regimen_step IS NULL, ?, regimen_step)
        WHERE id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$description, $targets, $suited_to, $format, $regimen_step, $id]);

echo "Updated product ID $id with sample content.";
?>