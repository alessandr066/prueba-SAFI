<?php

namespace App\Exports;

use App\Models\Mantenimiento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MantenimientosExport implements FromCollection, WithHeadings, WithStyles
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Mantenimiento::with(['recurso.producto', 'recurso.estado', 'tipoMantenimiento', 'tecnico'])
            ->orderBy('fecha', 'desc');

        if ($this->request->filled('tipo_mantenimiento_id')) {
            $query->where('tipo_mantenimiento_id', $this->request->tipo_mantenimiento_id);
        }

        if ($this->request->filled('tecnico_id')) {
            $query->where('tecnico_id', $this->request->tecnico_id);
        }

        if ($this->request->filled('fecha_inicio') && $this->request->filled('fecha_fin')) {
            $query->whereBetween('fecha', [$this->request->fecha_inicio, $this->request->fecha_fin]);
        }

        return $query->get()->map(function ($m) {
            return [
                'Fecha'              => $m->fecha,
                'Fecha Finalización' => $m->fecha_fin ?? '-',
                'Producto'           => $m->recurso->producto->nombre ?? '-',
                'Código Recurso'     => $m->recurso->codigo ?? '-',
                'Tipo'               => $m->tipoMantenimiento->nombre ?? '-',
                'Técnico'            => $m->tecnico->nombre ?? '-',
                'Estado Mantenimiento' => $m->estado ?? '-',
                'Estado Recurso'       => $m->recurso->estado->nombre ?? '-',
                'Descripción'         => $m->descripcion ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Fecha Finalización',
            'Producto',
            'Código Recurso',
            'Tipo',
            'Técnico',
            'Estado Mantenimiento',
            'Estado Recurso',
            'Descripción',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }
}
