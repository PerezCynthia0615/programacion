<?php
$host = 'localhost';
$db = 'dashboard_escolar';
$user = 'root';
$pass = '';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
try {
 $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
 exit('No fue posible conectar con la base de datos.');
}
?>
