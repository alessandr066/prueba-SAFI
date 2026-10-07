<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Producto</th>
            <th>Tipo</th>
            <th>Técnico</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mantenimientos as $m)
            <tr>
                <td>{{ $m->fecha }}</td>
                <td>{{ $m->recurso->producto->nombre ?? '-' }}</td>
                <td>{{ $m->tipoMantenimiento->nombre ?? '-' }}</td>
                <td>{{ $m->tecnico->nombre ?? '-' }}</td>
                <td>{{ $m->descripcion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
