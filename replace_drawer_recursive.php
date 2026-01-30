<?php
ini_set('memory_limit', '512M');
set_time_limit(300);

$directory = __DIR__;
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

$count = 0;

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $path = $file->getPathname();

        // Skip self and include file
        if (strpos($path, 'replace_drawer_recursive.php') !== false)
            continue;
        if (strpos($path, 'search-drawer.php') !== false)
            continue;

        $content = file_get_contents($path);

        $startToken = '<div class="site-search search-drawer">';
        $startPos = strpos($content, $startToken);

        if ($startPos === false)
            continue;

        $formEnd = strpos($content, '</form>', $startPos);
        if ($formEnd === false)
            continue;

        $divEnd = strpos($content, '</div>', $formEnd);
        if ($divEnd === false)
            continue;

        $endPos = $divEnd + 6;
        $length = $endPos - $startPos;

        if ($length > 20000) {
            echo "Skipping large block in $path\n";
            continue;
        }

        $replacement = "<?php include BASE_PATH . '/includes/search-drawer.php'; ?>";
        $newContent = substr_replace($content, $replacement, $startPos, $length);

        if ($newContent !== $content) {
            file_put_contents($path, $newContent);
            echo "Updated: $path\n";
            $count++;
        }
    }
}

echo "Done. Updated $count files.\n";
