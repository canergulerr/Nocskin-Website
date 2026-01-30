<?php
// Migration Script for Global Banner System
include dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/admin/includes/db.php';

$base_dir = dirname(__DIR__); // c:\xampp\htdocs\noc_new
$target_files = [];

// Helper to recursively find files
function getDirContents($dir, &$results = array())
{
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            if (pathinfo($path, PATHINFO_EXTENSION) === 'php') {
                $results[] = $path;
            }
        } else if ($value != "." && $value != "..") {
            // Exclude admin and includes directories to avoid self-modification or system files
            if ($value !== 'admin' && $value !== 'includes' && $value !== '.git' && $value !== '.gemini' && $value !== '.vscode') {
                getDirContents($path, $results);
            }
        }
    }

    return $results;
}

echo "Scanning for banner files...\n <br>";
$all_files = getDirContents($base_dir);

$banner_start_marker = '<div class="ampliance_layout media-with-cta amplience_category_hero">';

foreach ($all_files as $file) {
    $content = file_get_contents($file);
    if (strpos($content, $banner_start_marker) !== false) {
        $target_files[] = $file;
    }
}

echo "Found " . count($target_files) . " files with banners.\n <br>";

foreach ($target_files as $file) {
    $content = file_get_contents($file);

    // Create a unique page identifier based on relative path
    $rel_path = str_replace($base_dir, '', $file);
    $rel_path = ltrim($rel_path, '\\/');
    $rel_path = str_replace('\\', '/', $rel_path);
    $rel_path = str_replace('.php', '', $rel_path);
    // clean up identifier: remove en-us/category prefix if present
    $page_identifier = str_replace('en-us/category/', '', $rel_path);
    $page_identifier = str_replace('/', '-', $page_identifier);

    echo "Processing: $rel_path (ID: $page_identifier)\n <br>";

    // Extract Data using Regex
    // Note: Regex parsing HTML is fragile, but sufficient for this specific standardized structure

    $image_desktop = '';
    $image_mobile = '';
    $title = '';
    $description = '';
    $button_text = '';
    $button_url = '';
    $shop_link_text = '';
    $shop_link_url = '';

    // Extract Block
    // Find the div and its matching closing div is tricky with regex. 
    // We will assume the structure ends before the next major section or simply try to match broadly.
    // Given the structure is consistent:

    preg_match('/<div class="ampliance_layout media-with-cta amplience_category_hero">(.*?)<div class="content-wrapper">/s', $content, $matches);

    // We need to capture the WHOLE block to replace it.
    // Strategy: Find the start index, then find the matching closing div count.

    $start_pos = strpos($content, $banner_start_marker);
    $current_pos = $start_pos + strlen($banner_start_marker);
    $open_divs = 1;
    $length = strlen($content);

    while ($open_divs > 0 && $current_pos < $length) {
        $next_open = strpos($content, '<div', $current_pos);
        $next_close = strpos($content, '</div>', $current_pos);

        if ($next_close === false)
            break; // Should not happen

        if ($next_open !== false && $next_open < $next_close) {
            $open_divs++;
            $current_pos = $next_open + 4;
        } else {
            $open_divs--;
            $current_pos = $next_close + 6;
        }
    }

    $banner_html = substr($content, $start_pos, $current_pos - $start_pos);

    // Extract Image (Desktop)
    if (preg_match('/<source media="\(min-width: 1440px\)"\s+data-srcset="<\?= BASE_URL \?>\/(.*?)"/s', $banner_html, $m)) {
        $image_desktop = trim($m[1]);
    } elseif (preg_match('/<source media="\(min-width: 1440px\)"\s+data-srcset="\.\.\/\.\.\/\.\.\/assets\/(.*?)"/s', $banner_html, $m)) {
        $image_desktop = 'assets/' . trim($m[1]);
    }

    // Extract Image (Mobile) - usually the last source before img
    if (preg_match('/<source data-srcset="<\?= BASE_URL \?>\/(.*?)"/s', $banner_html, $m)) {
        $image_mobile = trim($m[1]);
    }

    // Extract Title
    if (preg_match('/<h1 class="category_title h2 d-none d-lg-block"[^>]*>(.*?)<\/h1>/s', $banner_html, $m)) {
        $title = trim(strip_tags($m[1]));
    }

    // Extract Description
    if (preg_match('/<div class="category_description"[^>]*>(.*?)<\/div>/s', $banner_html, $m)) {
        $description = trim(strip_tags($m[1]));
    }

    // Extract Button
    if (preg_match('/<div class="amp_partial general-cta">\s*<a[^>]*href="(.*?)"[^>]*>(.*?)<\/a>/s', $banner_html, $m)) {
        $button_url = trim($m[1]);
        $button_text = trim(strip_tags($m[2]));
    }

    // Extract Shop Link
    if (preg_match('/<div class="amp_partial shop-cta">\s*<a[^>]*href="(.*?)"[^>]*>(.*?)<\/a>/s', $banner_html, $m)) {
        $shop_link_url = trim($m[1]);
        $shop_link_text = trim(strip_tags($m[2]));
    }

    // Insert into DB
    try {
        // Check if exists
        $stmt = $pdo->prepare("SELECT id FROM banners WHERE page_identifier = ?");
        $stmt->execute([$page_identifier]);
        $exists = $stmt->fetch();

        if (!$exists) {
            $stmt = $pdo->prepare("INSERT INTO banners (
                page_identifier, title, description, button_text, button_url, 
                shop_link_text, shop_link_url, image_desktop, image_mobile
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute([
                $page_identifier,
                $title,
                $description,
                $button_text,
                $button_url,
                $shop_link_text,
                $shop_link_url,
                $image_desktop,
                $image_mobile
            ]);
            echo "inserted into DB.\n <br>";
        } else {
            echo "already in DB.\n <br>";
        }
    } catch (PDOException $e) {
        echo "DB Error: " . $e->getMessage() . "\n <br>";
    }

    // Replace HTML in File
    $replacement = "<?php render_banner(\$pdo, '$page_identifier'); ?>";

    // Add require_once for db and helper at the top if not present
    $file_content_new = $content;

    // Check if db include exists
    if (strpos($file_content_new, 'admin/includes/db.php') === false) {
        // Insert after config include or at top
        if (strpos($file_content_new, "include dirname(__DIR__, 2) . '/config.php';") !== false) {
            $file_content_new = str_replace("include dirname(__DIR__, 2) . '/config.php';", "include dirname(__DIR__, 2) . '/config.php';\nrequire_once dirname(__DIR__, 2) . '/admin/includes/db.php';\nrequire_once dirname(__DIR__, 2) . '/includes/banner_helper.php';", $file_content_new);
        } elseif (strpos($file_content_new, "include dirname(__DIR__) . '/config.php';") !== false) {
            // for files one level deeper
            $file_content_new = str_replace("include dirname(__DIR__) . '/config.php';", "include dirname(__DIR__) . '/config.php';\nrequire_once dirname(__DIR__) . '/admin/includes/db.php';\nrequire_once dirname(__DIR__) . '/includes/banner_helper.php';", $file_content_new);
        } else {
            // Fallback: prepend to file
            $file_content_new = "<?php require_once '" . str_replace('\\', '/', dirname(__DIR__)) . "/admin/includes/db.php'; require_once '" . str_replace('\\', '/', dirname(__DIR__)) . "/includes/banner_helper.php'; ?>\n" . $file_content_new;
        }
    } else {
        // db exists, ensure helper exists
        if (strpos($file_content_new, 'banner_helper.php') === false) {
            $file_content_new = str_replace("require_once dirname(__DIR__, 2) . '/admin/includes/db.php';", "require_once dirname(__DIR__, 2) . '/admin/includes/db.php';\nrequire_once dirname(__DIR__, 2) . '/includes/banner_helper.php';", $file_content_new);
        }
    }

    // Perform HTML replacement
    // Since we calculated the exact block earlier, we can't easily use str_replace if there are multiples (unlikely on these pages)
    // But we know exact start and length from earlier calculation on $content (original)
    // Wait, modifying the header affects offsets. 
    // Safer approach: str_replace the exact string $banner_html

    $file_content_new = str_replace($banner_html, $replacement, $file_content_new);

    file_put_contents($file, $file_content_new);
    echo "File updated.\n <br>";
}

echo "Migration Complete.";
?>