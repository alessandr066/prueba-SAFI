<x-app-layout>
    <div class="max-w-3xl mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-ues-primary mb-6">Detalle del Traslado</h2>

        <div class="bg-white shadow rounded-lg p-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700 items-center">
            <div>
                <p class="font-semibold text-gray-700">Fecha:</p>
                <p class="text-sm text-gray-600">{{ $traslado->fecha }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Producto:</p>
                <p class="text-sm text-gray-600">{{ $traslado->recurso->producto->nombre ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Tipo de Traslado:</p>
                <p class="text-sm text-gray-600">{{ $traslado->tipoTraslado->nombre ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Ubicación Origen:</p>
                <p class="text-sm text-gray-600">{{ $traslado->ubicacionOrigen->nombre ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Ubicación Destino:</p>
                <p class="text-sm text-gray-600">{{ $traslado->ubicacionDestino->nombre ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Empleado Responsable:</p>
                <p class="text-sm text-gray-600">{{ $traslado->recurso->empleado->nombres ?? 'N/A' }}
                    {{ $traslado->recurso->empleado->apellidos ?? '' }}
                </p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Descripción:</p>
                <p class="text-sm text-gray-600">{{ $traslado->descripcion ?? '-' }}</p>
            </div>
        </div>
        {{-- Botón regresar --}}
        <div class="mt-6">
            <a href="{{ route('traslados.index') }}"
                class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                ← Volver al listado
            </a>
        </div>
    </div>
</x-app-layout>
