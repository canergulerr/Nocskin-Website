<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/includes/db.php';

$file = BASE_PATH . '/blog/rejim-rehberi.php';

if (!file_exists($file)) {
    die("File not found: $file");
}

$html = file_get_contents($file);

// Extract Meta Title
preg_match('/<title>(.*?)<\/title>/s', $html, $matches);
$meta_title = isset($matches[1]) ? trim($matches[1]) : 'Cilt Bakım Rutininizi Nasıl Oluşturursunuz? | Noc';

// Extract Meta Description
preg_match('/<meta name="description"\s+content="(.*?)"/s', $html, $matches);
$meta_description = isset($matches[1]) ? trim($matches[1]) : '';

// Extract Main Content
// We look for <div role="main" id="maincontent"> ... </div>
// Since it's nested HTML, regex is fragile. But we can try to find the start and a probable end.
// However, seeing the file structure, the finding "layout" divs might be safer or just taking everything after header include until footer include.

$startMarker = '<div role="main" id="maincontent">';
$endMarker = '<?php include BASE_PATH . \'/footer.php\'; ?>';

$startPos = strpos($html, $startMarker);
$endPos = strpos($html, $endMarker);

if ($startPos !== false && $endPos !== false) {
    // We want the content INSIDE maincontent, but the file has it mixed.
    // Let's capture strictly what is between the markers.
    $capturedContent = substr($html, $startPos, $endPos - $startPos);
    // Cleanup: Remove the closing </div> of maincontent if it was at the very end??
    // Actually, let's keep the wrapper div in the DB for now to preserve styling hooks, or we can strip it.
    // The user wants to edit "contents and visuals".
    // Let's keep strict integrity first.
} else {
    // Fallback or error
    die("Could not locate content boundaries in file.");
}

$title = "Rejim Rehberi";
$slug = "rejim-rehberi";

// Insert or Update
try {
    $stmt = $pdo->prepare("INSERT INTO blog_posts (title, slug, content, meta_title, meta_description, status) VALUES (?, ?, ?, ?, ?, 1) ON DUPLICATE KEY UPDATE content = VALUES(content), meta_title = VALUES(meta_title), meta_description = VALUES(meta_description)");
    $stmt->execute([$title, $slug, $capturedContent, $meta_title, $meta_description]);
    echo "Migration successful for '$slug'.\n";
} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage());
}
?>