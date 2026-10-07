<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SafUbicacionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('saf_ubicacion')->delete();
        
        \DB::table('saf_ubicacion')->insert(array (
            0 => 
            array (
                'id_ubicacion' => 1,
                'nombre' => 'Edificio A',
                'descripcion' => 'Primer piso',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id_ubicacion' => 2,
                'nombre' => 'Edificio B',
                'descripcion' => 'Segundo piso',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}