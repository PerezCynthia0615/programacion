<?php

header('Content-Type: application/json; charset=utf-8');

require_once '../conexion.php';
require_once '../helpers.php';

exigir_metodo('GET');

$semestre = $_GET['semestre'] ?? null;

if ($semestre !== null) {
    $sql = "SELECT id, nombre, semestre, modulo, activo
            FROM materias
            WHERE semestre = ?
            ORDER BY nombre";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$semestre]);
} else {
    $sql = "SELECT id, nombre, semestre, modulo, activo
            FROM materias
            ORDER BY nombre";

    $stmt = $pdo->query($sql);
}

$materias = $stmt->fetchAll(PDO::FETCH_ASSOC);

http_response_code(200);

echo json_encode($materias, JSON_UNESCAPED_UNICODE);
