@extends('layouts.app')

@section('titulo')
    Inicia sesion para :)
@endsection

@section('contenido')
<div class="md:flex justify-center md:gap-10 md:items-center ">
    <div class="md:w-6/12 p-5">
        <img src="{{ asset('img/login.jpg') }}" alt="">
    </div>
    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
        <form action="{{ route('login.create') }}" method="POST" novalidate>
            @csrf
            @if(session('mensaje')) <!-- Si hay un error de validacion en el RegisterController se muestra este error -->
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ session('mensaje') }}
                    </p>
            @endif
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
                <input type="checkbox" name="remember" >
                <label for="remember" class="text-gray-500 text-sm" >Recordar mi cuenta</label>
            </div>

            <input type="submit" value="Iniciar Sesion" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
    </div>
</div>
    
@endsection