<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SafTecnicoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('saf_tecnico')->delete();
        
        \DB::table('saf_tecnico')->insert(array (
            0 => 
            array (
                'id_tecnico' => 1,
                'nombre' => 'Carlos Pérez',
                'descripcion' => 'Especialista en electrónica.',
                'estado' => 'activo',
                'created_at' => NULL,
                'updated_at' => '2025-12-11 20:12:55',
            ),
            1 => 
            array (
                'id_tecnico' => 2,
                'nombre' => 'Ana López',
                'descripcion' => 'Técnico en mecánica.',
                'estado' => 'activo',
                'created_at' => NULL,
                'updated_at' => '2025-12-11 20:13:12',
            ),
        ));
        
        
    }
}