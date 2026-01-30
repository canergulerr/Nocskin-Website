<?php
$file = __DIR__ . '/noc-ciltbakimi.php';
$lines = file($file);

foreach ($lines as $i => $line) {
    if (strpos($line, 'amplience') !== false) {
        echo "Line " . ($i + 1) . ": " . trim($line) . "\n";
    }
}
?>