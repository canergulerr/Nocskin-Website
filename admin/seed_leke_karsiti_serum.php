<?php
require_once 'includes/db.php';

$pageIdentifier = 'leke-karsiti-serum';

// Delete existing records for this page to prevent duplicates
$stmt = $pdo->prepare("DELETE FROM page_sections WHERE page_identifier = ?");
$stmt->execute([$pageIdentifier]);

// Insert new content block
$title = "Leke Karşıtı Serumuna Neden İhtiyacınız Var?";
$subtitle = "Göz çevrenizde kırışıklıklar, koyu halkalar veya şişlikler yaşıyorsanız, daha aydınlık ve daha az şişkin bir göz çevresi için bu sorunları hedefleyen göz serumlarının hangileri olduğunu öğrenin.";
$imageUrl = "on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dwe870aeec/theordinary/gridbreakers/2025-09-15-Always-On-Grid-Breakers-eye-serums-blog.jpg";
$buttonText = "Leke Karşıtı Serumları Hakkında Bilgi Edinin.";
$buttonUrl = "/on/demandware.store/Sites-deciem-us-Site/en_US/Page-Show?cid=the-ordinary-eye-serums";

$stmt = $pdo->prepare("INSERT INTO page_sections (page_identifier, title, subtitle, image_url, button_text, button_url, sort_order, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, 1, 1, NOW(), NOW())");
$stmt->execute([$pageIdentifier, $title, $subtitle, $imageUrl, $buttonText, $buttonUrl]);

echo "Content seeded successfully for page: " . $pageIdentifier;
?>