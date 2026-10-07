<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-8">

        {{-- Título --}}
        <h2 class="text-2xl font-bold text-ues-primary mb-6">
            Detalles del Recurso
        </h2>

        {{-- Información general --}}
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">

                <div>
                    <p class="font-semibold text-gray-700">Producto</p>
                    <p class="text-sm text-gray-600">
                        {{ $recurso->producto->nombre ?? '—' }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Estado</p>
                    <p class="text-sm text-gray-600">
                        {{ $recurso->estado->nombre ?? '—' }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Ubicación</p>
                    <p class="text-sm text-gray-600">
                        {{ $recurso->ubicacion->nombre ?? '—' }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Empleado asignado</p>
                    <p class="text-sm text-gray-600">
                        {{ $recurso->empleado ? $recurso->empleado->nombres . ' ' . $recurso->empleado->apellidos : 'No asignado' }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">
                        Fecha de adquisición
                        <span class="text-xs text-gray-400">(factura / documento)</span>
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ $recurso->fecha_adquisicion ? \Carbon\Carbon::parse($recurso->fecha_adquisicion)->format('d/m/Y') : '—' }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">
                        Fecha de ingreso
                        <span class="text-xs text-gray-400">(registro en inventario)</span>
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ $recurso->fecha_ingreso ? \Carbon\Carbon::parse($recurso->fecha_ingreso)->format('d/m/Y') : '—' }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Valor del recurso</p>
                    <p class="text-sm text-gray-600">
                        ${{ number_format($recurso->valor_recurso ?? 0, 2) }}
                    </p>
                </div>

            </div>
        </div>

        {{-- Historial de Traslados --}}
        <h3 class="text-xl font-bold text-ues-primary mb-4">
            Historial de Traslados
        </h3>

        <div class="bg-white rounded-xl shadow overflow-x-auto mb-8">
            <table class="min-w-full text-sm border-collapse">
                @if ($recurso->siniestros()->where('estado', 'Aprobado')->exists())
                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-semibold">
                        ⚠ Recurso con siniestro
                    </span>
                @endif

                {{-- HEADER --}}
                <thead class="bg-ues-primary text-white">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Fecha</th>
                        <th class="px-4 py-3 text-left font-semibold">Tipo</th>
                        <th class="px-4 py-3 text-left font-semibold">Origen</th>
                        <th class="px-4 py-3 text-left font-semibold">Destino</th>
                        <th class="px-4 py-3 text-left font-semibold">Descripción</th>
                    </tr>
                </thead>

                {{-- BODY --}}
                <tbody class="divide-y divide-gray-200">
                    @forelse($recurso->traslados as $traslado)
                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-3 font-medium text-gray-600 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($traslado->fecha)->format('d/m/Y') }}
                            </td>

                            <td class="px-4 py-3 font-medium text-gray-700">
                                {{ $traslado->tipoTraslado->nombre ?? '—' }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $traslado->ubicacionOrigen->nombre ?? '—' }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $traslado->ubicacionDestino->nombre ?? '—' }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $traslado->descripcion ?? '—' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                                No hay traslados registrados para este recurso.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
        {{-- Historial de Mantenimientos --}}
        <h3 class="text-xl font-bold text-ues-primary mb-4">
            Historial de Mantenimientos
        </h3>

        @if ($recurso->mantenimientos->isEmpty())
            <p class="text-gray-500">
                Este recurso no tiene mantenimientos registrados.
            </p>
        @else
            <div class="bg-white rounded-xl shadow overflow-x-auto mb-8">
                <table class="min-w-full text-sm border-collapse">

                    {{-- HEADER --}}
                    <thead class="bg-ues-primary text-white">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Fecha</th>
                            <th class="px-4 py-3 text-left font-semibold">Técnico</th>
                            <th class="px-4 py-3 text-left font-semibold">Tipo</th>
                            <th class="px-4 py-3 text-left font-semibold">Descripción</th>
                        </tr>
                    </thead>
                    {{-- BODY --}}
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($recurso->mantenimientos as $mantenimiento)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-4 py-3 font-medium text-gray-600 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($mantenimiento->fecha)->format('d/m/Y') }}
                                </td>

                                <td class="px-4 py-3 text-gray-700">
                                    {{ $mantenimiento->tecnico->nombre ?? '—' }}
                                </td>

                                <td class="px-4 py-3 text-gray-700">
                                    {{ $mantenimiento->tipoMantenimiento->nombre ?? '—' }}
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    {{ $mantenimiento->descripcion ?? '—' }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                                    No hay mantenimientos registrados para este recurso.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        @endif

        {{-- Botón regresar --}}
        <div class="mt-6">
            <a href="{{ route('recursos.index') }}"
                class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                ← Volver al listado
            </a>
        </div>

    </div>
</x-app-layout>
