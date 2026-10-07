<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class RecursosExport implements FromCollection
{
    protected $recursos;

    public function __construct($recursos)
    {
        $this->recursos = $recursos;
    }

    public function collection()
    {
        return new Collection($this->recursos->map(function ($r) {
            return [
                'Código' => $r->codigo,
                'Producto' => $r->producto->nombre ?? '-',
                'Estado' => $r->estado->nombre ?? '-',
                'Ubicación' => $r->ubicacion->nombre ?? '-',
                'Empleado' => $r->empleado->nombres ?? '-',
                'Fecha Adquisición' => $r->fecha_adquisicion,
                'Valor ($)' => $r->valor_recurso,
            ];
        }));
    }
}
