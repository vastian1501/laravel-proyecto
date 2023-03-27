<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <title>RedSocial - @yield('titulo')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-lime-50 min-h-screen">
    <header class="p-3 border-b bg-white shadow-xl">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black text-lime-500">
                <a href="{{ route('home') }}">Red<span class="font-medium">Social</span></a>
            </h1>

            @auth
            <nav class="flex gap-2 items-center">
                <a class="flex items-center gap-2 bg-white border p-2 text-gra-600 rounded text-sm
                        uppercase font-bold cursor-pointer" href="{{ route('posts.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                    </svg>
                    Subir
                </a>

                <a href="{{route('posts.index', auth()->user()->username)}}" class="font-bold text-gray-600 text-sm ml-4">
                    <span class="font-normal text-lg text-cyan-600">&commat;{{ auth()->user()->username}}</span>
                </a>
                <!-- component -->
                <div class="mx-2 relative">
                    <div x-data="{ dropdownOpen: false }" class="relative ">
                        <button @click="dropdownOpen = !dropdownOpen" class="relative z-10 block rounded-md bg-white p-2 focus:outline-none">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-10 w-10 rounded-full border border-lime-500" src="{{ $user->imagen ? asset('perfiles').'/'.$user->imagen : asset('img/usuario.svg')}}" alt="">

                        </button>

                        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                        <div x-show="dropdownOpen" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                            <a href="{{route('posts.index', auth()->user()->username)}}" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                perfil
                            </a>

                            <a href="{{ route('perfil.index') }}" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white">
                                ajustes
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-start px-4 py-2 text-sm capitalize text-red-700 hover:bg-red-500 hover:text-white">
                                    Cerrar Sesion
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- component -->

            </nav>
            @endauth

            @guest
            <nav class="flex gap-4 items-center">
                <a href="{{ route('login') }}" class="font-semibold uppercase text-lime-600 text-sm hover:text-lime-500">Login</a>
                <a href="{{ route('register') }}" class="font-semibold uppercase text-lime-600 text-sm hover:text-lime-500">Crear Cuenta</a>
            </nav>
            @endguest



        </div>
    </header>

    <main class="container mx-auto mt-10">
        {{-- <h2 class="font-semibold text-center text-3xl my-5 text-green-500 uppercase ">
            @yield('titulo')
        </h2> --}}
        @yield('contenido')
    </main>

    <footer class="w-full my-4 text-center p-2 text-gray-500 font-medium uppercase text-base bottom-0 ">
        {{ now()->year }} &copy; RedSocial - Todos los derechos reservados 
    </footer>
</body>

