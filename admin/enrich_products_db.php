<?php
include 'includes/db.php';

echo "<h2>Enriching Products Table...</h2>";

try {
    // List of new columns to add
    $columns = [
        "ADD COLUMN targets TEXT DEFAULT NULL AFTER ingredients",
        "ADD COLUMN suited_to VARCHAR(255) DEFAULT NULL AFTER targets",
        "ADD COLUMN format VARCHAR(255) DEFAULT NULL AFTER suited_to",
        "ADD COLUMN regimen_step VARCHAR(100) DEFAULT NULL AFTER format",
        "ADD COLUMN ph_range VARCHAR(50) DEFAULT NULL AFTER regimen_step",
        "ADD COLUMN is_water_free TINYINT(1) DEFAULT 0 AFTER ph_range",
        "ADD COLUMN is_alcohol_free TINYINT(1) DEFAULT 0 AFTER is_water_free",
        "ADD COLUMN is_oil_free TINYINT(1) DEFAULT 0 AFTER is_alcohol_free",
        "ADD COLUMN is_silicone_free TINYINT(1) DEFAULT 0 AFTER is_oil_free",
        "ADD COLUMN is_vegan TINYINT(1) DEFAULT 0 AFTER is_silicone_free",
        "ADD COLUMN is_gluten_free TINYINT(1) DEFAULT 0 AFTER is_vegan",
        "ADD COLUMN is_cruelty_free TINYINT(1) DEFAULT 0 AFTER is_gluten_free",
        "ADD COLUMN testing_results TEXT DEFAULT NULL AFTER is_cruelty_free",
        "ADD COLUMN awards_image VARCHAR(255) DEFAULT NULL AFTER testing_results"
    ];

    foreach ($columns as $colSql) {
        try {
            $pdo->exec("ALTER TABLE products $colSql");
            echo "Added column: " . explode(' ', $colSql)[2] . "<br>";
        } catch (PDOException $e) {
            // Error code 42S21 means "Column already exists"
            if ($e->getCode() == '42S21') {
                echo "Column already exists: " . explode(' ', $colSql)[2] . " (Skipped)<br>";
            } else {
                echo "Error adding column: " . $e->getMessage() . "<br>";
            }
        }
    }

    echo "<h3>Schema Update Complete!</h3>";
    echo "<a href='products.php'>Go to Products</a>";

} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage());
}
?>