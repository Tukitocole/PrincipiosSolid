<?php

class ServicioVentas
{
    private $transformadorVenta;
    private $conectorStock;

    public function __construct(
        $transformadorVenta,
        ConectorStock $conectorStock
    ) {
        $this->transformadorVenta = $transformadorVenta;
        $this->conectorStock = $conectorStock;
    }

    public function procesarVenta(VentaDTO $venta)
    {
        $movimiento = $this->transformadorVenta
            ->transformar($venta);

        return $this->conectorStock
            ->enviarMovimiento($movimiento);
    }
}