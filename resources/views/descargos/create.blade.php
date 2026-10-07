<x-app-layout>
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow">

        <h2 class="text-2xl font-bold text-ues-primary mb-6">Registrar Descargo de Bien</h2>

        <form method="POST" action="{{ route('descargos.store') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="recurso_id" value="{{ $recurso->id_recurso }}">

            <div>
                <label class="font-semibold">Producto:</label>
                <p class="border rounded px-3 py-2 bg-gray-100">{{ $recurso->producto->nombre }}</p>
            </div>

            <div>
                <label for="tipo_descargo_id" class="block font-semibold">Tipo de Descargo:</label>
                <select id="tipo_descargo_id" name="tipo_descargo_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Seleccione...</option>
                    @foreach ($tiposDescargo as $tipo)
                        <option value="{{ $tipo->id_tipo_descargo }}">{{ $tipo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="motivo" class="block font-semibold">Motivo:</label>
                <input id="motivo" type="text" name="motivo" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label for="observaciones" class="block font-semibold">Observaciones:</label>
                <textarea id="observaciones" name="observaciones" class="w-full border rounded px-3 py-2"></textarea>
            </div>

            <div>
                <label for="fecha" class="block font-semibold">Fecha del Descargo:</label>
                <input id="fecha" type="date" name="fecha" class="w-full border rounded px-3 py-2" required>
            </div>

            {{-- Botones simétricos --}}
            <div class="mt-8 flex justify-between">
                {{-- Botón regresar --}}
                <a href="{{ route('inventario.index') }}"
                    class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                    ← Volver al listado
                </a>
                <button type="submit" class="bg-ues-primary hover:bg-ues-secondary text-white px-6 py-2 rounded-md">
                    Registrar Descargo
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
