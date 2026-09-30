<?php

class ControladorVentas
{
    private $servicioVentas;

    public function __construct($servicioVentas)
    {
        $this->servicioVentas = $servicioVentas;
    }

    public function recibirVenta()
    {
        try {

            $datos = json_decode(
                file_get_contents("php://input"),
                true
            );

            if ($datos === null) {

                http_response_code(400);

                echo json_encode([
                    "error" => "El JSON recibido no es valido"
                ]);

                return;
            }

            $venta = new VentaDTO($datos);

            $resultado = $this->servicioVentas
                ->procesarVenta($venta);

            http_response_code(200);

            echo json_encode([
                "mensaje" => "Venta procesada correctamente",
                "respuestaSistemaB" => $resultado
            ]);

        } catch (Exception $error) {

            http_response_code(500);

            echo json_encode([
                "error" => $error->getMessage()
            ]);
        }
    }
}