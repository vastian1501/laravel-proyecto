@extends('layouts.headprofile')

@section('titulo')
    Registro de usuario
@endsection

@section('contenido')
<div class="md:flex justify-center md:gap-10 md:items-center ">
    <div class="md:w-6/12 p-5">
        <img src="{{ asset('img/login.jpg') }}" alt="">
    </div>
    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
        <form action=" {{ route('register') }} " method="POST" novalidate>
            @csrf
            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                    Nombre
                </label>
                <input
                    id="name"
                    name="name" 
                    type="text"
                    placeholder="Tu Nombre"
                    class="border p-3 w-full rounded-lg @error('name')
                        border-red-500
                    @enderror"
                    value="{{ old('name') }}"
                /><!-- con "old 'name' " obtenemos el valor del input name-->

                @error('name') <!-- Si hay un error de validacion en el RegisterController se muestra este error -->
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                    Username
                </label>
                <input
                    id="username"
                    name="username" 
                    type="text"
                    placeholder="Tu Nombre de Usuario"
                    class="border p-3 w-full rounded-lg @error('username')
                        border-red-500
                    @enderror"
                    value="{{ old('username') }}"
                />
                @error('username') <!-- Si hay un error de validacion en el RegisterController se muestra este error -->
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                    Email
                </label>
                <input
                    id="email"
                    name="email" 
                    type="email"
                    placeholder="Tu Email de Registro"
                    class="border p-3 w-full rounded-lg @error('email')
                        border-red-500
                    @enderror"
                    value="{{ old('email') }}"
                />
                @error('email') <!-- Si hay un error de validacion en el RegisterController se muestra este error -->
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                    Contraseña
                </label>
                <input
                    id="password"
                    name="password" 
                    type="password"
                    placeholder="Escribe una contraseña segura"
                    class="border p-3 w-full rounded-lg @error('password')
                        border-red-500
                    @enderror"
                />
                @error('password') <!-- Si hay un error de validacion en el RegisterController se muestra este error -->
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                    Repetir Contraseña
                </label>
                <input
                    id="password_confirmation"
                    name="password_confirmation" 
                    type="password"
                    placeholder="Repite la constraseña"
                    class="border p-3 w-full rounded-lg @error('password_confirmation')
                        border-red-500
                    @enderror"
                />
                @error('password_confirmation') <!-- Si hay un error de validacion en el RegisterController se muestra este error -->
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <input type="submit" value="Crear Cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
    </div>
</div>
    
@endsection