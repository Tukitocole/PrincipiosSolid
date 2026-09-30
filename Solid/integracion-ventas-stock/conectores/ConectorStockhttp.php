<?php

class ConectorStockHttp implements ConectorStock
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function enviarMovimiento($movimiento)
    {
        $datosJson = json_encode($movimiento);

        $opciones = [
            "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n",
            "content" => $datosJson,
            "ignore_errors" => true
            ]
        ];

        $contexto = stream_context_create($opciones);

        $respuesta = file_get_contents(
            $this->url,
            false,
            $contexto
        );

        if ($respuesta === false) {
            throw new Exception(
                "No se pudo conectar con el sistema B"
            );
        }

    $ch = curl_init('http://localhost/Solid/integracion-ventas-stock/index.php');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ['key' => 'value']);

    $response = curl_exec($ch);

        if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    }
    curl_close($ch);   
        return json_decode($respuesta, true);
    }
}