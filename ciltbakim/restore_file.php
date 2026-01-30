<?php
$headerFile = __DIR__ . '/noc-ciltbakimi.php';
$contentFile = __DIR__ . '/original-noc-ciltbakimi.php';

// Extract PHP header from the current file (first 14 lines)
$lines = file($headerFile);
$header = "";
for ($i = 0; $i < 13; $i++) {
    $header .= $lines[$i];
}

// Read the original content
$originalContent = file_get_contents($contentFile);

// Combine
$newContent = $header . $originalContent;

// Save back to noc-ciltbakimi.php
file_put_contents($headerFile, $newContent);

echo "Restored original content with PHP header to $headerFile\n";
?>