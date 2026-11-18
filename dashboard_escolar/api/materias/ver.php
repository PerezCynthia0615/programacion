<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../conexion.php';
require_once '../helpers.php';
exigir_metodo('GET');
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
error_json(400, 'ID inválido');
}
$stmt = $pdo->prepare('SELECT * FROM materias WHERE id = ?');
$stmt->execute([$id]);
$materia = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$materia) {
error_json(404, 'Materia no encontrada');
}
echo json_encode($materia, JSON_UNESCAPED_UNICODE);
