<?php

header("Content-Type: application/json");

require_once "dto/VentaDTO.php";
require_once "transformadores/TransformadorVenta.php";
require_once "conectores/ConectorStock.php";
require_once "conectores/ConectorStockHttp.php";
require_once "servicios/ServicioVentas.php";
require_once "controladores/ControladorVentas.php";


$transformadorVenta = new TransformadorVenta();


$conectorStock = new ConectorStockHttp(
    "http://localhost/Solid/integracion-ventas-stock/sistemaB/movimiento.php"
);


$servicioVentas = new ServicioVentas(
    $transformadorVenta,
    $conectorStock
);


$controladorVentas = new ControladorVentas(
    $servicioVentas
);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $controladorVentas->recibirVenta();

} else {

    http_response_code(405);

    echo json_encode([
        "error" => "Metodo no permitido"
    ]);
}