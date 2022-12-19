@extends('layouts.app')

@section('titulo')
    Ultimas publicaciones
@endsection

@section('contenido')
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-2 gap-4 mx-5 md:mx-5">
            @foreach ($posts as $post)
                <div class=" w-3/4">
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}" >
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="{{ $post->titulo }}" srcset="" class="">
                        
                    </a>
                    <div class="bg-white px-2 py-3">
                        <a href="{{ route('posts.index', $post->user->username) }}"
                            class="font-bold">&commat;{{ $post->user->username }}</a>
                        <p class="text-sm text-gray-500">
                            {{ $post->created_at->diffForHumans() }}
                        </p>
                        <p class="mt-5">
                            {{ $post->descripcion }}
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="py-10 mx-20">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-center text-sm text-gray-500 pb-10 ">Todavia no hay nada publicado por aquí...</p>
    @endif
@endsection
