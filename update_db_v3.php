<?php
require_once 'includes/db.php';

try {
    // 1. Home Slides Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `home_slides` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(255) NOT NULL,
        `subtitle` VARCHAR(255),
        `image_url` VARCHAR(255) NOT NULL,
        `button_text` VARCHAR(50) DEFAULT 'Our Works',
        `button_link` VARCHAR(255) DEFAULT 'portfolio.php',
        `order_index` INT DEFAULT 0
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // 2. Client Logos/Names Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `home_clients` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(100) NOT NULL,
        `order_index` INT DEFAULT 0
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // 3. Stats Section Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `home_stats` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `label` VARCHAR(100) NOT NULL,
        `value` INT NOT NULL,
        `icon` VARCHAR(50),
        `order_index` INT DEFAULT 0
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // 4. Testimonials Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `home_testimonials` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `client_name` VARCHAR(100) NOT NULL,
        `client_role` VARCHAR(100),
        `client_avatar` VARCHAR(255),
        `testimonial` TEXT NOT NULL,
        `order_index` INT DEFAULT 0
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Seed Initial Data
    // Slides
    $pdo->exec("INSERT IGNORE INTO home_slides (title, image_url, button_text) VALUES 
    ('ULTIMATE PRECISION IN EVERY PIXEL', 'assets/uploads/hero-new.png', 'Our Works'),
    ('CRAFTING FUTURE IN 3D VIZ', 'assets/uploads/hero-slide-2.png', 'Get Quotation'),
    ('CINEMATIC STORYTELLING', 'assets/uploads/hero-slide-3.png', 'Learn More')");

    // Clients
    $clients = ['GENSLER', 'SOM ARCHITECTS', 'PERKINS & WILL', 'HOK GROUP', 'ZAHA HADID', 'BIG ARCH', 'FOSTER + PARTNERS'];
    $stmt = $pdo->prepare("INSERT IGNORE INTO home_clients (name) VALUES (?)");
    foreach($clients as $c) $stmt->execute([$c]);

    // Stats
    $stats = [
        ['PROJECTS COMPLETED', 850],
        ['HAPPY CLIENTS', 120],
        ['YEARS EXPERIENCE', 10],
        ['INDUSTRY AWARDS', 15]
    ];
    $stmt = $pdo->prepare("INSERT IGNORE INTO home_stats (label, value) VALUES (?, ?)");
    foreach($stats as $s) $stmt->execute($s);

    // Testimonials
    $testimonials = [
        ['JULIAN V.', 'CHIEF ARCHITECT', 'assets/uploads/avatar_julian.jpg', '"Studio Argon\'s attention to detail is unmatched. They brought our vision to life with stunning realism."'],
        ['SARAH L.', 'RE DEVELOPER', 'assets/uploads/avatar_sarah.jpg', '"The animation they produced helped us close the deal on our latest development project effortlessly."'],
        ['MARC CHEN', 'INTERIOR DESIGNER', 'assets/uploads/avatar_marc.jpg', '"Fast, professional, and incredibly talented. They are our go-to for all 3D visualization needs."']
    ];
    $stmt = $pdo->prepare("INSERT IGNORE INTO home_testimonials (client_name, client_role, client_avatar, testimonial) VALUES (?, ?, ?, ?)");
    foreach($testimonials as $t) $stmt->execute($t);

    echo "Home page dynamic tables created and seeded successfully.";

} catch (PDOException $e) {
    die("Database update failed: " . $e->getMessage());
}
