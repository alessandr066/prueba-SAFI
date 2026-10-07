<x-app-layout>
    <div class="max-w-3xl mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-ues-primary mb-6">Detalle de Producto</h2>

        <div class="bg-white shadow rounded-lg p-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700 items-center">
            <div>
                <p class="font-semibold text-gray-700">Nombre:</p>
                <p class="text-sm text-gray-600">{{ $producto->nombre }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Descripción:</p>
                <p class="text-sm text-gray-600">{{ $producto->descripcion }}</p>
            </div>
        </div>

        {{-- Botón regresar --}}
        <div class="mt-6">
            <a href="{{ route('productos.index') }}"
                class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                ← Volver al listado
            </a>
        </div>
    </div>
</x-app-layout>
