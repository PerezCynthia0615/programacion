<?php
$host = 'localhost';
$db = 'dashboard_escolar';
$user = 'root';
$pass = '';
try {
$pdo = new PDO(
"mysql:host=$host;dbname=$db;charset=utf8mb4",
$user,
$pass
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
http_response_code(500);
header('Content-Type: application/json');
echo json_encode(['ok' => false, 'error' => 'No se pudo conectar a la BD', 'mensaje' => 'No se pudo conectar a la BD']);
exit;
}