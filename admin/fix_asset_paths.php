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

$all_files = getDirContents($base_dir);

echo "Files found: " . count($all_files) . "\n <br>";
$count = 0;

$resources = [
    'on/demandware.static',
    'deployments/',
    'd9e0963334254858b90cf68389c2aace/',
    'widget/widget.js',
    'index.htm',
    'about/analytics'
];

foreach ($all_files as $file) {
    if (basename($file) == 'fix_asset_paths.php')
        continue;

    $content = file_get_contents($file);
    $orig = $content;

    // Simple replacements
    $content = str_replace('../../../../', '<?= BASE_URL ?>/', $content);

    foreach ($resources as $res) {
        $content = str_replace('../../../' . $res, '<?= BASE_URL ?>/' . $res, $content);
        $content = str_replace('../../' . $res, '<?= BASE_URL ?>/' . $res, $content);
    }

    if ($content !== $orig) {
        file_put_contents($file, $content);
        $count++;
        echo "Fixed: " . basename($file) . "\n <br>";
    }
}

echo "Done. Fixed $count files.";
?>
