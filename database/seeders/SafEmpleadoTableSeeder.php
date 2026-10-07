<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SafEmpleadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('saf_empleado')->delete();

        DB::table('saf_empleado')->insert([
            [
                'id_empleado'    => 1,
                'nombres'        => 'Juan Carlos',
                'apellidos'      => 'Pérez Gómez',
                'cargo_id'       => 1,
                'estado_id'      => 1,
                'fecha_ingreso'  => '2022-01-10',
                'created_at'     => null,
                'updated_at'     => null,
            ],
            [
                'id_empleado'    => 2,
                'nombres'        => 'María Fernanda',
                'apellidos'      => 'López Hernández',
                'cargo_id'       => 2,
                'estado_id'      => 1,
                'fecha_ingreso'  => '2021-05-18',
                'created_at'     => null,
                'updated_at'     => null,
            ],
            [
                'id_empleado'    => 3,
                'nombres'        => 'Carlos Alberto',
                'apellidos'      => 'Gómez Ruiz',
                'cargo_id'       => 3,
                'estado_id'      => 1,
                'fecha_ingreso'  => '2020-09-03',
                'created_at'     => null,
                'updated_at'     => null,
            ],
            [
                'id_empleado'    => 4,
                'nombres'        => 'Ana Sofía',
                'apellidos'      => 'Martínez Rivera',
                'cargo_id'       => 4,
                'estado_id'      => 1,
                'fecha_ingreso'  => '2023-02-01',
                'created_at'     => null,
                'updated_at'     => null,
            ],
            [
                'id_empleado'    => 5,
                'nombres'        => 'Luis Enrique',
                'apellidos'      => 'Castillo Morales',
                'cargo_id'       => 2,
                'estado_id'      => 1,
                'fecha_ingreso'  => '2019-11-25',
                'created_at'     => null,
                'updated_at'     => null,
            ],
            [
                'id_empleado'    => 6,
                'nombres'        => 'Daniela',
                'apellidos'      => 'Ramírez Torres',
                'cargo_id'       => 3,
                'estado_id'      => 1,
                'fecha_ingreso'  => '2022-08-14',
                'created_at'     => null,
                'updated_at'     => null,
            ],
        ]);
    }
}
