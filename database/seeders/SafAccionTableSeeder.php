<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SafAccionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('saf_accion')->delete();

        DB::table('saf_accion')->insert([
            // ===== SOLICITUDES =====
            [
                'id_accion' => 1,
                'nombre' => 'Crear Solicitud',
                'descripcion' => 'El representante registra una nueva solicitud en el sistema.',
            ],
            [
                'id_accion' => 2,
                'nombre' => 'Revisión por Jefe',
                'descripcion' => 'El jefe revisa la solicitud y registra una observación.',
            ],
            [
                'id_accion' => 3,
                'nombre' => 'Solicitud Devuelta',
                'descripcion' => 'El jefe devuelve la solicitud al representante para correcciones.',
            ],
            [
                'id_accion' => 4,
                'nombre' => 'Envío a Decano',
                'descripcion' => 'El jefe envía la solicitud al decano para aprobación final.',
            ],
            [
                'id_accion' => 5,
                'nombre' => 'Marcar en Revisión',
                'descripcion' => 'La solicitud cambia al estado "En revisión".',
            ],
            [
                'id_accion' => 6,
                'nombre' => 'Aprobar Solicitud',
                'descripcion' => 'El decano aprueba definitivamente la solicitud.',
            ],
            [
                'id_accion' => 7,
                'nombre' => 'Rechazar Solicitud',
                'descripcion' => 'El decano rechaza definitivamente la solicitud.',
            ],


            // ===== PRODUCTOS =====
            [
                'id_accion' => 8,
                'nombre' => 'Crear Producto',
                'descripcion' => 'Registro de un nuevo producto',
            ],
            [
                'id_accion' => 9,
                'nombre' => 'Editar Producto',
                'descripcion' => 'Modificación de un producto existente',
            ],
            [
                'id_accion' => 10,
                'nombre' => 'Eliminar Producto',
                'descripcion' => 'Eliminación de un producto del sistema',
            ],

            // ===== RECURSOS =====
            [
                'id_accion' => 11,
                'nombre' => 'Crear Recurso',
                'descripcion' => 'Registro de un nuevo recurso',
            ],
            [
                'id_accion' => 12,
                'nombre' => 'Editar Recurso',
                'descripcion' => 'Modificación de un recurso existente',
            ],
            [
                'id_accion' => 13,
                'nombre' => 'Eliminar Recurso',
                'descripcion' => 'Eliminación de un recurso del sistema',
            ],
            // ===== MANTENIMIENTOS =====
            [
                'id_accion' => 14,
                'nombre' => 'Crear Mantenimiento',
                'descripcion' => 'Registro de un nuevo mantenimiento',
            ],
            [
                'id_accion' => 15,
                'nombre' => 'Editar Mantenimiento',
                'descripcion' => 'Modificación de un mantenimiento existente',
            ],
            [
                'id_accion' => 16,
                'nombre' => 'Eliminar Mantenimiento',
                'descripcion' => 'Eliminación de un mantenimiento del sistema',
            ],
            [
                'id_accion' => 17,
                'nombre' => 'Finalizar Mantenimiento',
                'descripcion' => 'Cierre del mantenimiento y liberación del recurso',
            ],
            // ===== DESCARGOS =====
            [
                'id_accion' => 18,
                'nombre' => 'Crear Descargo',
                'descripcion' => 'Registro de un descargo de recurso',
            ],
            [
                'id_accion' => 19,
                'nombre' => 'Eliminar Descargo',
                'descripcion' => 'Eliminación de un descargo registrado',
            ],
            [
                'id_accion' => 20,
                'nombre' => 'Actualizar Estado Recurso',
                'descripcion' => 'Cambio de estado del recurso por descargo',
            ],

            // ===== TRASLADOS =====
            [
                'id_accion' => 21,
                'nombre' => 'Crear Traslado',
                'descripcion' => 'Registro de un traslado de recurso entre ubicaciones',
            ],
            // ======================
            // TÉCNICOS
            // ======================
            [
                'id_accion'   => 22,
                'nombre'      => 'Crear Técnico',
                'descripcion' => 'Registro de un nuevo técnico',
            ],
            [
                'id_accion'   => 23,
                'nombre'      => 'Editar Técnico',
                'descripcion' => 'Modificación de un técnico existente',
            ],
            [
                'id_accion'   => 24,
                'nombre'      => 'Eliminar Técnico',
                'descripcion' => 'Eliminación de un técnico del sistema',
            ],
            // ===== USUARIOS =====
            [
                'id_accion' => 25,
                'nombre' => 'Crear Usuario',
                'descripcion' => 'Registro de un nuevo usuario',
            ],
            [
                'id_accion' => 26,
                'nombre' => 'Editar Usuario',
                'descripcion' => 'Modificación de un usuario existente',
            ],
            [
                'id_accion' => 27,
                'nombre' => 'Eliminar Usuario',
                'descripcion' => 'Eliminación de un usuario del sistema',
            ],
            [
                'id_accion'   => 28,
                'nombre'      => 'Actualizar Usuario (Perfil)',
                'descripcion' => 'Cambio de nombre de usuario desde el perfil',
            ],
            [
                'id_accion'   => 29,
                'nombre'      => 'Actualizar Contraseña',
                'descripcion' => 'Cambio de contraseña desde el perfil del usuario',
            ],

            // ===== SISTEMA =====
            [
                'id_accion' => 30,
                'nombre' => 'Inicio de Sesión',
                'descripcion' => 'El usuario inicia sesión en el sistema',
            ],
            [
                'id_accion' => 31,
                'nombre' => 'Cierre de Sesión',
                'descripcion' => 'El usuario cierra su sesión',
            ],

            // ===== EXPORTACIONES =====
            [
                'id_accion' => 32,
                'nombre' => 'Exportar PDF',
                'descripcion' => 'Generación de un reporte en formato PDF',
            ],
            [
                'id_accion' => 33,
                'nombre' => 'Exportar Excel',
                'descripcion' => 'Generación de un reporte en formato Excel',
            ],
            [
                'id_accion' => 34,
                'nombre' => 'Crear Siniestro',
                'descripcion' => 'Registro inicial de un siniestro asociado a un recurso institucional.',
            ],
            [
                'id_accion' => 35,
                'nombre' => 'Revisar Siniestro',
                'descripcion' => 'Revisión del detalle del siniestro y verificación de la información registrada.',
            ],
            [
                'id_accion' => 36,
                'nombre' => 'Devolver Siniestro',
                'descripcion' => 'El siniestro fue devuelto al representante para corrección o ampliación de información.',
            ],
            [
                'id_accion' => 37,
                'nombre' => 'Enviar Siniestro al Decano',
                'descripcion' => 'El siniestro fue revisado y enviado al decano para decisión final.',
            ],
            [
                'id_accion' => 38,
                'nombre' => 'Aprobar Siniestro',
                'descripcion' => 'El siniestro fue aprobado por el decano tras la revisión correspondiente.',
            ],
            [
                'id_accion' => 39,
                'nombre' => 'Rechazar Siniestro',
                'descripcion' => 'El siniestro fue rechazado por el decano con la debida justificación.',
            ],
            [
                'id_accion' => 40,
                'nombre' => 'Ver Historial de Siniestro',
                'descripcion' => 'Visualización del historial de estados y observaciones del siniestro.',
            ],
            [
                'id_accion' => 41,
                'nombre' => 'Listar Siniestros',
                'descripcion' => 'Visualización del listado de siniestros según el rol del usuario.',
            ],

        ]);
    }
}
