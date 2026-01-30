<?php
/**
 * Fetches page content sections from the database.
 * 
 * @param PDO $pdo The PDO database connection
 * @param string $pageIdentifier The identifier for the page (e.g., 'yaslanma-karsiti')
 * @return array The list of content blocks
 */
function getPageContentBlocks($pdo, $pageIdentifier)
{
    if (!$pdo) {
        return [];
    }

    $stmt = $pdo->prepare("SELECT * FROM page_sections WHERE page_identifier = ? AND status = 1 ORDER BY sort_order ASC");
    $stmt->execute([$pageIdentifier]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Fetches a single page content section by its ID.
 * 
 * @param PDO $pdo The PDO database connection
 * @param int $id The ID of the section
 * @return array|false The content block or false if not found
 */
function getPageSectionById($pdo, $id)
{
    if (!$pdo) {
        return false;
    }

    $stmt = $pdo->prepare("SELECT * FROM page_sections WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>