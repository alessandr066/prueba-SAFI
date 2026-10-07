<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SafRolTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('saf_rol')->delete();
        
        \DB::table('saf_rol')->insert(array (
            0 => 
            array (
                'id_rol' => 1,
                'nombre' => 'Administrador',
                'descripcion' => 'Acceso total al sistema.',
                'created_at' => NULL,
                'updated_at' => '2025-11-15 14:09:46',
            ),
            1 => 
            array (
                'id_rol' => 2,
                'nombre' => 'Decano Facultad',
                'descripcion' => 'Aprueba solicitudes y revisa reportes.',
                'created_at' => NULL,
                'updated_at' => '2025-11-15 14:09:46',
            ),
            2 => 
            array (
                'id_rol' => 3,
                'nombre' => 'Encargado UAF-Facultad',
                'descripcion' => 'Gestiona solicitudes y procesos administrativos.',
                'created_at' => NULL,
                'updated_at' => '2025-11-15 14:09:46',
            ),
            3 => 
            array (
                'id_rol' => 4,
                'nombre' => 'Jefe UF-Facultad',
                'descripcion' => 'Revisa solicitudes y administra recursos.',
                'created_at' => NULL,
                'updated_at' => '2025-11-15 14:09:46',
            ),
            4 => 
            array (
                'id_rol' => 5,
                'nombre' => 'Representante Unidad/Escuela',
                'descripcion' => 'Crea solicitudes y gestiona requerimientos.',
                'created_at' => '2025-11-15 14:09:46',
                'updated_at' => '2025-11-15 14:09:46',
            ),
        ));
        
        
    }
}