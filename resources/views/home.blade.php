@extends('layouts.app')

@section('titulo')
    Bienvenido {{ $user->name}} (&commat;{{$user->username}})
@endsection

@section('contenido')
    @if ($posts->count())
    <div class="flex flex-row w-full p-8">
        <div class="w-3/4 grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-2 gap-8 mx-5 md:mx-5 ">
            @foreach ($posts as $post)
                <div class="w-4/4 rounded-md shadow-xl">
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="{{ $post->titulo }}" srcset=""
                            class="rounded-t-md">

                    </a>
                    <div class="bg-white px-2 py-3">
                        <a href="{{ route('posts.index', $post->user->username) }}"
                            class="font-bold">&commat;{{ $post->user->username }} - <span class="font-normal">{{ $post->titulo }}</span> </a>
                        <p class="mt-2">
                            {{ $post->descripcion }}
                        </p>
                        <p class="text-sm text-gray-500 my-2">
                            {{ $post->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @endforeach

            <div class="py-10 mx-20">
                {{ $posts->links() }}
            </div>
        </div>
        <div class="w-1/4 bg-lime-200 rounded-md shadow-lg ">
            <h1 class="px-2 py-4 text-center text-xl font-medium uppercase text-lime-800 ">Últimos comentarios</h1>
            @foreach ( $posts as $post)
                @if($post->comentario->count())
                    <div class="m-2 p-2  border-gray-400 shadow-md rounded-md bg-lime-50">
                        <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}" class=" font-medium uppercase text-gray-800 py-2 border-b">{{ $post->titulo }}  <span class="font-normal normal-case">de </span> <span class="normal-case">&commat;{{ $post->user->username }}</span>  <span class="font-normal normal-case text-gray-300 text-right"> {{ $post->created_at->diffForHumans() }}</span></a>
                        @foreach ( $post->comentario as $comentario )
                            <p class="py-2 font-medium my-2 text-gray-600">&commat;{{ $comentario->user->username }} <span class="font-normal"> {{ $comentario->comentario }} </span></p>    
                        @endforeach
                    </div>
                @else
                <div class="m-2 p-2  border-gray-400 shadow-md rounded-md bg-lime-50">
                    <p class="py-2 font-normal my-2 text-gray-600">Todavía nadie ha comentado nada, empieza a comentar...</span></p>    
                    
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @else
        <p class="text-center text-sm text-gray-500 pb-10 ">Todavia no hay nada publicado por aquí...</p>
    @endif
@endsection
