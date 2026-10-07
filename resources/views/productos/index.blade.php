<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-ues-primary mb-6">Listado de Productos</h2>

        <a href="{{ route('productos.create') }}"
            class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded mb-4 inline-block">
            Nuevo Producto
        </a>
        <x-table>
            <thead class="bg-ues-primary">
                <tr>
                    <x-table-th>Nombre</x-table-th>
                    <x-table-th>Descripción</x-table-th>
                    <x-table-th class="text-center">Acciones</x-table-th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse($productos as $producto)
                    <tr class="hover:bg-gray-50 transition">

                        <x-table-td class="font-semibold text-gray-600">
                            {{ $producto->nombre }}
                        </x-table-td>

                        <x-table-td class="text-gray-500 max-w-md truncate">
                            {{ $producto->descripcion }}
                        </x-table-td>

                        <x-table-td>
                            <div class="flex flex-wrap justify-center gap-1">

                                <a href="{{ route('productos.show', $producto->id_producto) }}" class="btn-primary">
                                    Detalles
                                </a>

                                <a href="{{ route('productos.edit', $producto->id_producto) }}" class="btn-warning">
                                    Editar
                                </a>

                                <form action="{{ route('productos.destroy', $producto->id_producto) }}" method="POST"
                                    onsubmit="return confirm('¿Eliminar producto?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-danger">
                                        Eliminar
                                    </button>
                                </form>

                            </div>
                        </x-table-td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-6 text-center text-gray-500">
                            No hay productos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>
    </div>
</x-app-layout>
