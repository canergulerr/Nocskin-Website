<?php
require_once 'includes/db.php';

$source = '../on/demandware.static/Sites-deciem-us-Site/-/default/dwbf417386/images/brands-logo/noc-logo.png';
$dest = '../assets/images/brands-logo/noc-logo.png';
$dbPath = 'assets/images/brands-logo/noc-logo.png';

echo "Attempting to copy from: $source\n";
echo "To: $dest\n";

if (copy($source, $dest)) {
    echo "Copy SUCCESS.\n";
    try {
        $stmt = $pdo->prepare("UPDATE settings SET logo_mobile = ?, logo_desktop = ? WHERE id = 1");
        $stmt->execute([$dbPath, $dbPath]);
        echo "Database Updated Successfully.\n";
    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }
} else {
    echo "Copy FAILED.\n";
    if (!file_exists($source))
        echo "Source file does not exist.\n";
    if (!is_dir(dirname($dest)))
        echo "Destination directory does not exist.\n";
}
?>