<?php
require_once __DIR__ . '/includes/db.php';

$stmt = $pdo->query("SELECT DISTINCT page_identifier FROM page_sections");
$pages = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo "Available Page Identifiers:\n";
foreach ($pages as $p) {
    echo "- $p\n";
}

// Check for both short and long slug
$identifiers = [
    'leke-karsiti-aydinlatici-serum',
    'leke-karsiti-aydinlatici-gozenek-sikilastirici-serum'
];

foreach ($identifiers as $identifier) {
    echo "Checking '$identifier'...\n";
    $stmt = $pdo->prepare("SELECT * FROM page_sections WHERE page_identifier = ?");
    $stmt->execute([$identifier]);
    $blocks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "Blocks found: " . count($blocks) . "\n";
    foreach ($blocks as $b) {
        echo "ID: " . $b['id'] . ", Title: " . $b['title'] . ", Subtitle: " . $b['subtitle'] . "\n";
    }
    echo "------------------\n";
}
?>