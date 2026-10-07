<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SafTipoAreaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('saf_tipo_area')->delete();
        
        \DB::table('saf_tipo_area')->insert(array (
            0 => 
            array (
                'id_tipo_area' => 1,
                'nombre' => 'Administrativa',
                'descripcion' => 'Área de administración',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id_tipo_area' => 2,
                'nombre' => 'Académica',
                'descripcion' => 'Área destinada a la enseñanza',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}