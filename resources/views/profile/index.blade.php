<x-app-layout>
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow mt-6">

        <h2 class="text-2xl font-bold text-ues-primary mb-6">Mi Perfil</h2>

        {{-- Mensaje éxito --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Errores --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                {{ implode(', ', $errors->all()) }}
            </div>
        @endif

        {{-- Datos del usuario --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

            <div>
                <h3 class="font-semibold text-gray-700">Empleado</h3>
                <p>{{ $user->empleado->nombres }} {{ $user->empleado->apellidos }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-700">Cargo</h3>
                <p>{{ $user->cargo->nombre }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-700">Rol del Sistema</h3>
                <p>{{ $user->rol->nombre }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-700">Usuario</h3>
                <p>{{ $user->username }}</p>
            </div>

        </div>

        <hr class="my-6">

        {{-- FORM PARA CAMBIAR USERNAME --}}
        <h3 class="text-lg font-semibold mb-3">Actualizar nombre de usuario</h3>

        <form method="POST" action="{{ route('profile.username') }}" class="mb-8">
            @csrf

            <label class="block text-sm font-medium">Usuario</label>
            <input type="text" name="username" value="{{ $user->username }}" class="border rounded px-3 py-2 w-full">

            <button type="submit" class="mt-3 bg-ues-primary text-white px-4 py-2 rounded hover:bg-ues-secondary">
                Guardar
            </button>
        </form>

        <hr class="my-6">

        {{-- FORM PARA CAMBIAR CONTRASEÑA --}}
        <h3 class="text-lg font-semibold mb-3">Actualizar contraseña</h3>

        <form method="POST" action="{{ route('profile.password') }}">
            @csrf

            <label class="block text-sm font-medium">Contraseña actual</label>
            <input type="password" name="current_password" class="border rounded px-3 py-2 w-full mb-3">

            <label class="block text-sm font-medium">Nueva contraseña</label>
            <input type="password" name="password" class="border rounded px-3 py-2 w-full mb-3">

            <label class="block text-sm font-medium">Confirmar nueva contraseña</label>
            <input type="password" name="password_confirmation" class="border rounded px-3 py-2 w-full mb-6">

            <button type="submit" class="bg-ues-primary text-white px-4 py-2 rounded hover:bg-ues-secondary">
                Actualizar Contraseña
            </button>
        </form>

    </div>
</x-app-layout>
