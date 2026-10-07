<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SolicitudPeticionController;
use App\Http\Controllers\RecursoController;
use App\Http\Controllers\TrasladoController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\ReporteRecursoController;
use App\Http\Controllers\DescargoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\SiniestroController;

/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('welcome'));

/*
|--------------------------------------------------------------------------
| Dashboard (solo autenticado y verificado)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])
    ->get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Perfil
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Mostrar perfil
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    // Actualizar nombre de usuario
    Route::post('/profile/username', [ProfileController::class, 'updateUsername'])
        ->name('profile.username');

    // Actualizar contraseña
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');
});


/*
|--------------------------------------------------------------------------
| SECCIÓN AUTENTICADA
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Solicitudes (con roles)
    |---
    -----------------------------------------------------------------------
    */
    Route::middleware(['role:Representante Unidad/Escuela'])->group(function () {
        Route::get('/solicitudes', [SolicitudPeticionController::class, 'index'])->name('solicitudes.index');
        Route::get('/solicitudes/create', [SolicitudPeticionController::class, 'create'])->name('solicitudes.create');
        Route::post('/solicitudes', [SolicitudPeticionController::class, 'store'])->name('solicitudes.store');
    });

    Route::middleware(['role:Jefe UF-Facultad,Encargado UAF-Facultad'])->group(function () {
        Route::get('/solicitudes/revisar', [SolicitudPeticionController::class, 'revisar'])->name('solicitudes.revisar');
    });

    Route::middleware(['role:Decano Facultad'])->group(function () {
        Route::get('/solicitudes/aprobar', [SolicitudPeticionController::class, 'aprobar'])->name('solicitudes.aprobar');
    });

    Route::middleware(['role:Jefe UF-Facultad,Encargado UAF-Facultad,Decano Facultad'])->group(function () {
        Route::patch('/solicitudes/{id}/estado', [SolicitudPeticionController::class, 'procesarAprobacion'])->name('solicitudes.procesarAprobacion');
    });
    Route::middleware(['role:Representante Unidad/Escuela,Jefe UF-Facultad,Encargado UAF-Facultad,Decano Facultad'])
        ->group(function () {
            Route::get(
                '/solicitudes/{id}',
                [SolicitudPeticionController::class, 'show']
            )->name('solicitudes.show');
        });

    Route::middleware(['role:Representante Unidad/Escuela'])->group(function () {
        Route::get(
            '/solicitudes/{id}/edit',
            [SolicitudPeticionController::class, 'edit']
        )->name('solicitudes.edit');

        Route::put(
            '/solicitudes/{id}',
            [SolicitudPeticionController::class, 'update']
        )->name('solicitudes.update');
    });
    Route::middleware(['role:Jefe UF-Facultad,Encargado UAF-Facultad'])->group(function () {
        Route::get(
            '/solicitudes/{id}/revision',
            [SolicitudPeticionController::class, 'mostrarRevisionJefe']
        )->name('solicitudes.revisionJefe.form');

        Route::patch(
            '/solicitudes/{id}/revision',
            [SolicitudPeticionController::class, 'revisionJefe']
        )->name('solicitudes.revisionJefe');
    });

    Route::middleware(['role:Decano Facultad'])->group(function () {

        Route::get(
            '/solicitudes/aprobar/{id}',
            [SolicitudPeticionController::class, 'aprobarShow']
        )->name('solicitudes.aprobar.show');
    });

    /*
    |--------------------------------------------------------------------------
    | Siniestro (Recursos)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:Representante Unidad/Escuela'])->group(function () {
        Route::get('/siniestros/create/{recurso}', [SiniestroController::class, 'create'])
            ->name('siniestros.create');

        Route::post('/siniestros', [SiniestroController::class, 'store'])
            ->name('siniestros.store');
    });

    Route::middleware(['role:Jefe UF-Facultad,Encargado UAF-Facultad'])->group(function () {
        Route::get('/siniestros/revisar', [SiniestroController::class, 'revisar'])
            ->name('siniestros.revisar');
    });

    Route::middleware(['role:Decano Facultad'])->group(function () {
        Route::get('/siniestros/aprobar', [SiniestroController::class, 'aprobar'])
            ->name('siniestros.aprobar');
    });

    Route::patch('/siniestros/{id}/estado', [SiniestroController::class, 'procesar'])
        ->name('siniestros.procesar');

    Route::middleware(['role:Representante Unidad/Escuela'])->group(function () {
        Route::get('/recursos', [RecursoController::class, 'index'])->name('recursos.index');
        Route::get('/recursos/{id}', [RecursoController::class, 'show'])->name('recursos.show');
    });

    Route::middleware(['role:Jefe UF-Facultad,Encargado UAF-Facultad'])->group(function () {
        Route::get('/siniestros/revisar/{id}', [SiniestroController::class, 'revisarShow'])
            ->name('siniestros.revisar.show');
    });




    /*
    |--------------------------------------------------------------------------
    | Inventario (Recursos)
    |--------------------------------------------------------------------------
    */
    Route::prefix('inventario')->name('inventario.')->group(function () {
        Route::get('/',               [RecursoController::class, 'index'])->name('index');
        Route::get('/crear',          [RecursoController::class, 'create'])->name('create');
        Route::post('/',              [RecursoController::class, 'store'])->name('store');
        Route::get('/{id}',           [RecursoController::class, 'show'])->name('show');
        Route::get('/{id}/editar',    [RecursoController::class, 'edit'])->name('edit');
        Route::put('/{id}',           [RecursoController::class, 'update'])->name('update');
        Route::delete('/{id}',        [RecursoController::class, 'destroy'])->name('destroy');

        Route::get('/exportar/pdf', [RecursoController::class, 'exportarPDF'])->name('exportarPDF');
        Route::get('/exportar/excel', [RecursoController::class, 'exportarExcel'])->name('exportarExcel');
    });

    /*
    |--------------------------------------------------------------------------
    | Productos
    |--------------------------------------------------------------------------
    */
    Route::resource('productos', ProductoController::class);

    /*
    |--------------------------------------------------------------------------
    | Traslados
    |--------------------------------------------------------------------------
    */
    Route::prefix('traslados')->name('traslados.')->group(function () {

        Route::get('/', [TrasladoController::class, 'index'])->name('index');

        Route::get('/create', [TrasladoController::class, 'create'])->name('create');
        Route::get('/create/{recurso_id}', [TrasladoController::class, 'create'])->name('create.recurso');

        Route::post('/', [TrasladoController::class, 'store'])->name('store');
        Route::post('/filtrar', [TrasladoController::class, 'filtrar'])->name('filtrar');

        Route::get('/{id}', [TrasladoController::class, 'show'])->name('show');

        Route::get('/export/excel', [TrasladoController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf',   [TrasladoController::class, 'exportPdf'])->name('export.pdf');
    });

    /*
    |--------------------------------------------------------------------------
    | Bitácora
    |--------------------------------------------------------------------------
    */
    Route::prefix('bitacora')->name('bitacora.')->group(function () {
        Route::get('/', [BitacoraController::class, 'index'])->name('index');
        Route::get('/{id}', [BitacoraController::class, 'show'])->name('show');

        Route::get('/export/excel', [BitacoraController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/pdf',   [BitacoraController::class, 'exportPdf'])->name('export.pdf');
    });

    /*
    |--------------------------------------------------------------------------
    | Mantenimientos
    |--------------------------------------------------------------------------
    */
    Route::prefix('mantenimientos')->name('mantenimientos.')->group(function () {

        Route::get('/', [MantenimientoController::class, 'index'])->name('index');
        Route::get('/crear', [MantenimientoController::class, 'create'])->name('create');
        Route::post('/', [MantenimientoController::class, 'store'])->name('store');

        Route::post('/{id}/finalizar', [MantenimientoController::class, 'finalizar'])
            ->name('finalizar');

        Route::get('/{id}/editar', [MantenimientoController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MantenimientoController::class, 'update'])->name('update');
        Route::delete('/{id}', [MantenimientoController::class, 'destroy'])->name('destroy');

        Route::get('/{id}', [MantenimientoController::class, 'show'])->name('show');

        Route::get('/exportar/pdf', [MantenimientoController::class, 'exportarPDF'])->name('exportar.pdf');
        Route::get('/exportar/excel', [MantenimientoController::class, 'exportarExcel'])->name('exportar.excel');
    });

    /*
    |--------------------------------------------------------------------------
    | Reportes (Recursos)
    |--------------------------------------------------------------------------
    */
    Route::prefix('reportes/recursos')->name('reportes.recursos.')->group(function () {
        Route::get('/', [ReporteRecursoController::class, 'index'])->name('index');
        Route::get('/excel', [ReporteRecursoController::class, 'exportExcel'])->name('excel');
        Route::get('/pdf',   [ReporteRecursoController::class, 'exportPDF'])->name('pdf');
    });

    /*
    |--------------------------------------------------------------------------
    | Descargos
    |--------------------------------------------------------------------------
    */
    Route::prefix('descargos')->name('descargos.')->group(function () {
        Route::get('/', [DescargoController::class, 'index'])->name('index');
        Route::get('/create/{recurso}', [DescargoController::class, 'create'])->name('create');
        Route::post('/', [DescargoController::class, 'store'])->name('store');
        Route::get('/{id}', [DescargoController::class, 'show'])->name('show');

        Route::get('/exportar/excel', [DescargoController::class, 'exportarExcel'])->name('exportar.excel');
        Route::get('/exportar/pdf',   [DescargoController::class, 'exportarPDF'])->name('exportar.pdf');
    });

    /*
    |--------------------------------------------------------------------------
    | Usuarios (solo Administrador)
    |--------------------------------------------------------------------------
    */
    Route::prefix('usuarios')->name('usuarios.')
        ->middleware('role:Administrador')
        ->group(function () {

            Route::get('/', [UsuarioController::class, 'index'])->name('index');
            Route::get('/crear', [UsuarioController::class, 'create'])->name('create');
            Route::post('/', [UsuarioController::class, 'store'])->name('store');
            Route::get('/{id}', [UsuarioController::class, 'show'])->name('show');
            Route::get('/{id}/editar', [UsuarioController::class, 'edit'])->name('edit');
            Route::put('/{id}', [UsuarioController::class, 'update'])->name('update');
            Route::delete('/{id}', [UsuarioController::class, 'destroy'])->name('destroy');
        });

    /*
    |--------------------------------------------------------------------------
    | Tecnicos
    |--------------------------------------------------------------------------
    */
    Route::prefix('tecnicos')->name('tecnicos.')->group(function () {
        Route::get('/', [TecnicoController::class, 'index'])->name('index');
        Route::get('/crear', [TecnicoController::class, 'create'])->name('create');
        Route::post('/', [TecnicoController::class, 'store'])->name('store');
        Route::get('/{id}', [TecnicoController::class, 'show'])->name('show');
        Route::get('/{id}/editar', [TecnicoController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TecnicoController::class, 'update'])->name('update');
        Route::delete('/{id}', [TecnicoController::class, 'destroy'])->name('destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Autenticación (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
