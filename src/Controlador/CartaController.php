<?php

namespace App\Controlador;

use App\Modelo\Plato;

class CartaController
{
    private Plato $modelo;

    public function __construct()
    {
        $this->modelo = new Plato();
    }

    public function mostrarCarta(): void
    {
        $buscar = trim($_GET['buscar'] ?? '');
        $categoria = trim($_GET['categoria'] ?? '');

        $platos = $this->modelo->buscar($buscar, $categoria);
        $categorias = $this->modelo->obtenerCategorias();

        $mensaje = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombreCliente = trim($_POST['nombre'] ?? '');
            $platoPedido = trim($_POST['plato'] ?? '');
            $cantidad = (int) ($_POST['cantidad'] ?? 0);

            if (
                $nombreCliente !== '' &&
                $platoPedido !== '' &&
                $cantidad > 0
            ) {
                $mensaje = "Pedido recibido correctamente. Gracias, {$nombreCliente}.";
            } else {
                $mensaje = "Por favor, complete correctamente todos los campos.";
            }
        }

        $todosLosPlatos = $this->modelo->obtenerPlatos();

        require __DIR__ . '/../Vista/carta.php';
    }
}