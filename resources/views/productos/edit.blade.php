<x-app-layout>
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">Editar Producto</h2>
        <form method="POST" action="{{ route('productos.update', $producto->id_producto) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block font-medium">Nombre</label>
                <input type="text" name="nombre" value="{{ $producto->nombre }}" class="w-full border rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded px-3 py-2">{{ $producto->descripcion }}</textarea>
            </div>
            <div class="mt-8 flex justify-between">
                {{-- Botón regresar --}}
                <a href="{{ route('productos.index') }}"
                    class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                    ← Volver al listado
                </a>
                <button type="submit" class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
