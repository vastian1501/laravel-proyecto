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
            <img src="{{ $user->imagen ? asset('perfiles').'/'.$user->imagen : asset('img/usuario.svg')}}" alt="Imagen usuario" class=" rounded-full shadow-sm">

        </div>
        <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
            <!-- Con el codigo de abajo traemos los datos del usuario desde el modelo User, en el de arriba
                    estamos tranyendo los datos del usuario autenticado -->
            
            <div class="flex items-center gap-2">
                <p class="text-gray-700 text-2xl">{{ $user->username }} </p>
                @auth
                    @if ($user->id === auth()->user()->id)
                        <a class="text-gray-500 hover:text-gray-600 cursor-pointer" href="{{ route('perfil.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                              </svg>                              
                        </a>
                    @endif
                @endauth
            </div>

            <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                {{ $user->followers->count(); }}
                <span class="font-normal"> @choice('Seguidor | Seguidores', $user->followers->count())</span>
            </p>

            <p class="text-gray-800 text-sm mb-3 font-bold">
                {{ $user->followings->count() }}
                <span class="font-normal"> Siguiendo</span>
            </p>

            <p class="text-gray-800 text-sm mb-3 font-bold">
                {{ $user->posts->count() }}
                <span class="font-normal"> Publicaciones</span>
            </p>

            @auth
                @if ($user->id !== auth()->user()->id)
                    @if ( !$user->siguiendo( auth()->user()))
                        <form method="POST" action="{{ route('users.follow', $user) }}">
                            @csrf
                            <input 
                                type="submit" 
                                value="Seguir"
                                class="bg-blue-500 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer hover:bg-blue-400 hover:animate-pulse"
                                >
                            </form>
                        
                    @else
                        <form method="POST" action="{{ route('users.unfollow', $user) }}" >
                            @csrf
                            <input 
                                type="submit" 
                                value="Dejar de seguir"
                                class="bg-red-500 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer hover:red-blue-400 hover:animate-pulse"
                                >
                        </form>
                        
                    @endif
                @endif
            @endauth
                


        </div>

    </div>
</div>

<section class="container mx-auto mt-10 bg-white shadow-md">
    <h2 class="text-4xl text-center font-black py-5 my-10">Publicaciones</h2>
    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mx-5 md:mx-10">
        @foreach ($posts as $post )
        <div>
            <a href="{{ route('posts.show', ['post'=> $post, 'user'=> $user]) }}">
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