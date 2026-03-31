<?php
/**
 * Database Connection for Studio Argon Dynamic Portfolio
 */

$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = 'Smit!@1234';
$db_name = 'studio_argon';

try {
    // Connect to MySQL server first to ensure DB exists
    $pdo_setup = new PDO("mysql:host=$db_host", $db_user, $db_pass);
    $pdo_setup->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo_setup->exec("CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    
    // Connect to the specific database
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    // In production, log this and show a friendly message
    die("Database connection failed: " . $e->getMessage());
}
?>
    