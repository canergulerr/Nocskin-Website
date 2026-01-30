<?php
$subdirs = ['shop-by-concern', 'shop-by-ingredients'];
$baseDir = dirname(__DIR__) . '/ciltbakim';

foreach ($subdirs as $subdir) {
    $dir = $baseDir . '/' . $subdir;
    if (!is_dir($dir))
        continue;

    $files = scandir($dir);
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) !== 'php')
            continue;

        $path = $dir . '/' . $file;
        $content = file_get_contents($path);

        // Fix dirname(__DIR__, 4) -> dirname(__DIR__, 2)
        // Also possibly __DIR__, 3 if originally 3?
        // Let's replace 'dirname(__DIR__, 4)' with 'dirname(__DIR__, 2)'

        $newContent = str_replace(
            "dirname(__DIR__, 4)",
            "dirname(__DIR__, 2)",
            $content
        );

        if ($content !== $newContent) {
            file_put_contents($path, $newContent);
            echo "Fixed $subdir/$file\n";
        }
    }
}
?>