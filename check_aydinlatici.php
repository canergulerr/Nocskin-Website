<?php
require_once 'admin/includes/db.php';
require_once 'includes/page_content_helper.php';

$blocks = getPageContentBlocks($pdo, 'aydinlatici-serum');
echo "Count: " . count($blocks) . "\n";
if (count($blocks) > 0) {
    print_r($blocks[0]);
} else {
    echo "No content found for 'aydinlatici-serum'.\n";
}
?>