<x-app-layout>
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">Editar Técnico</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('tecnicos.update', $tecnico->id_tecnico) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $tecnico->nombre) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded px-3 py-2">{{ old('descripcion', $tecnico->descripcion) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Estado</label>
                <select name="estado" class="w-full border rounded px-3 py-2">
                    <option value="activo" {{ old('estado', $tecnico->estado) == 'activo' ? 'selected' : '' }}>Activo
                    </option>
                    <option value="inactivo" {{ old('estado', $tecnico->estado) == 'inactivo' ? 'selected' : '' }}>
                        Inactivo</option>
                </select>
            </div>
            <div class="mt-8 flex justify-between">
                {{-- Botón regresar --}}
                <a href="{{ route('tecnicos.index') }}"
                    class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                    ← Volver al listado
                </a>
                <button class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded">
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
