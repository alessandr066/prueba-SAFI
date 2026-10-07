<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-8 bg-white shadow rounded-lg">

        <h2 class="text-xl font-bold mb-4">
            Registrar Recurso
        </h2>

        <form action="{{ route('inventario.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Código --}}
            <div>
                <label class="block font-medium">Código</label>
                <input type="text" name="codigo" value="{{ old('codigo') }}" required
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Nombre --}}
            <div>
                <label class="block font-medium">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block font-medium">Descripción</label>
                <textarea name="descripcion" rows="3" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('descripcion') }}</textarea>
            </div>

            {{-- Fecha ingreso --}}
            <div>
                <label class="block font-medium">Fecha de ingreso al inventario</label>
                <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}" required
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Producto --}}
            <div>
                <label class="block font-medium">Producto</label>
                <select name="producto_id" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Seleccione un producto</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id_producto }}"
                            {{ old('producto_id') == $producto->id_producto ? 'selected' : '' }}>
                            {{ $producto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Estado --}}
            <div>
                <label class="block font-medium">Estado</label>
                <select name="estado_id" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Seleccione un estado</option>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->id_estado }}"
                            {{ old('estado_id') == $estado->id_estado ? 'selected' : '' }}>
                            {{ $estado->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Ubicación --}}
            <div>
                <label class="block font-medium">Ubicación</label>
                <select name="ubicacion_id" required class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Seleccione una ubicación</option>
                    @foreach ($ubicaciones as $ubicacion)
                        <option value="{{ $ubicacion->id_ubicacion }}"
                            {{ old('ubicacion_id') == $ubicacion->id_ubicacion ? 'selected' : '' }}>
                            {{ $ubicacion->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Empleado asignado --}}
            <div>
                <label class="block font-medium">Empleado asignado</label>
                <select name="empleado_asignado" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">No asignado</option>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id_empleado }}"
                            {{ old('empleado_asignado') == $empleado->id_empleado ? 'selected' : '' }}>
                            {{ $empleado->nombres }} {{ $empleado->apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Fecha adquisición --}}
            <div>
                <label class="block font-medium">Fecha de adquisición (factura /
                    documento)</label>
                <input type="date" name="fecha_adquisicion" value="{{ old('fecha_adquisicion') }}"
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Valor --}}
            <div>
                <label class="block font-medium">Valor del recurso</label>
                <input type="number" step="0.01" name="valor_recurso" value="{{ old('valor_recurso') }}"
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            {{-- Botones --}}
            <div class="pt-6 flex justify-between">
                <a href="{{ route('inventario.index') }}"
                    class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                    ← Volver al listado
                </a>

                <button type="submit" class="bg-ues-primary hover:bg-ues-secondary text-white px-6 py-2 rounded-md">
                    Guardar recurso
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
