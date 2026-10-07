<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-8">

        {{-- Título --}}
        <h2 class="text-2xl font-bold text-ues-primary mb-6">
            Editar Recurso
        </h2>

        {{-- Alerta recurso dado de baja --}}
        @if ($recurso->estado_id == 5)
            <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg mb-6 text-sm">
                Este recurso está <strong>DADO DE BAJA</strong>. No puede editarse.
            </div>
        @endif

        <div class="bg-white shadow rounded-xl p-6">

            <form action="{{ route('inventario.update', $recurso->id_recurso) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Fecha ingreso --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-600">
                            Fecha de ingreso
                        </label>
                        <input type="date" value="{{ $recurso->fecha_ingreso }}"
                            class="mt-1 w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-600"
                            disabled>
                    </div>

                    {{-- Producto --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-600">
                            Producto
                        </label>
                        <select class="mt-1 w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-600"
                            disabled>
                            @foreach ($productos as $producto)
                                <option {{ $recurso->producto_id == $producto->id_producto ? 'selected' : '' }}>
                                    {{ $producto->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Estado --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-600">
                            Estado
                        </label>
                        <select class="mt-1 w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-600"
                            disabled>
                            @foreach ($estados as $estado)
                                <option {{ $recurso->estado_id == $estado->id_estado ? 'selected' : '' }}>
                                    {{ $estado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Ubicación (editable) --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-600">
                            Ubicación
                        </label>
                        <select name="ubicacion_id"
                            class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring-ues-primary focus:border-ues-primary">
                            @foreach ($ubicaciones as $ubicacion)
                                <option value="{{ $ubicacion->id_ubicacion }}"
                                    {{ $recurso->ubicacion_id == $ubicacion->id_ubicacion ? 'selected' : '' }}>
                                    {{ $ubicacion->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Empleado asignado --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-600">
                            Empleado asignado
                        </label>
                        <input type="text"
                            value="{{ $recurso->empleado ? $recurso->empleado->nombres . ' ' . $recurso->empleado->apellidos : 'No asignado' }}"
                            class="mt-1 w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-600"
                            disabled>
                    </div>

                    {{-- Fecha adquisición --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-600">
                            Fecha de adquisición
                        </label>
                        <input type="date" value="{{ $recurso->fecha_adquisicion }}"
                            class="mt-1 w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-600"
                            disabled>
                    </div>

                    {{-- Valor --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-600">
                            Valor del recurso
                        </label>
                        <input type="number" step="0.01" value="{{ $recurso->valor_recurso }}"
                            class="mt-1 w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-600"
                            disabled>
                    </div>

                </div>

                {{-- Botones --}}
                <div class="flex justify-between items-center pt-6 border-t">

                    <a href="{{ route('inventario.index') }}"
                        class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                        ← Volver al listado
                    </a>

                    @if ($recurso->estado_id != 5)
                        <button type="submit"
                            class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow text-sm">
                            Actualizar recurso
                        </button>
                    @endif

                </div>

            </form>
        </div>

    </div>
</x-app-layout>
