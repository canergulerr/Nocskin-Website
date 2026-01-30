<?php
require_once 'includes/db.php';
require_once 'config.php'; // Needed for BASE_URL if we want to include it, but usually assets are relative or absolute paths.

// Update the image URL for the Esans page section
// The user said the image is not loading.
// Assuming the image is at: assets/images/essence-vs-toner-blog-gridbreaker.jpg
// And the page uses BASE_URL to prepend?
// In the PHP code: <img src="<?= htmlspecialchars($section['image_url']) ?>"
// If $section['image_url'] is 'assets/images/...', then it needs BASE_URL prepended in the PHP or the DB value should
be full.
// However, looking at the PHP code I wrote:
/*
<img src="<?= htmlspecialchars($section['image_url']) ?>" ... */ // It DOES NOT prepend BASE_URL. So the DB must contain
    the full path or I should update PHP to prepend BASE_URL. // Updating PHP is safer. But let's verify if I can just
    update the DB to have a root-relative path. // Actually, earlier I used `<?= BASE_URL ?>/` for everything. // Let's
    stick to updating the database to have `assets/images/...` and update the PHP to prepend `BASE_URL/` // BUT, for
    now, let's just make the DB value absolute for simplicity if I can't edit PHP easily again (I can). // Let's update
    PHP to be robust. // PREVIOUSLY: /* <img src="<?= htmlspecialchars($section['image_url']) ?>" */ // The 'image_url'
    in DB was 'assets/images/essence-vs-toner-blog-gridbreaker.jpg' // So it renders as `<img src="assets/images/..." `.
    // If the page is at `localhost/ciltbakim/leke-karsiti...`, relative path `assets/images` looks for
    `localhost/ciltbakim/assets/images` which is WRONG. // It SHOULD be `../../assets/images` or better
    `/assets/images`. // Since I have BASE_URL, I should use it in the PHP.
    $page_identifier='leke-karsiti-aydinlatici-serum' ;
    $new_image_url='assets/images/essence-vs-toner-blog-gridbreaker.jpg' ; // Keep it clean in DB
    $stmt=$pdo->prepare("UPDATE page_sections SET image_url = :image_url WHERE page_identifier = :page_identifier AND
title LIKE 'Esans%'");
$stmt->execute([':image_url' => $new_image_url, ':page_identifier' => $page_identifier]);

echo "Updated image URL in database.";
?>
