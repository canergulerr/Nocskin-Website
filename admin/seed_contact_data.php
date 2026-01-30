<?php
include dirname(__DIR__) . '/config.php';
require_once __DIR__ . '/includes/db.php';

try {
    // 1. Clear existing data
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");
    $pdo->exec("TRUNCATE TABLE contact_links;");
    $pdo->exec("TRUNCATE TABLE contact_categories;");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");

    echo "Tables truncated.<br>";

    // Helper function
    function createCategory($pdo, $title, $order, $links)
    {
        $stmt = $pdo->prepare("INSERT INTO contact_categories (title, sort_order, status) VALUES (?, ?, 1)");
        $stmt->execute([$title, $order]);
        $catId = $pdo->lastInsertId();

        $i = 0;
        foreach ($links as $link) {
            $stmtLink = $pdo->prepare("INSERT INTO contact_links (category_id, title, url, sort_order, status) VALUES (?, ?, ?, ?, 1)");
            $stmtLink->execute([$catId, $link['title'], $link['url'], $i++]);
        }
    }

    // 2. Insert Data

    // Order Inquiries
    createCategory($pdo, "Order Inquiries", 0, [
        ['title' => "I have a damaged or incorrect order.", 'url' => "https://theordinary.com/en-us/contact-form?target=OrderInquiries"],
        ['title' => "Request a cancellation.", 'url' => "https://theordinary.com/en-us/contact-form?target=Cancellation"],
        ['title' => "I have a shipment issue.", 'url' => "https://theordinary.com/en-us/contact-form?target=Shipment"]
    ]);

    // Returns
    createCategory($pdo, "Returns", 1, [
        ['title' => "I lost my receipt.", 'url' => "https://theordinary.com/en-us/contact-form?target=LostReceipt"],
        ['title' => "My return details.", 'url' => "https://theordinary.com/en-us/contact-form?target=ReturnDetails"]
    ]);

    // Products & regimens
    createCategory($pdo, "Products & regimens", 2, [
        ['title' => "What products should I use?", 'url' => "https://theordinary.com/en-us/contact-form?target=RegimenWhat"],
        ['title' => "How should I use my products?", 'url' => "https://theordinary.com/en-us/contact-form?target=RegimenHow"],
        ['title' => "I have a faulty product.", 'url' => "https://theordinary.com/en-us/contact-form?target=Faulty"]
    ]);

    // Technical & Other
    createCategory($pdo, "Technical & Other", 3, [
        ['title' => "Change my email address.", 'url' => "https://theordinary.com/en-us/contact-form?target=EmailChange"],
        ['title' => "I have a website issue.", 'url' => "https://theordinary.com/en-us/contact-form?target=Website"],
        ['title' => "Other inquiries.", 'url' => "https://theordinary.com/en-us/contact-form?target=Other"]
    ]);

    echo "Seed data inserted successfully.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>