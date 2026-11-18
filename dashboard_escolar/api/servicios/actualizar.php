<?php

header('Content-Type: application/json; charset=utf-8');

require_once '../conexion.php';
require_once '../helpers.php';

exigir_metodo('PUT');

$datos = json_decode(file_get_contents('php://input'), true);

if (!$datos || empty($datos['id']) || empty($datos['nombre'])) {
    http_response_code(400);
    echo json_encode([
        'ok' => false,
        'error' => 'ID y nombre son obligatorios',
        'mensaje' => 'ID y nombre son obligatorios'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$id = $datos['id'];
$nombre = $datos['nombre'];
$categoria = $datos['categoria'] ?? null;
$descripcion = $datos['descripcion'] ?? null;
$horario = $datos['horario'] ?? null;
$ubicacion = $datos['ubicacion'] ?? null;

$existe = $pdo->prepare('SELECT 1 FROM servicios WHERE id = ?');
$existe->execute([$id]);
if (!$existe->fetchColumn()) {
    error_json(404, 'Servicio no encontrado');
}

$sql = "UPDATE servicios
        SET nombre = :nombre,
            categoria = :categoria,
            descripcion = :descripcion,
            horario = :horario,
            ubicacion = :ubicacion
        WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':id' => $id,
    ':nombre' => $nombre,
    ':categoria' => $categoria,
    ':descripcion' => $descripcion,
    ':horario' => $horario,
    ':ubicacion' => $ubicacion
]);

echo json_encode([
    'ok' => true,
    'mensaje' => 'Servicio actualizado'
], JSON_UNESCAPED_UNICODE);
