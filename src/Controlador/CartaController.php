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
        $mensaje = '';

        /*
         * =====================================================
         * AGREGAR NUEVO PLATO
         * =====================================================
         */
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['accion'])
            && $_POST['accion'] === 'agregar_plato'
        ) {
            $resultado = $this->agregarPlato();

            if ($resultado === true) {
                $mensaje = 'El plato se guardó correctamente.';
            } else {
                $mensaje = $resultado;
            }
        }


        /*
         * =====================================================
         * BUSCADOR
         * =====================================================
         */
        $buscar = trim(
            $_GET['buscar'] ?? ''
        );

        $categoria = trim(
            $_GET['categoria'] ?? ''
        );


        /*
         * =====================================================
         * OBTENER PLATOS
         * =====================================================
         */
        $platos = $this->modelo->buscar(
            $buscar,
            $categoria
        );


        /*
         * =====================================================
         * CATEGORÍAS
         * =====================================================
         */
        $categorias =
            $this->modelo->obtenerCategorias();


        /*
         * =====================================================
         * PROCESAR PEDIDO
         * =====================================================
         */
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && !isset($_POST['accion'])
        ) {

            $nombreCliente = trim(
                $_POST['nombre'] ?? ''
            );

            $platoPedido = trim(
                $_POST['plato'] ?? ''
            );

            $cantidad = (int) (
                $_POST['cantidad'] ?? 0
            );


            if (
                $nombreCliente !== ''
                && $platoPedido !== ''
                && $cantidad > 0
            ) {

                $mensaje =
                    'Pedido recibido correctamente. Gracias, '
                    . $nombreCliente
                    . '.';

            } else {

                $mensaje =
                    'Por favor, complete correctamente todos los campos.';
            }
        }


        /*
         * =====================================================
         * TODOS LOS PLATOS
         * =====================================================
         */
        $todosLosPlatos =
            $this->modelo->obtenerPlatos();


        /*
         * =====================================================
         * CARGAR VISTA
         * =====================================================
         */
        require __DIR__ . '/../Vista/carta.php';
    }


    /*
     * =========================================================
     * AGREGAR PLATO
     * =========================================================
     */
    private function agregarPlato(): bool|string
    {
        /*
         * Obtener datos
         */
        $nombre = trim(
            $_POST['nombre'] ?? ''
        );

        $categoria = trim(
            $_POST['categoria'] ?? ''
        );

        $precio = (float) (
            $_POST['precio'] ?? 0
        );

        $descripcion = trim(
            $_POST['descripcion'] ?? ''
        );


        /*
         * =====================================================
         * VALIDACIÓN
         * =====================================================
         */
        if ($nombre === '') {
            return 'Debe ingresar el nombre del plato.';
        }

        if ($categoria === '') {
            return 'Debe ingresar la categoría.';
        }

        if ($precio <= 0) {
            return 'El precio debe ser mayor que 0.';
        }

        if ($descripcion === '') {
            return 'Debe ingresar la descripción.';
        }


        /*
         * =====================================================
         * IMAGEN
         * =====================================================
         */
        $imagen =
            $this->subirImagen();


        /*
         * =====================================================
         * GUARDAR EN JSON
         * =====================================================
         */
        $guardado =
            $this->modelo->guardar([
                'nombre' => $nombre,
                'categoria' => $categoria,
                'precio' => $precio,
                'descripcion' => $descripcion,
                'imagen' => $imagen
            ]);


        /*
         * =====================================================
         * RESULTADO
         * =====================================================
         */
        if ($guardado) {
            return true;
        }


        return 'No se pudo guardar el plato en el archivo JSON.';
    }


    /*
     * =========================================================
     * SUBIR IMAGEN
     * =========================================================
     */
    private function subirImagen(): string
    {
        /*
         * No se seleccionó imagen
         */
        if (
            !isset($_FILES['imagen'])
            || $_FILES['imagen']['error'] === UPLOAD_ERR_NO_FILE
        ) {
            return 'default.jpg';
        }


        /*
         * Error de subida
         */
        if (
            $_FILES['imagen']['error'] !== UPLOAD_ERR_OK
        ) {
            return 'default.jpg';
        }


        $archivoTemporal =
            $_FILES['imagen']['tmp_name'];

        $nombreOriginal =
            $_FILES['imagen']['name'];


        /*
         * Obtener extensión
         */
        $extension =
            strtolower(
                pathinfo(
                    $nombreOriginal,
                    PATHINFO_EXTENSION
                )
            );


        /*
         * Extensiones permitidas
         */
        $permitidas = [
            'jpg',
            'jpeg',
            'png',
            'gif',
            'webp'
        ];


        if (
            !in_array(
                $extension,
                $permitidas,
                true
            )
        ) {
            return 'default.jpg';
        }


        /*
         * Crear nombre único
         */
        $nombreNuevo =
            'plato_'
            . uniqid()
            . '.'
            . $extension;


        /*
         * Carpeta uploads
         */
        $carpeta =
            __DIR__
            . '/../../public/uploads/';


        /*
         * Crear carpeta
         */
        if (!is_dir($carpeta)) {

            mkdir(
                $carpeta,
                0777,
                true
            );
        }


        /*
         * Ruta final
         */
        $destino =
            $carpeta
            . $nombreNuevo;


        /*
         * Mover imagen
         */
        if (
            move_uploaded_file(
                $archivoTemporal,
                $destino
            )
        ) {
            return $nombreNuevo;
        }


        return 'default.jpg';
    }
}