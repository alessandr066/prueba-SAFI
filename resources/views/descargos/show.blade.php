<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-8">
        {{-- Título --}}
        <h2 class="text-2xl font-bold text-ues-primary mb-6">Detalles del Descargo</h2>

        {{-- Tarjeta de información --}}
        <div class="bg-white shadow rounded-lg p-6 space-y-4 border border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="font-semibold text-gray-700">Código del Recurso:</p>
                    <p class="text-sm text-gray-600">{{ $descargo->recurso->codigo ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Producto:</p>
                    <p class="text-sm text-gray-600">{{ $descargo->recurso->producto->nombre ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Tipo de Descargo:</p>
                    <p class="text-sm text-gray-600">{{ $descargo->tipoDescargo->nombre ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Fecha:</p>
                    <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($descargo->fecha)->format('d/m/Y') }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Motivo:</p>
                    <p class="text-sm text-gray-600">{{ $descargo->motivo ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Observaciones:</p>
                    <p class="text-sm text-gray-600">{{ $descargo->observaciones ?? 'Sin observaciones' }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Estado actual del Recurso:</p>
                    <p class="text-sm text-gray-600">{{ $descargo->recurso->estado->nombre ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Ubicación:</p>
                    <p class="text-sm text-gray-600">{{ $descargo->recurso->ubicacion->nombre ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        {{-- Botón regresar --}}
        <div class="mt-6">
            <a href="{{ route('descargos.index') }}"
                class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                ← Volver al listado
            </a>
        </div>
    </div>
</x-app-layout>
