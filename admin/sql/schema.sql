-- Admin Users Table
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Contents/Pages Table
CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `summary` text,
  `body` longtext,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1, -- 1: Active, 0: Passive
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Settings Table
CREATE TABLE IF NOT EXISTS `settings` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Default Settings
INSERT INTO `settings` (`site_title`, `contact_email`) 
SELECT 'My Website', 'admin@example.com' 
WHERE NOT EXISTS (SELECT * FROM `settings`);
