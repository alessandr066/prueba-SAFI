<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SafSolicitudPeticionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('saf_solicitud_peticion')->delete();

        DB::table('saf_solicitud_peticion')->insert([
            [
                'id_solicitud' => 1,
                'numero' => 'SOL-0001',
                'fecha_peticion' => '2025-01-10',
                'entidad' => 'Facultad de Ingeniería',
                'tipo_peticion' => 'Adquisición de equipo',
                'responsable' => 'Ing. Juan Pérez',
                'descripcion' => 'Solicitud de compra de laptop para el área administrativa.',
                'estado' => 'Pendiente',
                'archivo' => null,
                'usuario_id' => 2,
                'observacion_inicial' => 'Equipo necesario para reemplazo por obsolescencia.',
                'observacion_revision' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_solicitud' => 2,
                'numero' => 'SOL-0002',
                'fecha_peticion' => '2025-01-15',
                'entidad' => 'Escuela de Sistemas',
                'tipo_peticion' => 'Mantenimiento',
                'responsable' => 'Lic. María López',
                'descripcion' => 'Mantenimiento preventivo de proyector del aula magna.',
                'estado' => 'En revisión',
                'archivo' => null,
                'usuario_id' => 2,
                'observacion_inicial' => 'El equipo presenta fallas de encendido.',
                'observacion_revision' => 'Se verifica necesidad de mantenimiento.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_solicitud' => 3,
                'numero' => 'SOL-0003',
                'fecha_peticion' => '2025-01-20',
                'entidad' => 'Departamento de Registro Académico',
                'tipo_peticion' => 'Asignación de recurso',
                'responsable' => 'Lic. Ana Martínez',
                'descripcion' => 'Asignación de computadora para nuevo personal.',
                'estado' => 'Aprobada',
                'archivo' => null,
                'usuario_id' => 3,
                'observacion_inicial' => 'Ingreso de nuevo empleado administrativo.',
                'observacion_revision' => 'Solicitud aprobada por decanatura.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_solicitud' => 4,
                'numero' => 'SOL-0004',
                'fecha_peticion' => '2025-02-01',
                'entidad' => 'Laboratorio de Informática',
                'tipo_peticion' => 'Baja de activo',
                'responsable' => 'Ing. Carlos Gómez',
                'descripcion' => 'Solicitud de baja de router por daño irreparable.',
                'estado' => 'Rechazada',
                'archivo' => null,
                'usuario_id' => 4,
                'observacion_inicial' => 'Equipo no responde tras múltiples reparaciones.',
                'observacion_revision' => 'Debe presentarse informe técnico.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_solicitud' => 5,
                'numero' => 'SOL-0005',
                'fecha_peticion' => '2025-02-10',
                'entidad' => 'Facultad de Ciencias Económicas',
                'tipo_peticion' => 'Adquisición de equipo',
                'responsable' => 'Lic. Roberto Hernández',
                'descripcion' => 'Compra de impresora multifuncional para secretaría.',
                'estado' => 'Aprobada',
                'archivo' => 'solicitudes/solicitud_impresora.pdf',
                'usuario_id' => 4,
                'observacion_inicial' => 'Alta demanda de impresiones.',
                'observacion_revision' => 'Compra autorizada.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
