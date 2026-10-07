<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#f6f6f6]">

        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-xl border-t-4 border-[#B30000]">

            {{-- Logo UES --}}
            <div class="flex justify-center mb-6">
                <img src="{{ asset('assets/images/logo_ues.png') }}" alt="Logo UES" class="h-20 opacity-90">
            </div>

            {{-- Título --}}
            <h2 class="text-2xl font-bold text-center text-[#B30000] mb-6">
                Sistema SAFI – Inicio de Sesión
            </h2>

            {{-- Mensaje de estado --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- Formulario --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Usuario --}}
                <div>
                    <x-input-label for="username" value="Usuario" class="font-semibold text-gray-700" />
                    <x-text-input id="username"
                        class="block mt-1 w-full border-gray-300 focus:border-[#B30000] focus:ring-[#B30000]"
                        type="text" name="username" :value="old('username')" required autofocus />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                {{-- Contraseña --}}
                <div class="mt-4">
                    <x-input-label for="password" value="Contraseña" class="font-semibold text-gray-700" />
                    <x-text-input id="password"
                        class="block mt-1 w-full border-gray-300 focus:border-[#B30000] focus:ring-[#B30000]"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Botón --}}
                <div class="flex items-center justify-center mt-6">
                    <button type="submit"
                        class="w-full bg-[#B30000] hover:bg-[#8a0000] transition text-white py-2 rounded-lg font-semibold shadow-md">
                        Ingresar
                    </button>
                </div>
            </form>

            {{-- Pie de página --}}
            <p class="text-center text-xs text-gray-500 mt-6">
                © {{ date('Y') }} Universidad de El Salvador — SAFI
            </p>
        </div>
    </div>
</x-app-layout>
