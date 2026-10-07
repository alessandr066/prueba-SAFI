<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SafRecursoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('saf_recurso')->delete();

        DB::table('saf_recurso')->insert([
            [
                'id_recurso' => 1,
                'codigo' => 'EQ-2024-001',
                'nombre' => 'Laptop HP ProBook 450 G8 – Administración',
                'descripcion' => 'Equipo asignado a labores administrativas. Intel Core i5, 8GB RAM, 256GB SSD.',
                'fecha_ingreso' => '2025-01-10',
                'producto_id' => 1,
                'estado_id' => 1, // Activo
                'ubicacion_id' => 2,
                'empleado_asignado' => 1,
                'fecha_adquisicion' => '2024-12-20',
                'valor_recurso' => '950.00',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id_recurso' => 2,
                'codigo' => 'EQ-2024-002',
                'nombre' => 'Proyector Epson PowerLite X49 – Aula Magna',
                'descripcion' => 'Proyector fijo para presentaciones académicas y eventos institucionales.',
                'fecha_ingreso' => '2025-01-15',
                'producto_id' => 2,
                'estado_id' => 1,
                'ubicacion_id' => 2,
                'empleado_asignado' => 2,
                'fecha_adquisicion' => '2024-11-30',
                'valor_recurso' => '720.00',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id_recurso' => 3,
                'codigo' => 'EQ-2025-003',
                'nombre' => 'Pantalla LED Sony Bravia 55” – Sala de Conferencias',
                'descripcion' => 'Pantalla 4K UHD para presentaciones, reuniones y videoconferencias.',
                'fecha_ingreso' => '2025-02-05',
                'producto_id' => 4,
                'estado_id' => 1,
                'ubicacion_id' => 2,
                'empleado_asignado' => 4,
                'fecha_adquisicion' => '2025-01-20',
                'valor_recurso' => '1250.00',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id_recurso' => 4,
                'codigo' => 'EQ-2024-010',
                'nombre' => 'Impresora HP LaserJet Pro M428fdw – Secretaría',
                'descripcion' => 'Impresora multifuncional láser asignada a la oficina de secretaría.',
                'fecha_ingreso' => '2024-10-10',
                'producto_id' => 6,
                'estado_id' => 2, // En mantenimiento
                'ubicacion_id' => 1,
                'empleado_asignado' => 1,
                'fecha_adquisicion' => '2024-09-18',
                'valor_recurso' => '680.00',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id_recurso' => 5,
                'codigo' => 'EQ-2023-021',
                'nombre' => 'Router TP-Link Archer C6 – Laboratorio de Informática',
                'descripcion' => 'Equipo de red para conectividad interna del laboratorio.',
                'fecha_ingreso' => '2023-08-15',
                'producto_id' => 7,
                'estado_id' => 3, // Dado de baja
                'ubicacion_id' => 2,
                'empleado_asignado' => 3,
                'fecha_adquisicion' => '2023-07-30',
                'valor_recurso' => '95.00',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id_recurso' => 6,
                'codigo' => 'EQ-2024-032',
                'nombre' => 'Computadora HP ProDesk 600 G5 – Oficina de Registro',
                'descripcion' => 'Equipo de escritorio institucional. Core i7, 16GB RAM, 512GB SSD.',
                'fecha_ingreso' => '2024-09-27',
                'producto_id' => 8,
                'estado_id' => 1,
                'ubicacion_id' => 1,
                'empleado_asignado' => 1,
                'fecha_adquisicion' => '2024-09-12',
                'valor_recurso' => '1100.00',
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
