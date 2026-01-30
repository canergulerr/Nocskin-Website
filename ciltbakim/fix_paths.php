<?php
$file = __DIR__ . '/noc-ciltbakimi.php';
$content = file_get_contents($file);

// Define replacements
$replacements = [
    'src="../../' => 'src="<?= BASE_URL ?>/',
    'href="../../' => 'href="<?= BASE_URL ?>/',
    'poster="../../' => 'poster="<?= BASE_URL ?>/',

    // Also handling ../ for single level up, assuming they point to root assets/pages
    'src="../' => 'src="<?= BASE_URL ?>/',
    'href="../' => 'href="<?= BASE_URL ?>/',
    'poster="../' => 'poster="<?= BASE_URL ?>/',
];

$fixedContent = strtr($content, $replacements);

if ($fixedContent !== $content) {
    file_put_contents($file, $fixedContent);
    echo "Fixed paths in $file\n";
} else {
    echo "No changes made (paths might already be fixed)\n";
}
?>