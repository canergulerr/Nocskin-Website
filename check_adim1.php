<?php
require_once 'admin/includes/db.php';
require_once 'includes/page_content_helper.php';

$blocks = getPageContentBlocks($pdo, 'noc-ciltbakimi');
foreach ($blocks as $block) {
    if (strpos($block['title'], 'Adım 1') !== false) {
        print_r($block);
    }
}
?>