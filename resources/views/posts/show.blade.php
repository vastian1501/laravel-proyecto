@extends('layouts.headprofile')

@section('titulo')
{{ $post->titulo }}
@endsection

@push('styles')

@section('contenido')
<div class="container mx-auto flex">
    <div class="md:w-1/2 p-5">
        <img src="{{ asset('uploads').'/'.$post->imagen }}" alt="" class="w-50">

        <div class="p-3">
            <p>0 likes</p>
        </div>

        <div>
            <p class="font-bold">{{ $post->user->username}}</p>
            <p class="text-sm text-gray-500">
                {{ $post->created_at->diffForHumans() }}
            </p>
            <p class="mt-5">
                {{ $post->descripcion }}
            </p>
        </div>
    </div>
    <div class="md:w-1/2 p-5">
        <div class="shadow bg-white p-5 mb-5">
            @auth
            <p class="text-xl font-bold text-center mb-4">Escribe un comentario en esta imagen</p>
            <form action="">
                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Escribe un comentario
                    </label>
                    <textarea id="comentario" name="comentario" type="text" placeholder="Escribe tu comentario" class="border p-3 w-full rounded-lg @error('descripcion')
                        border-red-500
                    @enderror" /></textarea><!-- con "old 'name' " obtenemos el valor del input name-->

                    @error('descripcion')
                    <!-- Si hay un error de validacion en el RegisterController se muestra este error -->
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

            </form>
            @endauth
            @guest
            <p class="text-xl font-bold text-center mb-4 ">Aun no has iniciado sesion...</p>
            
            <p class="text-md font-normal text-center mb-4 text-gray-500"><a class="font-bold underline" href="{{ route('login')}}">Inicia sesión</a> o <a class="font-bold underline" href="{{ route('register') }}">regístrate</a> para poder escribir comentarios</p>

            @endguest

        </div>
    </div>
</div>
@endsection