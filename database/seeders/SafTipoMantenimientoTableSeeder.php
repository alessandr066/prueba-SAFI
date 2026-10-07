<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SafTipoMantenimientoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('saf_tipo_mantenimiento')->delete();
        
        \DB::table('saf_tipo_mantenimiento')->insert(array (
            0 => 
            array (
                'id_tipo_mantenimiento' => 1,
                'nombre' => 'Preventivo',
                'descripcion' => 'Mantenimiento programado para prevenir fallas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id_tipo_mantenimiento' => 2,
                'nombre' => 'Correctivo',
                'descripcion' => 'Mantenimiento realizado tras una falla',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id_tipo_mantenimiento' => 3,
                'nombre' => 'Predictivo',
                'descripcion' => 'Mantenimiento basado en análisis y predicción de fallas',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}