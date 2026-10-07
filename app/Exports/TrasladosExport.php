<?php

namespace App\Exports;

use App\Models\Traslado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TrasladosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Traslado::with(['recurso.producto','tipoTraslado','ubicacionOrigen','ubicacionDestino'])
            ->get()
            ->map(function ($t) {
                return [
                    'ID'           => $t->id_traslado,
                    'Fecha'        => $t->fecha,
                    'Producto'     => $t->recurso->producto->nombre ?? '-',
                    'Tipo'         => $t->tipoTraslado->nombre ?? '-',
                    'Origen'       => $t->ubicacionOrigen->nombre ?? '-',
                    'Destino'      => $t->ubicacionDestino->nombre ?? '-',
                    'Descripción'  => $t->descripcion ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Producto',
            'Tipo Traslado',
            'Origen',
            'Destino',
            'Descripción'
        ];
    }
}
