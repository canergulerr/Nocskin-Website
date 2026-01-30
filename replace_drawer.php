<?php
include 'config.php'; // Ensure definitions
// We need BASE_PATH
if (!defined('BASE_PATH'))
    define('BASE_PATH', __DIR__);

$files = [
    'index.php',
    'ciltbakim/en-cok-satanlar.php',
    'category.php'
];

foreach ($files as $file) {
    if (!file_exists($file)) {
        echo "Skipping $file (not found)\n";
        continue;
    }
    $content = file_get_contents($file);

    // Find start with flexible whitespace
    // regex might be safer
    // The common start tag is <?php include BASE_PATH . '/includes/search-drawer.php'; ?> after </form>
    $divEnd = strpos($content, '</div>', $formEnd);
    if ($divEnd === false) {
        echo "Div end not found in $file\n";
        continue;
    }

    $endPos = $divEnd + 6; // length of </div>
    $length = $endPos - $startPos;

    // Construct replacement
    // We use BASE_PATH for robustness.
    $replacement = "<?php include BASE_PATH . '/includes/search-drawer.php'; ?>";

    $newContent = substr_replace($content, $replacement, $startPos, $length);
    file_put_contents($file, $newContent);
    echo "Successfully updated $file\n";
}
?>