<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = 'Smit!@1234';

try {
    echo "Connecting to MySQL server...<br>";
    $pdo = new PDO("mysql:host=$db_host", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully to MySQL server!<br>";
    
    $db_name = 'studio_argon';
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Database '$db_name' ensured.<br>";
    
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    echo "Connected successfully to specific database '$db_name'!";
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
