<?php

class VentaDTO
{
    public $ventaId;
    public $fecha;
    public $cajeroId;
    public $productos;

    public function __construct($datos)
    {
        $this->ventaId = $datos["ventaId"];
        $this->fecha = $datos["fecha"];
        $this->cajeroId = $datos["cajeroId"];
        $this->productos = $datos["productos"];
    }
}