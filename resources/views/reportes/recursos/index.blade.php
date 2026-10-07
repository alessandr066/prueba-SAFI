<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold mb-6 text-ues-primary">Reporte General de Recursos</h2>

        {{-- Filtros --}}
        <form method="GET" class="bg-white p-4 rounded-lg shadow mb-6 grid grid-cols-1 md:grid-cols-6 gap-4">
            <div>
                <label class="block text-sm font-medium">Estado</label>
                <select name="estado_id" class="w-full border rounded">
                    <option value="">Todos</option>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->id_estado }}"
                            {{ request('estado_id') == $estado->id_estado ? 'selected' : '' }}>
                            {{ $estado->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium">Ubicación</label>
                <select name="ubicacion_id" class="w-full border rounded">
                    <option value="">Todas</option>
                    @foreach ($ubicaciones as $ubicacion)
                        <option value="{{ $ubicacion->id_ubicacion }}"
                            {{ request('ubicacion_id') == $ubicacion->id_ubicacion ? 'selected' : '' }}>
                            {{ $ubicacion->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium">Desde</label>
                <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}"
                    class="w-full border rounded">
            </div>
            <div>
                <label class="block text-sm font-medium">Hasta</label>
                <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}" class="w-full border rounded">
            </div>
            <div class="flex items-end space-x-2">
                <button type="submit"
                    class="bg-ues-primary text-white px-4 py-2 rounded hover:bg-ues-secondary">Filtrar</button>
                <a href="{{ route('reportes.recursos.index') }}"
                    class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">Limpiar</a>
            </div>
        </form>

        {{-- Tabla --}}
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="min-w-full border-collapse text-sm">
                <thead class="bg-ues-primary text-white">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Código</th>
                        <th class="px-4 py-3 text-left font-semibold">Producto</th>
                        <th class="px-4 py-3 text-left font-semibold">Estado</th>
                        <th class="px-4 py-3 text-left font-semibold">Ubicación</th>
                        <th class="px-4 py-3 text-left font-semibold">Empleado</th>
                        <th class="px-4 py-3 text-right font-semibold">Valor ($)</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($recursos as $r)
                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-3 font-medium text-gray-600">
                                {{ $r->codigo }}
                            </td>

                            <td class="px-4 py-3 text-gray-700">
                                {{ $r->producto->nombre ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-gray-200 text-gray-700">
                                    {{ $r->estado->nombre ?? '-' }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-gray-700">
                                {{ $r->ubicacion->nombre ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-gray-700">
                                {{ $r->empleado ? $r->empleado->nombres . ' ' . $r->empleado->apellidos : 'No asignado' }}
                            </td>

                            <td class="px-4 py-3 text-right font-semibold text-gray-700">
                                ${{ number_format($r->valor_recurso, 2) }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                                No hay recursos para mostrar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Exportar --}}
        <div class="mt-6 flex space-x-2">
            <a href="{{ route('reportes.recursos.excel') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mb-4 inline-block">Exportar
                Excel</a>
            <a href="{{ route('reportes.recursos.pdf') }}"
                class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded mb-4 inline-block">Exportar
                PDF</a>
        </div>

        <div class="mt-4">{{ $recursos->links() }}</div>
    </div>
</x-app-layout>
