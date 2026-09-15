<?php

namespace App\Modelo;

class Plato
{
    private array $platos = [
        [
            'id' => 1,
            'nombre' => 'Pachamanca Tradicional',
            'descripcion' => 'Pachamanca preparada al estilo tradicional con carnes, papas y habas.',
            'precio' => 35.00,
            'categoria' => 'Platos típicos',
            'imagen' => 'pachamanca.jpg'
        ],
        [
            'id' => 2,
            'nombre' => 'Trucha Frita',
            'descripcion' => 'Trucha fresca acompañada de papas doradas y ensalada.',
            'precio' => 30.00,
            'categoria' => 'Platos típicos',
            'imagen' => 'trucha.jpg'
        ],
        [
            'id' => 3,
            'nombre' => 'Cuy al Horno',
            'descripcion' => 'Cuy preparado al horno acompañado de papas y ensalada.',
            'precio' => 45.00,
            'categoria' => 'Platos típicos',
            'imagen' => 'cuy.jpg'
        ],
        [
            'id' => 4,
            'nombre' => 'Parrilla Familiar',
            'descripcion' => 'Selección de carnes a la parrilla para compartir en familia.',
            'precio' => 60.00,
            'categoria' => 'Parrillas',
            'imagen' => 'parrilla.jpg'
        ],
        [
            'id' => 5,
            'nombre' => 'Chicharrón de Cerdo',
            'descripcion' => 'Chicharrón crocante acompañado de papas y ensalada.',
            'precio' => 28.00,
            'categoria' => 'Platos típicos',
            'imagen' => 'chicharron.jpg'
        ],
        [
            'id' => 6,
            'nombre' => 'Caldo de mote',
            'descripcion' => 'Caldo tradicional preparado con mote pelado, papa y con modunguito.',
            'precio' => 18.00,
            'categoria' => 'Entradas',
            'imagen' => 'caldo.jpg'
        ],
                [
            'id' => 9,
            'nombre' => 'Ceviche de Trucha',
            'descripcion' => 'Fresco ceviche de trucha con limón, cebolla y ají limo.',
            'precio' => 32.00,
            'categoria' => 'Platos típicos',
            'imagen' => 'ceviche.jpg' // Asegúrate de tener esta imagen
        ],
        [
            'id' => 10,
            'nombre' => 'Lomo Saltado',
            'descripcion' => 'Clásico lomo saltado con papas fritas y arroz.',
            'precio' => 38.00,
            'categoria' => 'Platos típicos',
            'imagen' => 'lomo.jpg'
        ],
        [
            'id' => 11,
            'nombre' => 'Pollo a la Brasa (1/4)',
            'descripcion' => 'Cuarto de pollo a la brasa con papas y ensalada.',
            'precio' => 22.00,
            'categoria' => 'Parrillas',
            'imagen' => 'pollo.jpg'
        ],
        [
            'id' => 7,
            'nombre' => 'Limonada Natural',
            'descripcion' => 'Refrescante limonada preparada con limones naturales.',
            'precio' => 8.00,
            'categoria' => 'Bebidas',
            'imagen' => 'bebida.jpg'
        ],
                [
            'id' => 12,
            'nombre' => 'Chicha Morada',
            'descripcion' => 'Refrescante chicha morada preparada con maíz morado y frutas.',
            'precio' => 7.00,
            'categoria' => 'Bebidas',
            'imagen' => 'chicha.jpg'
        ],
        [
            'id' => 13,
            'nombre' => 'Inca Kola (500ml)',
            'descripcion' => 'Gaseosa Inca Kola bien fría.',
            'precio' => 6.00,
            'categoria' => 'Bebidas',
            'imagen' => 'inca.jpg'
        ],
        [
            'id' => 14,
            'nombre' => 'Café Pasado',
            'descripcion' => 'Café de la selva pasado al estilo tradicional.',
            'precio' => 5.00,
            'categoria' => 'Bebidas',
            'imagen' => 'cafe.jpg'
        ],
                [
            'id' => 16,
            'nombre' => 'Cerveza Pilsen (650ml)',
            'descripcion' => 'Cerveza rubia bien fría, ideal para acompañar la parrilla.',
            'precio' => 12.00,
            'categoria' => 'Cervezas',
            'imagen' => 'pilsen.jpg'
        ],
        [
            'id' => 17,
            'nombre' => 'Cerveza Cusqueña (650ml)',
            'descripcion' => 'Cerveza premium de sabor intenso y refrescante.',
            'precio' => 13.00,
            'categoria' => 'Cervezas',
            'imagen' => 'cusquena.jpg'
        ],
        [
            'id' => 18,
            'nombre' => 'Cerveza Cristal (650ml)',
            'descripcion' => 'La cerveza clásica del Perú, bien helada.',
            'precio' => 11.00,
            'categoria' => 'Cervezas',
            'imagen' => 'cristal.jpg'
        ],
        [
            'id' => 19,
            'nombre' => 'Cuba Libre',
            'descripcion' => 'Ron, Coca-Cola, limón y hielo.',
            'precio' => 15.00,
            'categoria' => 'Licores',
            'imagen' => 'cuba.jpg'
        ],
        [
            'id' => 20,
            'nombre' => 'Chilcano de Pisco',
            'descripcion' => 'Pisco, ginger ale, limón y hielo.',
            'precio' => 14.00,
            'categoria' => 'Licores',
            'imagen' => 'chilcano.jpg'
        ]
    ];

    public function obtenerPlatos(): array
    {
        return $this->platos;
    }

    public function buscar(string $texto = '', string $categoria = ''): array
    {
        return array_values(array_filter($this->platos, function ($plato) use ($texto, $categoria) {

            $coincideTexto = $texto === ''
                || stripos($plato['nombre'], $texto) !== false
                || stripos($plato['descripcion'], $texto) !== false;

            $coincideCategoria = $categoria === ''
                || $plato['categoria'] === $categoria;

            return $coincideTexto && $coincideCategoria;
        }));
    }

    public function obtenerCategorias(): array
    {
        return array_values(array_unique(
            array_column($this->platos, 'categoria')
        ));
    }
}