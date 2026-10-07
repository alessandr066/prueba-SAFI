<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Bitácora del Sistema</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #b91c1c;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #999;
        }

        th {
            background-color: #b91c1c;
            color: white;
            text-align: left;
            padding: 6px;
        }

        td {
            padding: 6px;
        }

        /* Estilo para imprimir JSON */
        pre {
            background: #000;
            color: #00ff7f;
            padding: 6px;
            border-radius: 4px;
            font-size: 10px;
            overflow-x: auto;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
            color: #b91c1c;
        }
    </style>
</head>

<body>

    <h2>Historial de Bitácora</h2>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Acción</th>
                <th>Módulo</th>
                <th>IP</th>
            </tr>
        </thead>

        <tbody>

            @forelse($registros as $registro)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y H:i') }}</td>
                    <td>{{ $registro->usuario->username ?? '-' }}</td>
                    <td>{{ $registro->accion->nombre ?? '-' }}</td>
                    <td>{{ ucfirst($registro->modulo) ?? '-' }}</td>
                    <td>{{ $registro->ip ?? '-' }}</td>
                </tr>

                {{-- ===============================
                    DATOS ANTERIORES (JSON)
                =============================== --}}
                @if ($registro->datos_anteriores)
                    <tr>
                        <td colspan="5">
                            <div class="section-title">Datos anteriores:</div>
                            <pre>{{ json_encode($registro->datos_anteriores, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        </td>
                    </tr>
                @endif

                {{-- ===============================
                    DATOS NUEVOS (JSON)
                =============================== --}}
                @if ($registro->datos_nuevos)
                    <tr>
                        <td colspan="5">
                            <div class="section-title">Datos nuevos:</div>
                            <pre>{{ json_encode($registro->datos_nuevos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        </td>
                    </tr>
                @endif

            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No hay registros disponibles.</td>
                </tr>
            @endforelse

        </tbody>
    </table>

</body>

</html>
