<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. CATÁLOGOS BASE (no dependen de nadie)
        |--------------------------------------------------------------------------
        */
        $this->call([
            SafEstadoTableSeeder::class,
            SafRolTableSeeder::class,
            SafCargoTableSeeder::class,
            SafAreaTableSeeder::class,
            SafUbicacionTableSeeder::class,
            SafTipoDescargoTableSeeder::class,
            SafTipoMantenimientoTableSeeder::class,
            SafTipoTrasladoTableSeeder::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 2. ENTIDADES MAESTRAS (dependen de catálogos)
        |--------------------------------------------------------------------------
        */
        $this->call([
            SafEmpleadoTableSeeder::class,
            SafTecnicoTableSeeder::class,
            SafProductoTableSeeder::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 3. USUARIOS (dependen de empleados, roles y cargos)
        |--------------------------------------------------------------------------
        */
        $this->call([
            SafUsuarioTableSeeder::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 4. RECURSOS / INVENTARIO (dependen de productos, estados, ubicaciones, empleados)
        |--------------------------------------------------------------------------
        */
        $this->call([
            SafRecursoTableSeeder::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 5. PROCESOS / TRANSACCIONALES
        |--------------------------------------------------------------------------
        */
        $this->call([
            SafSolicitudPeticionTableSeeder::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 6. BITÁCORA
        |--------------------------------------------------------------------------
        */
        $this->call([
            SafAccionTableSeeder::class,
        ]);
    }
}
