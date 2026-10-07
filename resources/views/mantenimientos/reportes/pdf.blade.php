<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Mantenimientos</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #e41e26;
            color: white;
        }

        h2 {
            text-align: center;
            color: #e41e26;
        }
    </style>
</head>

<body>
    <h2>Reporte de Mantenimientos</h2>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Fecha Fin</th>
                <th>Producto</th>
                <th>Tipo</th>
                <th>Técnico</th>
                <th>Estado</th>
                <th>Estado Recurso</th>
                <th>Descripción</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($mantenimientos as $m)
                <tr>
                    <td>{{ $m->fecha }}</td>
                    <td>{{ $m->fecha_fin ?? '-' }}</td>
                    <td>{{ $m->recurso->producto->nombre ?? '-' }}</td>
                    <td>{{ $m->tipoMantenimiento->nombre ?? '-' }}</td>
                    <td>{{ $m->tecnico->nombre ?? '-' }}</td>
                    <td>{{ $m->estado ?? '-' }}</td>
                    <td>{{ $m->recurso->estado->nombre ?? '-' }}</td>
                    <td>{{ $m->descripcion ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>


</html>
