<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>El Encanto Campestre - Carta Digital</title>

    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

    <header class="hero">

        <div class="hero-contenido">

            <p class="subtitulo">RESTAURANTE CAMPESTRE</p>

            <h1>El Encanto Campestre</h1>

            <p>
                Sabores tradicionales en un ambiente natural
            </p>

            <a href="#carta" class="boton">
                Ver nuestra carta
            </a>

        </div>

    </header>


    <main>

        <section id="carta" class="contenedor">

            <div class="titulo-seccion">

                <h2>Nuestra Carta</h2>

                <p>
                    Disfruta nuestros platos preparados con ingredientes
                    seleccionados y el auténtico sabor campestre.
                </p>

            </div>


            <!-- FORMULARIO GET -->

            <form method="GET" action="index.php" class="buscador">

                <input
                    type="text"
                    name="buscar"
                    placeholder="Buscar un plato..."
                    value="<?= htmlspecialchars($buscar) ?>"
                >

                <select name="categoria">

                    <option value="">
                        Todas las categorías
                    </option>

                    <?php foreach ($categorias as $cat): ?>

                        <option
                            value="<?= htmlspecialchars($cat) ?>"
                            <?= $categoria === $cat ? 'selected' : '' ?>
                        >
                            <?= htmlspecialchars($cat) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

                <button type="submit">
                    Buscar
                </button>

                <a href="index.php" class="limpiar">
                    Limpiar
                </a>

            </form>


            <!-- MENÚ DIGITAL -->

            <div class="grid-platos">

                <?php if (empty($platos)): ?>

                    <div class="sin-resultados">

                        <h3>No encontramos platos</h3>

                        <p>
                            Intenta realizar otra búsqueda.
                        </p>

                    </div>

                <?php else: ?>

                    <?php foreach ($platos as $plato): ?>

                        <article class="plato">

                            <div class="imagen-plato">

                                <img
                                    src="img/<?= htmlspecialchars($plato['imagen']) ?>"
                                    alt="<?= htmlspecialchars($plato['nombre']) ?>"
                                >

                            </div>

                            <div class="contenido-plato">

                                <span class="categoria">
                                    <?= htmlspecialchars($plato['categoria']) ?>
                                </span>

                                <h3>
                                    <?= htmlspecialchars($plato['nombre']) ?>
                                </h3>

                                <p>
                                    <?= htmlspecialchars($plato['descripcion']) ?>
                                </p>

                                <strong class="precio">
                                    S/ <?= number_format($plato['precio'], 2) ?>
                                </strong>

                            </div>

                        </article>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

        </section>


        <!-- FORMULARIO POST -->

        <section class="pedido">

            <div class="contenedor">

                <div class="titulo-seccion">

                    <h2>Realiza tu pedido</h2>

                    <p>
                        Completa el formulario y solicita tu plato favorito.
                    </p>

                </div>


                <?php if ($mensaje !== ''): ?>

                    <div class="mensaje">
                        <?= htmlspecialchars($mensaje) ?>
                    </div>

                <?php endif; ?>


                <form method="POST" action="index.php" class="formulario">

                    <div class="campo">

                        <label for="nombre">
                            Nombre del cliente
                        </label>

                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            placeholder="Ingrese su nombre"
                            required
                        >

                    </div>


                    <div class="campo">

                        <label for="plato">
                            Seleccione un plato
                        </label>

                        <select
                            id="plato"
                            name="plato"
                            required
                        >

                            <option value="">
                                Seleccione un plato
                            </option>

                            <?php foreach ($todosLosPlatos as $item): ?>

                                <option
                                    value="<?= htmlspecialchars($item['nombre']) ?>"
                                >
                                    <?= htmlspecialchars($item['nombre']) ?>
                                    - S/ <?= number_format($item['precio'], 2) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <div class="campo">

                        <label for="cantidad">
                            Cantidad
                        </label>

                        <input
                            type="number"
                            id="cantidad"
                            name="cantidad"
                            min="1"
                            value="1"
                            required
                        >

                    </div>


                    <button
                        type="submit"
                        class="boton-enviar"
                    >
                        Enviar pedido
                    </button>

                </form>

            </div>

        </section>

    </main>


    <footer>

        <p>
            © <?= date('Y') ?> El Encanto Campestre
        </p>

        <p>
            Restaurante campestre - Carta Digital
        </p>

    </footer>


    <script src="js/app.js"></script>

</body>

</html>