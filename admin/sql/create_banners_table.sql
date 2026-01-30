CREATE TABLE IF NOT EXISTS banners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_identifier VARCHAR(50) NOT NULL,
    image_desktop VARCHAR(255) NOT NULL,
    image_mobile VARCHAR(255),
    title VARCHAR(255),
    description TEXT,
    button_text VARCHAR(100),
    button_url VARCHAR(255),
    shop_link_text VARCHAR(100),
    shop_link_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
