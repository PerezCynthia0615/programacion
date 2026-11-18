<?php

header('Content-Type: application/json; charset=utf-8');

require_once '../conexion.php';
require_once '../helpers.php';

exigir_metodo('DELETE');

$id = $_GET['id'] ?? null;

if (!$id) {
    http_response_code(400);
    echo json_encode([
        'ok' => false,
        'error' => 'El ID es obligatorio',
        'mensaje' => 'El ID es obligatorio'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "DELETE FROM servicios WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':id' => $id
]);

if ($stmt->rowCount() === 0) {
    http_response_code(404);
    echo json_encode([
        'ok' => false,
        'error' => 'Servicio no encontrado',
        'mensaje' => 'Servicio no encontrado'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

echo json_encode([
    'ok' => true,
    'mensaje' => 'Servicio eliminado'
], JSON_UNESCAPED_UNICODE);
