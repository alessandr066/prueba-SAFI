<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Traslado;
use App\Models\SolicitudPeticion;
use App\Models\Recurso;
use Carbon\Carbon;
use App\Models\Usuario;
use App\Models\Bitacora;
use App\Models\Mantenimiento;

class DashboardController extends Controller
{
    public function index()
    {
        // KPIs
        $totalTraslados = Traslado::count();
        $totalSolicitudes = SolicitudPeticion::count();
        $totalUsuarios = Usuario::count();
        $pendientes = SolicitudPeticion::where('estado', 'Pendiente')->count();

        // Gráfico: traslados por mes
        $trasladosPorMes = Traslado::selectRaw('MONTH(fecha) as mes, COUNT(*) as total')
            ->groupBy('mes')->pluck('total', 'mes');

        // Gráfico: solicitudes por estado
        $solicitudesPorEstado = SolicitudPeticion::selectRaw('estado, COUNT(*) as total')
            ->groupBy('estado')->pluck('total', 'estado');

        // Gráfico: mantenimientos por estado
        $mantenimientosPorEstado = Mantenimiento::selectRaw('estado, COUNT(*) as total')
            ->groupBy('estado')
            ->pluck('total', 'estado');

        // Recursos totales por estado
        $recursosPorEstado = \App\Models\Recurso::with('estado')
            ->get()
            ->groupBy(fn($r) => $r->estado->nombre ?? 'Sin estado')
            ->map->count();

        // Top usuarios más activos
        $usuariosActivos = Bitacora::selectRaw('usuario_id, COUNT(*) as total')
            ->groupBy('usuario_id')->with('usuario')
            ->orderByDesc('total')->take(5)->get();

        // Últimos registros
        $ultimosTraslados = Traslado::with(['recurso.producto', 'ubicacionDestino'])
            ->latest()
            ->take(5)
            ->get();

        $ultimosBitacora = Bitacora::with(['usuario', 'accion'])
            ->latest('fecha') // ← aquí estaba el problema
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalTraslados',
            'totalSolicitudes',
            'totalUsuarios',
            'pendientes',
            'trasladosPorMes',
            'solicitudesPorEstado',
            'usuariosActivos',
            'ultimosTraslados',
            'mantenimientosPorEstado',
            'recursosPorEstado',
            'ultimosBitacora'
        ));
    }
}
