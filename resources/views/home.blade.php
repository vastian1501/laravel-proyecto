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
                    <div class="w-full flex bg-white px-2 py-3">
                        <div class="w-4/6  ">
                            <a href="{{ route('posts.index', $post->user->username) }}"
                                class="font-bold">&commat;{{ $post->user->username }} - <span class="font-normal">{{ $post->titulo }}</span> </a>
                            <p class="mt-2">
                                {{ $post->descripcion }}
                            </p>
                            <p class="text-sm text-gray-500 my-2">
                                {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="w-2/6 py-4 flex items-center gap-4 justify-end">
                            @auth
                            
                            @if ( $post->checkLike( auth()->user() ) )
                            <form method="POST" action="{{ route('posts.likes.destroy', $post) }}">
                                @method('DELETE')
                                @csrf
                                <div class="my-4">
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                          </svg>                                  
                                    </button>
                                </div>
                            </form>
                            @else
                            <form method="POST" action="{{ route('posts.likes.store', $post) }}">
                                @csrf
                                <div class="my-4">
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                          </svg>                                  
                                    </button>
                                </div>
                            </form>
                            @endif
                            
                            @endauth
        
                            <p class="font-bold">{{ $post->likes()->count() }} <span class="font-normal">likes</span></p> 
                        </div>
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
                            <p class="py-2 font-medium my-2 text-gray-600">&commat;{{ $comentario->user->username }} <span class="font-normal"> {{ $comentario->comentario }} </span> <span class="text-gray-400 font-normal text-sm">{{ $comentario->created_at->diffForHumans() }}</span></p>    
                        @endforeach
                    </div>
                
                @endif
            @endforeach
        </div>
    </div>
    @else
        <p class="text-center text-sm text-gray-500 pb-10 ">Todavia no hay nada publicado por aquí...</p>
    @endif
@endsection
