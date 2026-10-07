<x-app-layout>
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="max-w-3xl mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-ues-primary mb-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">Detalle del Mantenimiento</h2>

        <div class="bg-white shadow rounded-lg p-6 space-y-4">
            <div>
                <p class="font-semibold text-gray-700">Fecha:</p>
                <p class="text-sm text-gray-600">{{ $mantenimiento->fecha }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Recurso:</p>
                <p class="text-sm text-gray-600">{{ $mantenimiento->recurso->producto->nombre ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Tipo:</p>
                <p class="text-sm text-gray-600">{{ $mantenimiento->tipoMantenimiento->nombre ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Técnico:</p>
                <p class="text-sm text-gray-600">{{ $mantenimiento->tecnico->nombre ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Descripción:</p>
                <p class="text-sm text-gray-600">{{ $mantenimiento->descripcion ?? 'Sin descripción' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">
                    Estado:</p>
                <p class="text-sm text-gray-600">
                    @php
                        $badgeClass = match ($mantenimiento->estado) {
                            'finalizado' => 'bg-green-600 text-white',
                            'pendiente' => 'bg-yellow-500 text-white',
                            default => 'bg-gray-500 text-white',
                        };
                    @endphp
                    <span class="px-3 py-1 rounded text-xs font-semibold {{ $badgeClass }}">
                        {{ ucfirst($mantenimiento->estado ?? 'pendiente') }}
                    </span>
                </p>
            </div>
            <form method="POST" action="{{ route('mantenimientos.finalizar', $mantenimiento->id_mantenimiento) }}">
                @csrf
                @if ($mantenimiento->estado === 'finalizado')
                    <span class="inline-block px-4 py-2 bg-gray-400 text-white rounded">
                        Ya finalizado
                    </span>
                @else
                    <form method="POST"
                        action="{{ route('mantenimientos.finalizar', $mantenimiento->id_mantenimiento) }}">
                        @csrf
                        <button type="submit"
                            class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                            Finalizar mantenimiento
                        </button>
                    </form>
                @endif
        </div>
        {{-- Botón regresar --}}
        <div class="mt-6">
            <a href="{{ route('mantenimientos.index') }}"
                class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                ← Volver al listado
            </a>
        </div>
    </div>
</x-app-layout>
