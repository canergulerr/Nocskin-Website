CREATE TABLE IF NOT EXISTS `slider_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('image','video') NOT NULL DEFAULT 'image',
  `media_url` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `button_text` varchar(100) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `order_index` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
