<?php
require_once 'includes/db.php';

echo "Database connection successful.<br>";

try {
    $stmt = $pdo->query("SELECT id, username, password FROM admin_users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "Found " . count($users) . " users.<br><br>";

    foreach ($users as $user) {
        $hash = $user['password'];
        $len = strlen($hash);
        $algo = password_get_info($hash);

        echo "User: <strong>" . htmlspecialchars($user['username']) . "</strong><br>";
        echo "Hash Length: $len<br>";
        echo "Hash Prefix: " . substr($hash, 0, 5) . "...<br>";
        echo "Algo Name: " . $algo['algoName'] . "<br>";

        if ($algo['algo'] == 0) {
            echo "<span style='color:red'>WARNING: unrecognized hash format. possibly plain text or MD5.</span><br>";
            if ($len == 32 && ctype_xdigit($hash)) {
                echo "Looks like MD5.<br>";
            }
        } else {
            echo "<span style='color:green'>Valid hash format.</span><br>";
        }
        echo "<hr>";
    }

} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
