<?php
require_once 'includes/db.php';

try {
    // 1. Create site_content table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `site_content` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `page_slug` VARCHAR(50) NOT NULL,
        `section_slug` VARCHAR(50) NOT NULL,
        `heading` VARCHAR(255),
        `content` TEXT,
        `image_url` VARCHAR(255),
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY `page_section` (`page_slug`, `section_slug`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // 2. Create contact_messages table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `contact_messages` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(100) NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `phone` VARCHAR(20),
        `service` VARCHAR(100),
        `message` TEXT,
        `status` ENUM('new', 'read', 'archived') DEFAULT 'new',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // 3. Seed initial content for Home page
    $homeContent = [
        ['home', 'hero', 'CRAFTING VISIONS INTO REALITY', 'Precision 3D rendering and cinematic storytelling for global architecture.', 'assets/uploads/hero-bg.jpg'],
        ['home', 'welcome', 'WELCOME TO STUDIO ARGON', 'We are a boutique visualization studio based in Houston, specialzing in high-end architectural renders.', '']
    ];

    $stmt = $pdo->prepare("INSERT IGNORE INTO site_content (page_slug, section_slug, heading, content, image_url) VALUES (?, ?, ?, ?, ?)");
    foreach ($homeContent as $row) {
        $stmt->execute($row);
    }

    // 4. Seed About page
    $aboutContent = [
        ['about', 'hero', 'ABOUT STUDIO ARGON', 'Crafting visual excellence for global architecture since 2014.', 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=2070'],
        ['about', 'mission', 'OUR MISSION', 'To provide architects and developers with the most photorealistic visualization tools to sell their vision.', '']
    ];
    foreach ($aboutContent as $row) {
        $stmt->execute($row);
    }

    // 5. Seed Contact page
    $contactContent = [
        ['contact', 'hero', 'LET\'S TALK', 'Ready to start your project? We\'d love to hear from you.', 'https://images.unsplash.com/photo-1519643381401-22c77e60520e?auto=format&fit=crop&q=80&w=2070'],
        ['contact', 'info', 'CONTACT INFO', 'Texas, USA. Serving clients worldwide.', '']
    ];
    foreach ($contactContent as $row) {
        $stmt->execute($row);
    }

    echo "Database updated successfully with Pages and Messages tables.";

} catch (PDOException $e) {
    die("Database update failed: " . $e->getMessage());
}
