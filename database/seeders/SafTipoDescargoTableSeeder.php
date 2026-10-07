<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SafTipoDescargoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('saf_tipo_descargo')->delete();
        
        \DB::table('saf_tipo_descargo')->insert(array (
            0 => 
            array (
                'id_tipo_descargo' => 1,
                'nombre' => 'Obsoleto',
                'descripcion' => 'Equipo en desuso',
                'created_at' => '2025-10-16 18:34:31',
                'updated_at' => '2025-10-16 18:34:31',
            ),
            1 => 
            array (
                'id_tipo_descargo' => 2,
                'nombre' => 'Dañado',
                'descripcion' => 'Equipo no funcional',
                'created_at' => '2025-10-16 18:34:31',
                'updated_at' => '2025-10-16 18:34:31',
            ),
            2 => 
            array (
                'id_tipo_descargo' => 3,
                'nombre' => 'Donado',
                'descripcion' => 'Bien donado a otra entidad',
                'created_at' => '2025-10-16 18:34:31',
                'updated_at' => '2025-10-16 18:34:31',
            ),
        ));
        
        
    }
}