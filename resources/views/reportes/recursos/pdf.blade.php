<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Recursos</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 30px;
            font-size: 12px;
            color: #333;
        }

        header {
            text-align: center;
            border-bottom: 2px solid #B30000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        header img {
            height: 70px;
        }

        h1 {
            font-size: 18px;
            color: #B30000;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 14px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background-color: #B30000;
            color: #fff;
            padding: 6px;
            text-align: left;
            font-size: 12px;
        }

        td {
            border-bottom: 1px solid #ddd;
            padding: 6px;
            font-size: 11px;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #777;
        }

        .firma {
            margin-top: 60px;
            text-align: center;
        }

        .firma-linea {
            border-top: 1px solid #333;
            width: 200px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <header>
        <img src="{{ public_path('/assets/images/logo_ues.png') }}" alt="Logo UES">
        <h1>Universidad de El Salvador</h1>
        <div class="subtitle">Sistema de Administración de Bienes - SAFI</div>
        <p><strong>Reporte General de Recursos</strong></p>
        <small>Generado el {{ now()->format('d/m/Y H:i') }}</small>
    </header>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Estado</th>
                <th>Ubicación</th>
                <th>Empleado</th>
                <th>Valor ($)</th>
                <th>Fecha Adquisición</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recursos as $r)
                <tr>
                    <td>{{ $r->codigo }}</td>
                    <td>{{ $r->producto->nombre ?? '-' }}</td>
                    <td>{{ $r->estado->nombre ?? '-' }}</td>
                    <td>{{ $r->ubicacion->nombre ?? '-' }}</td>
                    <td>{{ $r->empleado->nombres ?? '-' }}</td>
                    <td>${{ number_format($r->valor_recurso, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($r->fecha_adquisicion)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="firma">
        <p class="firma-linea"></p>
        <p>Responsable de Inventario</p>
    </div>

    <footer>
        <p>© Universidad de El Salvador — SAFI {{ date('Y') }}</p>
    </footer>
</body>

</html>
