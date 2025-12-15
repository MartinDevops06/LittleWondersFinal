<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('productos')->insert([

            // PRODUCTOS PARA MADRES

            [
                'category_id' => 1,
                'nombre' => 'Cojin de embarazo tipo "U"',
                'descripcion' => 'Almohada grande en forma de U que soporta la espalda, el vientre y las piernas. Reduce la presión lumbar, mejora la postura para dormir y facilita el descanso durante el tercer trimestre. Materiales: funda lavable, relleno hipoalergénico. Ideal para lactancia y posparto también.',
                'precio' => 149900,
                'foto' => 'image001.jpg',
                'classification' => 'Confort',
                'gallery_images' => json_encode([
                    'cojin_lactancia_1.jpg',
                    'cojin_lactancia_2.jpg'
                ]),
                'brand' => 'MamiCare',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 1,
                'nombre' => 'Faja de soporte prenatal',
                'descripcion' => 'Cinturón elástico y regulable que sostiene el abdomen y baja la presión sobre la pelvis y la espalda. Alivia dolor lumbar y ayuda al confort durante actividades diarias. Ajustable según trimestre.',
                'precio' => 89900,
                'foto' => 'image002.jpg',
                'classification' => 'Confort',
                'gallery_images' => json_encode([
                    'cochecito_bebe_1.jpg',
                    'cochecito_bebe_2.jpg',
                    'cochecito_bebe_3.jpg'
                ]),
                'brand' => 'BabyTravel',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 1,
                'nombre' => 'Monitor fetal de uso domiciliario',
                'descripcion' => 'Dispositivo portátil que permite escuchar latidos fetales en casa. Incluye gel y auriculares/bluetooth. Útil para tranquilidad entre consultas.',
                'precio' => 249900,
                'foto' => 'image004.jpg',
                'classification' => 'Salud',
                'gallery_images' => json_encode([
                    'bolsa_maternidad_1.jpg'
                ]),
                'brand' => 'MamiKit',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 1,
                'nombre' => 'Ropa premamá',
                'descripcion' => 'Prendas con cintura adaptable o panel elástico que crecen con la barriga. Telas suaves y transpirables, costuras reforzadas para mayor confort. Ofrecen estilo y funcionalidad durante todo el embarazo.',
                'precio' => 69900,
                'foto' => 'image005.jpg',
                'classification' => 'Vestimenta',
                'gallery_images' => json_encode([
                    'monitor_bebe_1.jpg',
                    'monitor_bebe_2.jpg'
                ]),
                'brand' => 'SafeBaby',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 1,
                'nombre' => 'Kit de suplementación prenatal',
                'descripcion' => 'Multivitamínico prenatal que aporta ácido fólico, hierro, calcio y DHA según recomendaciones médicas. Diseñado para cubrir necesidades antes y durante el embarazo.',
                'precio' => 54900,
                'foto' => 'image006.jpg',
                'classification' => 'Salud',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'SoftBabies',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 1,
                'nombre' => 'Bolsa térmica / compresas reutilizables',
                'descripcion' => 'Paquete que puede calentarse o enfriarse para aliviar dolores lumbares, calambres o molestias pélvicas. Funda lavable y materiales seguros.',
                'precio' => 32900,
                'foto' => 'image007.jpg',
                'classification' => 'Salud',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'SoftBabies',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 1,
                'nombre' => 'Sujetador de lactancia',
                'descripcion' => 'Brasier sin aro, con telas suaves y elásticas que se adaptan a cambios de volumen en el pecho. Tiene clips o paneles abatibles para amamantar fácilmente.',
                'precio' => 45900,
                'foto' => 'image008.jpg',
                'classification' => 'Vestimenta',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'SoftBabies',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // PRODUCTOS PARA BEBÉS

            [
                'category_id' => 2,
                'nombre' => 'Pañales desechables hipoalergénicos',
                'descripcion' => 'Pañales suaves y libres de fragancia diseñados para proteger la piel sensible del bebé. Absorben humedad por varias horas.',
                'precio' => 35900,
                'foto' => 'image009.jpg',
                'classification' => 'Higiene',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'SoftBabies',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'nombre' => 'Toallitas húmedas sin perfume',
                'descripcion' => 'Toallitas suaves con fórmula a base de agua. Ideales para limpiar la piel sin causar irritación.',
                'precio' => 11900,
                'foto' => 'image010.jpg',
                'classification' => 'Higiene',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'Pequeñin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'nombre' => 'Biberón anticolicos',
                'descripcion' => 'Biberón con válvula especial que reduce entrada de aire durante la succión. Materiales libres de BPA.',
                'precio' => 25900,
                'foto' => 'image011.jpg',
                'classification' => 'Alimentación',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'Pequeñin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'nombre' => 'Fórmula infantil etapa 1',
                'descripcion' => 'Leche de fórmula para bebés desde el nacimiento. Enriquecida con vitaminas, minerales y prebióticos.',
                'precio' => 79900,
                'foto' => 'image012.jpg',
                'classification' => 'Alimentación',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'Pequeñin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'nombre' => 'Baberos impermeables',
                'descripcion' => 'Baberos con capa impermeable que evita humedad en la ropa del bebé. Lavables y cómodos.',
                'precio' => 15900,
                'foto' => 'image014.jpg',
                'classification' => 'Alimentación',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'Pequeñin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'nombre' => 'Termómetro digital para bebés',
                'descripcion' => 'Termómetro rápido y preciso con punta flexible. Alarmas para indicar fiebre.',
                'precio' => 34900,
                'foto' => 'image016.jpg',
                'classification' => 'Salud',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'Pequeñin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'nombre' => 'Shampoo y jabón líquido 2 en 1',
                'descripcion' => 'Fórmula sin lágrimas, hipoalergénica y con pH neutro. Ideal para uso diario.',
                'precio' => 18900,
                'foto' => 'image018.jpg',
                'classification' => 'Higiene',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'Pequeñin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'nombre' => 'Conjunto Body + Vestido Rosado para Bebé',
                'descripcion' => 'Conjunto delicado con body y vestido rosado ideal para eventos o uso diario con estilo dulce.',
                'precio' => 99900,
                'foto' => 'image45.jpg',
                'classification' => 'Ropa',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'Pequeñin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'nombre' => 'Sets Saco con Capucha + Body + Pantalón Jogger',
                'descripcion' => 'Set práctico con saco con capucha, body y jogger perfecto para salida y paseo.',
                'precio' => 62990,
                'foto' => 'image46.jpg',
                'classification' => 'Ropa',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'Pequeñin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'nombre' => 'Set Ocasión Especial Body y Pantalón Recién Nacido',
                'descripcion' => 'Set elegante de body con pantalón para recién nacido – perfecto como regalo o primera muda. ',
                'precio' => 139990 ,
                'foto' => 'image48.jpg',
                'classification' => 'Ropa',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'Pequeñin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'nombre' => 'Set bebé 6‑en‑1 Hudson Baby',
                'descripcion' => 'Set completo para recién nacido o bebé de hasta 6-9 meses con 6 piezas variadas (bodys, pantaloncitos y más), ideal para mudas del día a día o regalo de baby shower.',
                'precio' => 169915 ,
                'foto' => 'image49.jpg',
                'classification' => 'Ropa',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'Hudson Baby',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'nombre' => 'Conjunto body + bermuda bebé ',
                'descripcion' => 'Conjunto cómodo de body con bermuda para bebé niño, perfecto para clima cálido y uso diario; fácil de poner y quitar.',
                'precio' => 99990 ,
                'foto' => 'image50.jpg',
                'classification' => 'Ropa',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'Hudson Baby',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'nombre' => 'Conjunto blusa rosa + short bebé ',
                'descripcion' => 'Conjunto dulce de blusa rosa con estampado floral y short en lino para bebé niña, ideal para salidas casuales.',
                'precio' => 99990 ,
                'foto' => 'image56.jpg',
                'classification' => 'Ropa',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'Hudson Baby',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'nombre' => 'SET 14PZS',
                'descripcion' => 'Set de 14 piezas básicas de ropa para bebé (bodys, pijamas y prendas esenciales), ideal como paquete completo para uso diario y mudas frecuentes.',
                'precio' => 74990 ,
                'foto' => 'image57.jpg',
                'classification' => 'Ropa',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'Creciendo Baby',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'nombre' => 'Conjunto bebé niña body + vestido algodón ',
                'descripcion' => 'Conjunto dulce que incluye body con vestido de algodón suave, cómodo y perfecto para salidas casuales o eventos especiales',
                'precio' => 99990 ,
                'foto' => 'image58.jpg',
                'classification' => 'Ropa',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'Creciendo Baby',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'nombre' => 'Conjunto bebé tejido carita unisex',
                'descripcion' => 'Conjunto tejido unisex con diseño de carita, ideal para climas frescos o días de paseo.',
                'precio' => 178000 ,
                'foto' => 'image59.jpg',
                'classification' => 'Ropa',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'Creciendo Baby',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // JUGUETERÍA Y ESTIMULACIÓN

            [
                'category_id' => 3,
                'nombre' => 'Gimnasio de actividades para bebé',
                'descripcion' => 'Alfombra acolchada con arcos y juguetes colgantes. Desarrolla motricidad y atención visual.',
                'precio' => 139900,
                'foto' => 'image022.jpg',
                'classification' => 'Estimulación',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'SoftBabies',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 3,
                'nombre' => 'Sonajero ergonómico',
                'descripcion' => 'Juguete liviano con sonido suave. Favorece coordinación mano-ojo.',
                'precio' => 14900,
                'foto' => 'image023.jpg',
                'classification' => 'Entretenimiento',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'SoftBabies',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 3,
                'nombre' => 'Libros de tela sensorial',
                'descripcion' => 'Libros suaves con colores, texturas y sonidos. Ideal desde los 3 meses.',
                'precio' => 29900,
                'foto' => 'image024.jpg',
                'classification' => 'Estimulación',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'SoftBabies',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 3,
                'nombre' => 'Cubos apilables',
                'descripcion' => 'Piezas blandas para apilar y morder. Favorecen coordinación y resolución de problemas.',
                'precio' => 26900,
                'foto' => 'image025.jpg',
                'classification' => 'Motricidad',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'SoftBabies',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 3,
                'nombre' => 'Pelota sensorial',
                'descripcion' => 'Pelota ligera con texturas que estimulan el tacto y la prensión.',
                'precio' => 15900,
                'foto' => 'image026.jpg',
                'classification' => 'Estimulación',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'SoftBabies',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 3,
                'nombre' => 'Mordedera de silicona',
                'descripcion' => 'Juguete masticable que alivia molestias durante la dentición.',
                'precio' => 12900,
                'foto' => 'image027.jpg',
                'classification' => 'Estimulación',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'SoftBabies',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 3,
                'nombre' => 'Juguetes de baño flotantes',
                'descripcion' => 'Figuras de goma que flotan en el agua. Hacen divertida la rutina de baño.',
                'precio' => 19900,
                'foto' => 'image029.jpg',
                'classification' => 'Entretenimiento',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'SoftBabies',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 3,
                'nombre' => 'Piano para bebés con luces',
                'descripcion' => 'Teclado pequeño con melodías suaves y luces de colores. Estimula atención, ritmo y motricidad.',
                'precio' => 79900,
                'foto' => 'image030.jpg',
                'classification' => 'Estimulación',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'SoftBabies',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 3,
                'nombre' => 'Andador para bebé',
                'descripcion' => 'Carrito con asiento que ayuda a practicar primeros pasos. Incluye ruedas seguras y juguetes frontales.',
                'precio' => 199900,
                'foto' => 'image032.jpg',
                'classification' => 'Motricidad',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'SoftBabies',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 3,
                'nombre' => 'Mesa de actividades 360°',
                'descripcion' => 'Plataforma con asiento giratorio y juguetes alrededor. Desarrolla equilibrio, coordinación y curiosidad.',
                'precio' => 249900,
                'foto' => 'image033.jpg',
                'classification' => 'Motricidad',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'SoftBabies',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 3,
                'nombre' => 'Cartas de alto contraste',
                'descripcion' => 'Tarjetas con patrones de alto contraste para fortalecer la atención visual.',
                'precio' => 18900,
                'foto' => 'image035.jpg',
                'classification' => 'Estimulación',
                'gallery_images' => json_encode([
                    'set_ropa_bebe_1.jpg'
                ]),
                'brand' => 'SoftBabies',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
