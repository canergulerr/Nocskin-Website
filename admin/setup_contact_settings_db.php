<?php
include dirname(__DIR__) . '/config.php';
require_once 'includes/db.php';

// 1. Create contact_settings table
$sql = "CREATE TABLE IF NOT EXISTS `contact_settings` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `setting_key` varchar(100) NOT NULL UNIQUE,
    `setting_value` text,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
$pdo->exec($sql);

// 2. Create contact_phones table
$sql = "CREATE TABLE IF NOT EXISTS `contact_phones` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) DEFAULT NULL,
    `phone_number` varchar(100) DEFAULT NULL,
    `country_name` varchar(255) DEFAULT NULL,
    `sort_order` int(11) DEFAULT 0,
    `status` tinyint(1) DEFAULT 1,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
$pdo->exec($sql);

// 3. Seed contact_settings
$default_settings = [
    'cs_title' => 'Need Customer Service?',
    'cs_hours' => 'Mon - Fri 9:30AM - 5:00PM EST',
    'media_title' => 'Contact us for Media',
    'media_url' => 'https://theordinary.com/en-us/contact-form?target=Media',
    'dist_title' => 'Contact us for Distribution',
    'dist_url' => 'https://theordinary.com/en-us/contact-form?target=Distribution',
    'store_image' => 'https://theordinary.com/on/demandware.static/-/Library-Sites-DeciemSharedLibrary/default/dwe8b8899f/contact-us/StoreImage.jpg',
    'logo_image' => '', // User can upload
    'bg_image_frequency' => '', // User can upload
    'bg_image_tower' => '' // User can upload
];

$stmt = $pdo->prepare("INSERT IGNORE INTO contact_settings (setting_key, setting_value) VALUES (?, ?)");
foreach ($default_settings as $key => $val) {
    $stmt->execute([$key, $val]);
}

// 4. Seed contact_phones
$phones = [
    ['Toll Free', '+1-800-513-6088', 'CANADA AND UNITED STATES', 1],
    ['Toll Free', '+44-800-368-8088', 'UNITED KINGDOM', 2],
    ['Toll Free', '+82-70-7775-2612', 'SOUTH KOREA', 3],
    ['Toll Free', '+61-1800-626-540', 'AUSTRALIA', 4],
    ['Long Distance Charges May Apply', '+1-646-661-4290', 'INTERNATIONAL', 5],
];

$stmt = $pdo->prepare("INSERT INTO contact_phones (title, phone_number, country_name, sort_order) VALUES (?, ?, ?, ?)");
// Check if empty first to avoid duplicates
$count = $pdo->query("SELECT count(*) FROM contact_phones")->fetchColumn();
if ($count == 0) {
    foreach ($phones as $p) {
        $stmt->execute($p);
    }
}

echo "Contact settings database setup completed.";
?>