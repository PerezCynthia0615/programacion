<?php

header('Content-Type: application/json; charset=utf-8');

require_once '../conexion.php';
require_once '../helpers.php';

exigir_metodo('POST');

$datos = json_decode(file_get_contents('php://input'), true);

if (!$datos || empty($datos['nombre'])) {
    http_response_code(400);
    echo json_encode([
        'ok' => false,
        'error' => 'El nombre es obligatorio',
        'mensaje' => 'El nombre es obligatorio'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$nombre = $datos['nombre'];
$categoria = $datos['categoria'] ?? null;
$descripcion = $datos['descripcion'] ?? null;
$horario = $datos['horario'] ?? null;
$ubicacion = $datos['ubicacion'] ?? null;

$sql = "INSERT INTO servicios
        (nombre, categoria, descripcion, horario, ubicacion, activo)
        VALUES
        (:nombre, :categoria, :descripcion, :horario, :ubicacion, 1)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':nombre' => $nombre,
    ':categoria' => $categoria,
    ':descripcion' => $descripcion,
    ':horario' => $horario,
    ':ubicacion' => $ubicacion
]);

$id = $pdo->lastInsertId();

http_response_code(201);

echo json_encode([
    'ok' => true,
    'id' => $id,
    'mensaje' => 'Servicio creado'
], JSON_UNESCAPED_UNICODE);
