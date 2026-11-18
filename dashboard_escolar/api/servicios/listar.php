<?php

header('Content-Type: application/json; charset=utf-8');

require_once '../conexion.php';
require_once '../helpers.php';

exigir_metodo('GET');

$sql = "SELECT id, nombre, categoria, descripcion, horario, ubicacion, activo
        FROM servicios
        ORDER BY nombre";

$stmt = $pdo->query($sql);

$servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);

http_response_code(200);

echo json_encode($servicios, JSON_UNESCAPED_UNICODE);
