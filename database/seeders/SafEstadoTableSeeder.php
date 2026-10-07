<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SafEstadoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('saf_estado')->delete();
        
        \DB::table('saf_estado')->insert(array (
            0 => 
            array (
                'id_estado' => 1,
                'nombre' => 'Activo',
                'descripcion' => 'Recurso en uso',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id_estado' => 2,
                'nombre' => 'Inactivo',
                'descripcion' => 'Recurso fuera de uso',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id_estado' => 3,
                'nombre' => 'Bueno',
                'descripcion' => 'En buen estado',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id_estado' => 4,
                'nombre' => 'En reparación',
                'descripcion' => 'Necesita reparación',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id_estado' => 5,
                'nombre' => 'Dado de baja',
                'descripcion' => 'Recurso dado de baja',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}