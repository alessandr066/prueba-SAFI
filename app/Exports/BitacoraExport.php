<?php
namespace App\Exports;

use App\Models\Bitacora;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;

class BitacoraExport implements FromCollection
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Bitacora::with(['usuario','accion'])->orderBy('fecha','desc');

        if ($this->request->filled('fecha_inicio') && $this->request->filled('fecha_fin')) {
            $query->whereBetween('fecha', [$this->request->fecha_inicio, $this->request->fecha_fin]);
        }
        if ($this->request->filled('accion_id')) {
            $query->where('accion_id', $this->request->accion_id);
        }

        return $query->get();
    }
}
