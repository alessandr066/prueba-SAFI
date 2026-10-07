<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SafProductoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('saf_producto')->delete();

        DB::table('saf_producto')->insert([
            [
                'id_producto' => 1,
                'nombre' => 'Laptop HP ProBook 450 G8',
                'descripcion' => 'Laptop HP ProBook 450 G8, Intel Core i5, 8GB RAM, 256GB SSD, 15.6", Windows 11 Pro',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id_producto' => 2,
                'nombre' => 'Proyector Epson PowerLite X49',
                'descripcion' => 'Proyector Epson PowerLite X49, 3600 lúmenes, resolución XGA, HDMI, uso educativo',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id_producto' => 4,
                'nombre' => 'Pantalla LED Sony Bravia 55"',
                'descripcion' => 'Pantalla LED Sony Bravia de 55 pulgadas, resolución 4K UHD, entradas HDMI',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id_producto' => 6,
                'nombre' => 'Impresora Multifuncional HP LaserJet Pro M428fdw',
                'descripcion' => 'Impresora láser monocromática HP, impresión, escaneo y copiado, red y Wi-Fi',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id_producto' => 7,
                'nombre' => 'Router TP-Link Archer C6',
                'descripcion' => 'Router inalámbrico TP-Link Archer C6, doble banda AC1200, 4 puertos LAN',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id_producto' => 8,
                'nombre' => 'Computadora HP ProDesk 600 G5',
                'descripcion' => 'Computadora de escritorio HP ProDesk 600 G5, Intel Core i7, 16GB RAM, 512GB SSD, Windows 11 Pro',
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
