<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SafUsuarioTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('saf_usuario')->delete();

        DB::table('saf_usuario')->insert([
            [
                'id_usuario'  => 1,
                'empleado_id' => 1,
                'rol_id'      => 2, // Decano
                'username'    => 'decano',
                'password'    => Hash::make('Decano123'),
                'cargo_id'    => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id_usuario'  => 2,
                'empleado_id' => 2,
                'rol_id'      => 4, // Jefe UF-Facultad
                'username'    => 'jefe',
                'password'    => Hash::make('Jefe123'),
                'cargo_id'    => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id_usuario'  => 3,
                'empleado_id' => 3,
                'rol_id'      => 3, // Encargado UAF
                'username'    => 'encargado',
                'password'    => Hash::make('Encargado123'),
                'cargo_id'    => 3,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id_usuario'  => 4,
                'empleado_id' => 4,
                'rol_id'      => 5, // Representante Unidad/Escuela
                'username'    => 'representante',
                'password'    => Hash::make('Representante123'),
                'cargo_id'    => 3,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id_usuario'  => 5,
                'empleado_id' => 6,
                'rol_id'      => 1, // Administrador
                'username'    => 'admin',
                'password'    => Hash::make('Admin123'),
                'cargo_id'    => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
