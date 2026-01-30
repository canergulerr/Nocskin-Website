<?php include dirname(__DIR__) . '/config.php'; ?>
<?php
require_once 'includes/db.php';

// Set the username and password you want to use
$username = 'admin';
$password = 'password123'; // Change this!

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    // Check if user already exists
    $check = $pdo->prepare("SELECT id FROM admin_users WHERE username = :username");
    $check->execute(['username' => $username]);

    if ($check->rowCount() > 0) {
        echo "Kullanıcı '$username' zaten mevcut.<br>";
    } else {
        // Insert new admin user
        $sql = "INSERT INTO admin_users (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            echo "Admin kullanıcısı başarıyla oluşturuldu!<br>";
            echo "Kullanıcı Adı: $username<br>";
            echo "�?ifre: $password<br>";
            echo "<br><a href='login.php'>Giriş Yap</a>";
            echo "<br><br><strong>GÜVENLİK UYARISI: Lütfen bu dosyayı (create_admin.php) sunucudan silin!</strong>";
        } else {
            echo "Hata oluştu.";
        }
    }
} catch (PDOException $e) {
    echo "Veritabanı hatası: " . $e->getMessage();
}
?>
