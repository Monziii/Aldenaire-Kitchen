<?php
// db.php
$host = 'localhost';
$db = 'Aldenaire_Kitchen';
$user = 'root'; 
$pass = '';  
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo "Error connecting to database: " . $e->getMessage();
    exit;
}
?>
