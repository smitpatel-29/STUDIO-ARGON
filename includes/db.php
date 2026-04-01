<?php
/**
 * Database Connection for Studio Argon Dynamic Portfolio
 */

// PRODUCTION DATABASE (Active)
$db_host = 'localhost';
$db_user = 'starlitc_argon';
$db_pass = 'Smit!@1234';
$db_name = 'starlitc_studio_argon';

// LOCAL DATABASE (XAMPP - Commented)
// $db_host = '127.0.0.1';
// $db_user = 'root';
// $db_pass = 'Smit!@1234';
// $db_name = 'studio_argon';

try {
    // Connect to the database directly
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    // Show a cleaner error in production
    die("Server Error: Database connection failed. Please contact your administrator.");
}
?>