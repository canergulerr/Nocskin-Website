<?php
require_once 'includes/db.php';

try {
    // 1. Footer Settings Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS footer_settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        newsletter_title VARCHAR(255),
        newsletter_description TEXT,
        newsletter_disclaimer TEXT,
        social_facebook VARCHAR(255),
        social_instagram VARCHAR(255),
        social_youtube VARCHAR(255),
        social_tiktok VARCHAR(255),
        copyright_text TEXT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Check if table is empty, if so, seed it
    $stmt = $pdo->query("SELECT COUNT(*) FROM footer_settings");
    if ($stmt->fetchColumn() == 0) {
        $sql = "INSERT INTO footer_settings (newsletter_title, newsletter_description, newsletter_disclaimer, social_facebook, social_instagram, social_youtube, social_tiktok, copyright_text) VALUES (
            'Haberdar olun.', 
            'Bilimsel olarak desteklenen ipuçları, özel tekliflere erişim ve yeni yenilikler almak için abone olun.', 
            '*E-posta adresinizi vererek, UNITAB, bağlı kuruluşları, markaları (NOC, Neat Ordinary, Dr.Roscher ve The Medicus) ve/veya pazarlama ortaklarından e-posta iletişimleri almayı kabul etmiş olursunuz. Bu, istediğiniz zaman değiştirilebilir. Daha fazla bilgi için lütfen Gizlilik Politikamıza ve Kullanım Koşullarımıza bakın veya Bize Ulaşın.', 
            'theordinary', 
            'theordinary/index.htm', 
            'deciem', 
            '@theordinary', 
            '© NOC. 2026. Tüm hakları saklıdır.'
        )";
        $pdo->exec($sql);
        echo "Inserted default footer settings.\n";
    }

    // 2. Alter Menus Table for Location
    // Check if column exists first to avoid error
    $colCheck = $pdo->query("SHOW COLUMNS FROM menus LIKE 'location'");
    if ($colCheck->rowCount() == 0) {
        $pdo->exec("ALTER TABLE menus ADD COLUMN location VARCHAR(50) DEFAULT 'header'");
        echo "Added 'location' column to menus table.\n";
    }

    // 3. Seed Footer Menu Data
    // We will insert 'footer_column' items.

    // Helper to insert menu item
    function insertMenu($title, $url, $parentId, $position, $location)
    {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO menus (parent_id, title, url, position, status, location) VALUES (?, ?, ?, ?, 1, ?)");
        $stmt->execute([$parentId, $title, $url, $position, $location]);
        return $pdo->lastInsertId();
    }

    // Only seed if no footer menus exist
    $checkFooter = $pdo->query("SELECT COUNT(*) FROM menus WHERE location LIKE 'footer%'");
    if ($checkFooter->fetchColumn() == 0) {

        // Column 1: Şirket
        $p1 = insertMenu('Şirket', '#', 0, 1, 'footer_column');
        insertMenu('Hakkımızda', 'en-us/about-us', $p1, 1, 'footer_column');
        insertMenu('Bize Katılın', 'en-us/join-us', $p1, 2, 'footer_column');
        insertMenu('Tedarik Zincirlerinde Şeffaflık', 'en-us/supply-chain-transparency', $p1, 3, 'footer_column');

        // Column 2: Taahhütlerimiz
        $p2 = insertMenu('Taahhütlerimiz', '#', 0, 2, 'footer_column');
        insertMenu('Erişilebilirlik', 'en-us/accessibility', $p2, 1, 'footer_column');
        insertMenu('Sürdürülebilirlik', 'en-us/deciem-earth', $p2, 2, 'footer_column');
        insertMenu('Değişim Yolculuktur', 'en-us/changeisthejourney', $p2, 3, 'footer_column');
        insertMenu('Her Şey Kimyasaldır', 'en-us/everything-is-chemicals', $p2, 4, 'footer_column');

        // Column 3: Müşteri Hizmetleri
        $p3 = insertMenu('Müşteri Hizmetleri', '#', 0, 3, 'footer_column');
        insertMenu('SSS', 'en-us/faq', $p3, 1, 'footer_column');
        insertMenu('Atık Talimatları', 'en-us/disposal-instructions', $p3, 2, 'footer_column');
        insertMenu('İade politikasi', 'en-us/returns', $p3, 3, 'footer_column');
        insertMenu('Promosyon Şartları ve Koşulları', 'en-us/promotional-offer-terms', $p3, 4, 'footer_column');

        // Column 4: Hediye Kartları
        $p4 = insertMenu('Hediye Kartları', '#', 0, 4, 'footer_column');
        insertMenu('Satın Almak', 'en-us/gift-card-100570', $p4, 1, 'footer_column');
        insertMenu('Bakiyeyi Kontrol Et', 'en-us/check-balance', $p4, 2, 'footer_column');

        // Column 5: Storefront Links (Using a header-like approach or just another column)
        // In the HTML it's "storefront-links" 
        // We'll treat it as a column named "Hızlı Erişim" for example, or just hidden title
        $p5 = insertMenu('Hızlı Erişim', '#', 0, 5, 'footer_column');
        insertMenu('Bize Ulaşın', 'en-us/contact-us', $p5, 1, 'footer_column');
        insertMenu('Sipariş Takibi', 'en-us/order-lookup', $p5, 2, 'footer_column');
        insertMenu('Giriş Yap', 'en-us/login', $p5, 3, 'footer_column');
        insertMenu('Mağaza Bulucu', 'en-us/find-us', $p5, 4, 'footer_column');

        // Footer Bottom Links (Legal)
        insertMenu('Şartlar ve Koşullar', 'en-us/terms', 0, 1, 'footer_bottom');
        insertMenu('Gizlilik Politikası', 'en-us/privacy-policy', 0, 2, 'footer_bottom');
        insertMenu('Kişisel bilgilerimi satmayın', 'en-us/do-not-sell', 0, 3, 'footer_bottom');
        insertMenu('Çerezler', '#cookie-settings', 0, 4, 'footer_bottom');
        insertMenu('A UNITAB PROJESİ.', 'en-us/deciem-about', 0, 5, 'footer_bottom'); // Brand link

        echo "Seeded footer menus.\n";
    }

    echo "Database setup completed successfully.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>