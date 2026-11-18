<?php

header('Content-Type: application/json; charset=utf-8');

require_once '../conexion.php';
require_once '../helpers.php';

exigir_metodo('GET');

$sql = "SELECT DISTINCT categoria
        FROM servicios
        WHERE categoria IS NOT NULL
          AND categoria <> ''
        ORDER BY categoria";

$stmt = $pdo->query($sql);

$categorias = $stmt->fetchAll(PDO::FETCH_COLUMN);

http_response_code(200);

echo json_encode($categorias, JSON_UNESCAPED_UNICODE);
