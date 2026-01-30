<?php
$file = dirname(__DIR__) . '/blog/rejim-rehberi.php';
$content = file($file);

$newContent = [];
$foundContentOutput = false;
$foundFooter = false;

foreach ($content as $line) {
    // Keep header part until content output
    if (!$foundContentOutput) {
        $newContent[] = $line;
        if (strpos($line, '<?= $post[\'content\'] ?>') !== false) {
            $foundContentOutput = true;
        }
    } else {
        // Skip until footer
        if (strpos($line, "include BASE_PATH . '/footer.php'") !== false) {
            $foundFooter = true;
            $newContent[] = $line; // Add footer line
        } elseif ($foundFooter) {
            $newContent[] = $line; // Add lines after footer
        }
    }
}

file_put_contents($file, implode("", $newContent));
echo "File cleaned. Total lines: " . count($newContent);
?>