@extends('layouts.headprofile')

@section('titulo')
{{ $user->name}} (&commat;{{$user->username}})
@endsection

@section('cabecera')
{{ $user->name}} <span>(@</span>{{$user->username}}<span>)</span>
@endsection

@section('contenido')
<div class="flex justify-center">
    <div class="m-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
        <div class="w-8/12 lg:w-6/12 md:px-5">
            <img src="{{ asset('img/usuario.svg')}}" alt="Imagen usuario">

        </div>
        <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
            <!-- <p class="text-gray-700 text-2xl">{{ auth()->user()->username }} </p> -->
            <!-- Con el codigo de abajo traemos los datos del usuario desde el modelo User, en el de arriba
                    estamos tranyendo los datos del usuario autenticado -->
            <p class="text-gray-700 text-2xl">{{ $user->username }} </p>

            <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                0
                <span class="font-normal"> Seguidores</span>
            </p>

            <p class="text-gray-800 text-sm mb-3 font-bold">
                0
                <span class="font-normal"> Siguiendo</span>
            </p>

            <p class="text-gray-800 text-sm mb-3 font-bold">
                0
                <span class="font-normal"> Publicaciones</span>
            </p>

        </div>

    </div>
</div>

<section class="container mx-auto mt-10 bg-white shadow-md">
    <h2 class="text-4xl text-center font-black py-5 my-10">Publicaciones</h2>
    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-5 md:mx-10">
        @foreach ($posts as $post )
        <div>
            <a href="">
                <img src="{{ asset('uploads').'/'.$post->imagen }}" alt="{{ $post->titulo }}" srcset="">

            </a>
        </div>
        @endforeach

    </div>
    <div class="py-10 mx-20">
        {{ $posts->links() }}
    </div>
    @else
    <p class="text-center text-sm text-gray-500 pb-10 ">Todavia no hay nada publicado por aquí...</p>
    @endif
</section>

@endsection