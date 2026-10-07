<x-app-layout>
    <div class="container mx-auto px-4 py-6">

        {{-- Título --}}
        <h2 class="text-2xl font-bold text-ues-primary mb-6">Bitácora del Sistema</h2>

        {{-- =========================
            FILTROS
        ============================ --}}
        <div class="bg-white p-4 rounded-xl shadow mb-6">
            <form method="GET" action="{{ route('bitacora.index') }}"
                class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end">

                {{-- Usuario --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Usuario</label>
                    <input type="text" name="usuario" value="{{ request('usuario') }}"
                        class="mt-1 border-gray-300 rounded-lg w-full text-sm">
                </div>

                {{-- Acción --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Acción</label>
                    <select name="accion_id" class="mt-1 border-gray-300 rounded-lg w-full text-sm">
                        <option value="">Todas</option>
                        <option value="1" {{ request('accion_id') == 1 ? 'selected' : '' }}>Crear</option>
                        <option value="2" {{ request('accion_id') == 2 ? 'selected' : '' }}>Revisar</option>
                        <option value="3" {{ request('accion_id') == 3 ? 'selected' : '' }}>Aprobar</option>
                        <option value="4" {{ request('accion_id') == 4 ? 'selected' : '' }}>Rechazar</option>
                        <option value="5" {{ request('accion_id') == 5 ? 'selected' : '' }}>Descargo</option>
                    </select>
                </div>

                {{-- Fecha --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha</label>
                    <input type="date" name="fecha" value="{{ request('fecha') }}"
                        class="mt-1 border-gray-300 rounded-lg w-full text-sm">
                </div>

                {{-- Módulo (NUEVO) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Módulo</label>
                    <select name="modulo" class="mt-1 border-gray-300 rounded-lg w-full text-sm">
                        <option value="">Todos</option>
                        <option value="usuarios" {{ request('modulo') == 'usuarios' ? 'selected' : '' }}>Usuarios
                        </option>
                        <option value="recursos" {{ request('modulo') == 'recursos' ? 'selected' : '' }}>Recursos
                        </option>
                        <option value="mantenimientos" {{ request('modulo') == 'mantenimientos' ? 'selected' : '' }}>
                            Mantenimientos</option>
                        <option value="traslados" {{ request('modulo') == 'traslados' ? 'selected' : '' }}>Traslados
                        </option>
                        <option value="descargos" {{ request('modulo') == 'descargos' ? 'selected' : '' }}>Descargos
                        </option>
                        <option value="reportes" {{ request('modulo') == 'reportes' ? 'selected' : '' }}>Reportes
                        </option>
                        <option value="bitacora" {{ request('modulo') == 'bitacora' ? 'selected' : '' }}>Bitácora
                        </option>
                    </select>
                </div>

                {{-- Botones --}}
                <div class="flex space-x-2">
                    <button type="submit"
                        class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded-lg text-sm">
                        Filtrar
                    </button>

                    <a href="{{ route('bitacora.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-sm">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>

        {{-- =========================
            EXPORTACIONES
        ============================ --}}
        <div class="flex space-x-2 mb-4">
            <a href="{{ route('bitacora.export.excel', request()->all()) }}"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mb-4 inline-block">
                Exportar a Excel
            </a>

            <a href="{{ route('bitacora.export.pdf', request()->all()) }}"
                class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded mb-4 inline-block">
                Exportar a PDF
            </a>
        </div>

        {{-- =========================
            TABLA DE RESULTADOS
        ============================ --}}
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="min-w-full border-collapse text-sm">
                <thead class="bg-ues-primary text-white">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Fecha</th>
                        <th class="px-4 py-3 text-left font-semibold">Usuario</th>
                        <th class="px-4 py-3 text-left font-semibold">Acción</th>
                        <th class="px-4 py-3 text-left font-semibold">Descripción</th>
                        <th class="px-4 py-3 text-left font-semibold">Módulo</th>
                        <th class="px-4 py-3 text-center font-semibold">Detalle</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($bitacoras as $log)
                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-3 text-gray-600 font-medium whitespace-nowrap">
                                {{ $log->fecha }}
                            </td>

                            <td class="px-4 py-3 text-gray-700">
                                {{ $log->usuario->username ?? '—' }}
                            </td>

                            <td class="px-4 py-3">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                            bg-gray-200 text-gray-700">
                                    {{ $log->accion->nombre ?? '—' }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-gray-700">
                                {{ $log->accion->descripcion ?? '—' }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ ucfirst($log->modulo ?? '—') }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('bitacora.show', $log->id_bitacora) }}"
                                    class="inline-block bg-ues-primary hover:bg-ues-secondary
                                  text-white px-3 py-1 rounded text-xs transition">
                                    Ver
                                </a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                                No hay registros en la bitácora.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Paginación --}}
        <div class="mt-4">
            {{ $bitacoras->links() }}
        </div>
    </div>
</x-app-layout>
