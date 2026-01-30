<?php
function getContactCategoriesWithLinks($pdo)
{
    // Fetch Categories
    $stmt = $pdo->query("SELECT * FROM contact_categories WHERE status = 1 ORDER BY sort_order ASC, id ASC");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch Links for each category
    foreach ($categories as &$cat) {
        $stmtLink = $pdo->prepare("SELECT * FROM contact_links WHERE category_id = ? AND status = 1 ORDER BY sort_order ASC, id ASC");
        $stmtLink->execute([$cat['id']]);
        $cat['links'] = $stmtLink->fetchAll(PDO::FETCH_ASSOC);
    }
    return $categories;
}

function makeSlug($string)
{
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '', $string)));
}

function getContactSettings($pdo)
{
    $settings = [];
    try {
        $stmt = $pdo->query("SELECT * FROM contact_settings");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
    } catch (PDOException $e) {
        // Table might not exist yet if script failed, return empty to avoid crash
    }
    return $settings;
}

function getContactPhones($pdo)
{
    try {
        $stmt = $pdo->query("SELECT * FROM contact_phones WHERE status = 1 ORDER BY sort_order ASC, id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}
?>