<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SafTipoTrasladoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('saf_tipo_traslado')->delete();
        
        \DB::table('saf_tipo_traslado')->insert(array (
            0 => 
            array (
                'id_tipo_traslado' => 1,
                'nombre' => 'Permanente',
                'descripcion' => 'Traslado definitivo de un bien a otra área.',
            ),
            1 => 
            array (
                'id_tipo_traslado' => 2,
                'nombre' => 'Temporal',
                'descripcion' => 'Traslado por un periodo limitado.',
            ),
            2 => 
            array (
                'id_tipo_traslado' => 3,
                'nombre' => 'Mantenimiento',
                'descripcion' => 'Salida del bien para reparación o mantenimiento.',
            ),
        ));
        
        
    }
}