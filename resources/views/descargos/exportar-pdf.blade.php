<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Historial de Descargos</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #b71c1c;
            color: white;
        }

        h2 {
            color: #b71c1c;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Universidad de El Salvador</h2>
    <h3 style="text-align:center;">Historial de Descargos</h3>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Recurso</th>
                <th>Tipo Descargo</th>
                <th>Motivo</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($descargos as $descargo)
                <tr>
                    <td>{{ $descargo->fecha }}</td>
                    <td>{{ $descargo->recurso->producto->nombre ?? '-' }}</td>
                    <td>{{ $descargo->tipoDescargo->nombre ?? '-' }}</td>
                    <td>{{ $descargo->motivo ?? '-' }}</td>
                    <td>{{ $descargo->observaciones ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="text-align:right; margin-top:20px;">
        Generado el {{ now()->format('d/m/Y H:i') }}
    </p>
</body>

</html>
