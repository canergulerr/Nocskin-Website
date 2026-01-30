<?php include dirname(__DIR__) . '/config.php'; ?>
<?php
// Bu dosya veritabanını ve tabloları otomatik oluşturmak içindir.
// Çalıştırdıktan sonra silmeniz önerilir.

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'noc_new_db';

try {
    // 1. MySQL'e veritabanı ismi OLMADAN bağlan (Sadece sunucuya bağlanıyoruz)
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Veritabanını oluştur
    echo "Veritabanı kontrol ediliyor...<br>";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Veritabanı '$dbname' hazır.<br>"; // Eğer varsaysa hata vermez, yoksa oluşturur.

    // 3. Veritabanını seç
    $pdo->exec("USE `$dbname`");

    // 4. Tabloları oluştur (SQL dosyasından okumak yerine buraya gömüyorum garanti olsun)
    echo "Tablolar oluşturuluyor...<br>";

    $queries = [
        "CREATE TABLE IF NOT EXISTS `admin_users` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `username` varchar(50) NOT NULL UNIQUE,
          `password` varchar(255) NOT NULL,
          `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

        "CREATE TABLE IF NOT EXISTS `contents` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `title` varchar(255) NOT NULL,
          `slug` varchar(255) NOT NULL UNIQUE,
          `summary` text,
          `body` longtext,
          `image` varchar(255) DEFAULT NULL,
          `status` tinyint(1) DEFAULT 1,
          `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
          `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

        "CREATE TABLE IF NOT EXISTS `settings` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_title` varchar(255) DEFAULT 'My Website',
          `site_description` varchar(255),
          `contact_email` varchar(255),
          `contact_phone` varchar(50),
          `facebook_url` varchar(255),
          `instagram_url` varchar(255),
          `twitter_url` varchar(255),
          `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

        "INSERT INTO `settings` (`site_title`, `contact_email`) 
         SELECT 'My Website', 'admin@example.com' 
         WHERE NOT EXISTS (SELECT * FROM `settings`);"
    ];

    foreach ($queries as $sql) {
        $pdo->exec($sql);
    }

    echo "Tablolar başarıyla oluşturuldu.<br>";
    echo "<hr>";
    echo "<h3>Kurulum Tamamlandı!</h3>";
    echo "Lütfen sırasıyla şunları yapın:<br>";
    echo "1. <a href='create_admin.php' target='_blank'>Yönetici Oluştur (create_admin.php)</a><br>";
    echo "2. <a href='login.php' target='_blank'>Giriş Yap (login.php)</a><br>";

} catch (PDOException $e) {
    echo "<h3>HATA OLU�?TU:</h3>";
    echo "Mesaj: " . $e->getMessage() . "<br>";
    echo "Lütfen XAMPP MySQL servisinin çalıştığından ve şifrenin doğru olduğundan emin olun.<br>";
}
?>
