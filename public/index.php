<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controlador\CartaController;

$controlador = new CartaController();

$controlador->mostrarCarta();