<?php
/**
 * Database Migration Script for Studio Argon
 * This script creates necessary tables and migrates data from config.php
 */

require_once 'includes/db.php';
require_once 'includes/config.php';

try {
    // 1. Create the portfolio table
    $createPortfolioTable = "CREATE TABLE IF NOT EXISTS `portfolio` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(255) NOT NULL,
        `category` VARCHAR(50) NOT NULL,
        `image` VARCHAR(255) NOT NULL,
        `tools` TEXT,
        `year` VARCHAR(10),
        `description` TEXT,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    $pdo->exec($createPortfolioTable);
    echo "Portfolio table created or already exists.<br>";

    // 2. Create the blog_posts table
    $createBlogTable = "CREATE TABLE IF NOT EXISTS `blog_posts` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(255) NOT NULL,
        `date` VARCHAR(50) NOT NULL,
        `excerpt` TEXT,
        `image` VARCHAR(255) NOT NULL,
        `category` VARCHAR(50) NOT NULL,
        `tag` VARCHAR(50) NOT NULL,
        `author` VARCHAR(100) NOT NULL,
        `author_img` VARCHAR(255) NOT NULL,
        `content` LONGTEXT,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $pdo->exec($createBlogTable);
    echo "Blog posts table created or already exists.<br>";

    // 3. Create the admins table
    $createAdminsTable = "CREATE TABLE IF NOT EXISTS `admins` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `username` VARCHAR(50) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL,
        `email` VARCHAR(100) NOT NULL UNIQUE,
        `full_name` VARCHAR(100) NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $pdo->exec($createAdminsTable);
    echo "Admins table created or already exists.<br>";
    
    // 4. Migrate Portfolio data from config.php if the table is empty
    $checkPortfolio = $pdo->query("SELECT COUNT(*) FROM `portfolio` LIMIT 1");
    if ($checkPortfolio->fetchColumn() == 0) {
        $insertPortfolio = $pdo->prepare("INSERT INTO `portfolio` (title, category, image, tools, year, description) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($portfolio_items as $item) {
            $insertPortfolio->execute([
                $item['title'],
                $item['category'],
                $item['image'],
                $item['tools'] ?? '',
                $item['year'] ?? '',
                $item['desc'] ?? ''
            ]);
        }
        echo "Portfolio data migrated from config.php.<br>";
    }

    // 5. Migrate Blog data from config.php if the table is empty
    $checkBlog = $pdo->query("SELECT COUNT(*) FROM `blog_posts` LIMIT 1");
    if ($checkBlog->fetchColumn() == 0) {
        $insertBlog = $pdo->prepare("INSERT INTO `blog_posts` (title, date, excerpt, image, category, tag, author, author_img) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        foreach ($blog_posts as $post) {
            $insertBlog->execute([
                $post['title'],
                $post['date'],
                $post['excerpt'],
                $post['image'],
                $post['category'],
                $post['tag'],
                $post['author'],
                $post['author_img']
            ]);
        }
        echo "Blog data migrated from config.php.<br>";
    }

    // 6. Create default admin if none exists
    $checkAdmin = $pdo->query("SELECT COUNT(*) FROM `admins` LIMIT 1");
    if ($checkAdmin->fetchColumn() == 0) {
        $username = 'admin';
        $password = password_hash('admin123', PASSWORD_DEFAULT);
        $email = 'admin@studioargon.com';
        $full_name = 'Systems Admin';
        
        $insertAdmin = $pdo->prepare("INSERT INTO `admins` (username, password, email, full_name) VALUES (?, ?, ?, ?)");
        $insertAdmin->execute([$username, $password, $email, $full_name]);
        echo "Default admin user created (Username: admin, Password: admin123).<br>";
    }
    
    echo "<br>Setup finished successfully!";
    
} catch (PDOException $e) {
    die("Setup failed: " . $e->getMessage());
}
?>

