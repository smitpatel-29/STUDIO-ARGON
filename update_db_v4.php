<?php
require_once 'includes/db.php';

try {
    // Media Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `media` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `filename` VARCHAR(255) NOT NULL,
        `filepath` VARCHAR(255) NOT NULL,
        `filetype` VARCHAR(50),
        `filesize` INT,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Ensure uploads directory exists
    $uploadDir = 'assets/uploads';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    echo "Media management table and structure initialized successfully.";
} catch (PDOException $e) {
    die("Database setup failed: " . $e->getMessage());
}
