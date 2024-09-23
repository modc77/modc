CREATE TABLE `users` (
  `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
  `firstname` VARCHAR(50) NOT NULL,
  `lastname` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `phone` VARCHAR(15) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'user') DEFAULT 'user',
  `RecommendedID` VARCHAR(8) NOT NULL UNIQUE,
  `referred_by` VARCHAR(8),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `recommendations` (
  `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT(11) NOT NULL,
  `recommended_id` VARCHAR(8) NOT NULL UNIQUE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);
