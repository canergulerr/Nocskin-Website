<?php
include 'config.php';
// Hardcoded path from previous debug output
$relativePath = '/assets/uploads/products/1767018932_gal_ord-glycolic-acid-exfoliating-toner-model-application-with-benefits.webp';
$fullPath = __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);

echo "Checking file: " . $fullPath . "\n";
if (file_exists($fullPath)) {
    echo "File EXISTS.\n";
    echo "Size: " . filesize($fullPath) . " bytes\n";
} else {
    echo "File DOES NOT EXIST.\n";
}
?>