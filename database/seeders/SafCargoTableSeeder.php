<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SafCargoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('saf_cargo')->delete();
        
        \DB::table('saf_cargo')->insert(array (
            0 => 
            array (
                'id_cargo' => 1,
                'nombre' => 'Decano',
                'descripcion' => 'Cargo del Decano',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id_cargo' => 2,
                'nombre' => 'Jefe UF',
                'descripcion' => 'Cargo del Jefe UF-Facultad',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id_cargo' => 3,
                'nombre' => 'Encargado UAF',
                'descripcion' => 'Cargo del Encargado UAF-Facultad',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id_cargo' => 4,
                'nombre' => 'Representante',
                'descripcion' => 'Cargo del Representante Unidad/Escuela',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}