<?php 
session_start(); 

// Load configuration if exists, otherwise use defaults
if (file_exists(__DIR__ . '/config.php')) {
    require_once __DIR__ . '/config.php';
} else {
    if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
    if (!defined('DB_PORT')) define('DB_PORT', '3307');
    if (!defined('DB_NAME')) define('DB_NAME', 'crud');
    if (!defined('DB_USER')) define('DB_USER', 'root');
    if (!defined('DB_PASS')) define('DB_PASS', '');
}

$databaseHost = "mysql:host=" . DB_HOST . ":" . DB_PORT . ";dbname=" . DB_NAME;
$databaseUser = DB_USER;
$databasePass = DB_PASS;

try {
    $pdo = new PDO($databaseHost, $databaseUser, $databasePass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Connection ERROR!: " . $e->getMessage());
    die("A database connection error occurred. Please try again later.");
}
?>
