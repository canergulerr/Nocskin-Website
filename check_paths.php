<?php
include __DIR__ . '/config.php';

echo "<h3>Path Debugger</h3>";
echo "BASE_URL: " . BASE_URL . "<br>";
echo "BASE_PATH: " . BASE_PATH . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "Short tag test: ";
?>
<?= "Short tags are WORKING"; ?>
<br>

<?php
$cssRelPath = 'assets/css/bootstrap.css';
$cssAbsPath = BASE_PATH . '/' . $cssRelPath;

echo "Checking CSS file at: " . $cssAbsPath . "<br>";

if (file_exists($cssAbsPath)) {
    echo "<span style='color:green'>FOUND: CSS file exists on disk.</span><br>";
} else {
    echo "<span style='color:red'>MISSING: CSS file NOT found on disk.</span><br>";
}

echo "Constructed URL: " . BASE_URL . '/' . $cssRelPath . "<br>";
?>