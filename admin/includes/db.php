<?php include dirname(__DIR__, 2) . '/config.php'; ?>
<?php
// Database credentials
$host = 'localhost';
$dbname = 'unitabco_nocskin_db';
$username = 'unitabco_nocskin_user';
$password = '4W@WrA6Iq-;i@VV,';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>