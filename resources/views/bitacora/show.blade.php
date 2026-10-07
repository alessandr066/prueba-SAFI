<x-app-layout>
    <div class="max-w-3xl mx-auto px-6 py-8">

        {{-- Título --}}
        <h2 class="text-2xl font-bold text-ues-primary mb-6">Detalles del Registro de Bitácora</h2>

        <div class="bg-white shadow rounded-xl p-6 space-y-6">

            {{-- ID --}}
            <div>
                <span class="font-semibold text-gray-700">ID de bitácora:</span>
                <p class="text-sm text-gray-600">{{ $bitacora->id_bitacora }}</p>
            </div>

            {{-- Usuario --}}
            <div>
                <span class="font-semibold text-gray-700">Usuario:</span>
                <p class="text-sm text-gray-600">{{ $bitacora->usuario->username ?? 'N/A' }}</p>
            </div>

            {{-- Acción --}}
            <div>
                <span class="font-semibold text-gray-700">Acción realizada:</span>
                <p class="text-sm text-gray-600">{{ $bitacora->accion->nombre ?? 'N/A' }}</p>
            </div>

            {{-- Módulo --}}
            <div>
                <span class="font-semibold text-gray-700">Módulo:</span>
                <p class="text-sm text-gray-600 capitalize">{{ $bitacora->modulo ?? 'N/A' }}</p>
            </div>

            {{-- Fecha --}}
            <div>
                <span class="font-semibold text-gray-700">Fecha:</span>
                <p class="text-sm text-gray-600">{{ $bitacora->fecha }}</p>
            </div>

            {{-- IP --}}
            <div>
                <span class="font-semibold text-gray-700">IP:</span>
                <p class="text-sm text-gray-600">{{ $bitacora->ip ?? 'N/A' }}</p>
            </div>

            {{-- ===============================
                    DATOS ANTERIORES
               =============================== --}}
            <div>
                <span class="font-semibold text-gray-700 block mb-1">Datos anteriores:</span>

                @php
                    $before = $bitacora->datos_anteriores;
                @endphp

                @if ($before)
                    <details class="group bg-gray-100 rounded-lg p-3 border border-gray-300">
                        <summary class="cursor-pointer text-sm font-semibold text-ues-primary">
                            Ver datos anteriores (JSON)
                        </summary>

                        <pre class="mt-3 p-3 bg-black text-green-400 rounded-lg text-xs overflow-x-auto">
{{ json_encode($before, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                        </pre>
                    </details>
                @else
                    <div class="p-3 bg-gray-50 border rounded-lg text-sm text-gray-700">
                        No hay datos anteriores registrados.
                    </div>
                @endif
            </div>

            {{-- ===============================
                    DATOS NUEVOS
               =============================== --}}
            <div>
                <span class="font-semibold text-gray-700 block mb-1">Datos nuevos:</span>

                @php
                    $after = $bitacora->datos_nuevos;
                @endphp

                @if ($after)
                    <details class="group bg-gray-100 rounded-lg p-3 border border-gray-300">
                        <summary class="cursor-pointer text-sm font-semibold text-ues-primary">
                            Ver datos nuevos (JSON)
                        </summary>

                        <pre class="mt-3 p-3 bg-black text-green-400 rounded-lg text-xs overflow-x-auto">
{{ json_encode($after, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                        </pre>
                    </details>
                @else
                    <div class="p-3 bg-gray-50 border rounded-lg text-sm text-gray-700">
                        No hay datos nuevos registrados.
                    </div>
                @endif
            </div>
        </div>

        {{-- Volver --}}
        <div class="mt-6">
            <a href="{{ route('bitacora.index') }}"
                class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded-lg">
                ← Volver al historial
            </a>
        </div>

    </div>
</x-app-layout>
