<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Traslados</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    {{-- Encabezado del reporte --}}
    <h2>Reporte de Traslados</h2>

    {{-- Tabla de traslados --}}
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Producto</th>
                <th>Tipo Traslado</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($traslados as $t)
                <tr>
                    <td>{{ $t->id_traslado }}</td>
                    <td>{{ $t->fecha }}</td>
                    <td>{{ $t->recurso->producto->nombre ?? '-' }}</td>
                    <td>{{ $t->tipoTraslado->nombre ?? '-' }}</td>
                    <td>{{ $t->ubicacionOrigen->nombre ?? '-' }}</td>
                    <td>{{ $t->ubicacionDestino->nombre ?? '-' }}</td>
                    <td>{{ $t->descripcion ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No hay traslados registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>