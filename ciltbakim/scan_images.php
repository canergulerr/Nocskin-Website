<?php
$file = __DIR__ . '/noc-ciltbakimi.php';
$content = file_get_contents($file);

preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/i', $content, $matches);

echo "Found " . count($matches[1]) . " images:\n";
foreach ($matches[1] as $src) {
    echo $src . "\n";
}
?>