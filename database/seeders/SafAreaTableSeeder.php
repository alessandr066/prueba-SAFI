<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SafAreaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('saf_area')->delete();
        
        \DB::table('saf_area')->insert(array (
            0 => 
            array (
                'id_area' => 1,
                'nombre' => 'Oficina Central',
                'descripcion' => 'Área administrativa principal',
                'tipo_area_id' => 1,
                'ubicacion_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id_area' => 2,
                'nombre' => 'Laboratorio Informática',
                'descripcion' => 'Área de cómputo',
                'tipo_area_id' => 2,
                'ubicacion_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}