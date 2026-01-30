<?php
// Run from root: php admin/final_cleanup.php
$file = 'index.php';
$lines = file($file);

if (!$lines) {
    die("Could not read index.php");
}

$newContent = "";

// Keep lines 0 to 404 (indices)
// Corresponds to Lines 1 to 405 in editor
for ($i = 0; $i <= 404; $i++) {
    $newContent .= $lines[$i];
}

// Skip from 405 to 1842 (indices)
// This removes Lines 406 to 1843 in editor (Wait, check indexing)
// Line 405 in editor is Index 404.
// Line 406 in editor is Index 405.
// Line 1843 in editor is Index 1842.
// So we keep 0-404.
// Skip 405 to 1842.
// The next kept line is Index 1843 (Line 1844 in editor).

// Keep from 1843 to End
for ($i = 1843; $i < count($lines); $i++) {
    $newContent .= $lines[$i];
}

file_put_contents($file, $newContent);
echo "Cleaned index.php\n";
?>