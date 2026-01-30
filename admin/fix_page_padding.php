<?php
include dirname(__DIR__) . '/config.php';
$base_dir = dirname(__DIR__);
function getDirContents($dir, &$results = array())
{
    $files = scandir($dir);
    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            if (pathinfo($path, PATHINFO_EXTENSION) === 'php') {
                $results[] = $path;
            }
        } else if ($value != "." && $value != ".." && $value !== 'admin' && $value !== 'includes' && $value !== '.git' && $value !== '.gemini') {
            getDirContents($path, $results);
        }
    }
    return $results;
}
echo "Scanning for page padding updates...<br>";

$all_files = getDirContents($base_dir);
$count = 0;

$styles = '<style>
    @media (min-width: 1024px) {
        div.page { padding-top: 115px !important; }
    }
    @media (max-width: 1023px) {
        div.page { padding-top: 75px !important; }
    }
</style>';

foreach ($all_files as $file) {
    if (strpos($file, 'admin') !== false || basename($file) == 'header.php' || basename($file) == 'footer.php')
        continue;

    $content = file_get_contents($file);
    $orig = $content;

    // Inject before closing head tag
    if (strpos($content, '</head>') !== false) {
        // Check if already injected
        if (strpos($content, 'div.page { padding-top: 115px !important; }') === false) {
            $content = str_replace('</head>', $styles . "\n</head>", $content);
        }
    }

    if ($content !== $orig) {
        file_put_contents($file, $content);
        $count++;
    }
}

echo "Applied padding fix to $count files.";
?>