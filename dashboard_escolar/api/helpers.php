<?php
// Utilidades compartidas por la API (agregado en v0.3-quality-review)

function responder_json(int $codigo, array $cuerpo): void {
    http_response_code($codigo);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($cuerpo, JSON_UNESCAPED_UNICODE);
    exit;
}

function error_json(int $codigo, string $mensaje): void {
    responder_json($codigo, ['ok' => false, 'error' => $mensaje, 'mensaje' => $mensaje]);
}

// BUG-002: cada endpoint declara el método HTTP que acepta
function exigir_metodo(string $metodo): void {
    if ($_SERVER['REQUEST_METHOD'] !== $metodo) {
        header('Allow: ' . $metodo);
        error_json(405, "Método no permitido. Use $metodo");
    }
}

// BUG-005: errores de BD inesperados -> JSON 500 sin filtrar detalles internos
set_exception_handler(function (Throwable $e) {
    error_log($e->getMessage());
    error_json(500, 'Error interno del servidor');
});
