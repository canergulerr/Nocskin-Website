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
$count = 0;
foreach ($all_files as $file) {
    if (basename($file) == 'fix_asset_paths.php' || basename($file) == 'fix_breadcrumb_spacing.php')
        continue;
    $content = file_get_contents($file);
    $orig = $content;

    // Fix typo from previous run
    $content = str_replace('style="display:none:"', 'style="display:none;"', $content);

    // Ensure the breadcrumb fix is clean just in case
    $pattern = '/<div class="plp_breadcrumb_panel d-sm-block"/';
    $replacement = '<div class="plp_breadcrumb_panel d-sm-block mt-0 pt-0" style="margin-top:0 !important; padding-top:0 !important;"';
    if (strpos($content, '<div class="plp_breadcrumb_panel d-sm-block"') !== false) {
        $content = preg_replace($pattern, $replacement, $content);
    }

    if ($content !== $orig) {
        file_put_contents($file, $content);
        $count++;
    }
}
echo "Fixed typos in $count files.";
?>