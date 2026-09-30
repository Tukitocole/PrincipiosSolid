<?php

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    http_response_code(405);

    echo json_encode([
        "error" => "Metodo no permitido"
    ]);

    exit;
}

$datos = json_decode(
    file_get_contents("php://input"),
    true
);

if ($datos === null) {

    http_response_code(400);

    echo json_encode([
        "error" => "JSON invalido"
    ]);

    exit;
}

echo json_encode([
    "mensaje" => "Movimiento de stock recibido correctamente",
    "movimiento" => $datos
]);