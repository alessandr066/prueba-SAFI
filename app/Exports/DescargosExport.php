<?php

namespace App\Exports;

use App\Models\Descargo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DescargosExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return Descargo::with(['recurso.producto', 'tipoDescargo'])
            ->orderBy('fecha', 'desc')
            ->get()
            ->map(function ($descargo) {
                return [
                    'Fecha' => $descargo->fecha,
                    'Recurso' => $descargo->recurso->producto->nombre ?? '-',
                    'Tipo Descargo' => $descargo->tipoDescargo->nombre ?? '-',
                    'Motivo' => $descargo->motivo ?? '-',
                    'Observaciones' => $descargo->observaciones ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return ['Fecha', 'Recurso', 'Tipo Descargo', 'Motivo', 'Observaciones'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
