@extends('layouts.headprofile')

@section('titulo')
Crear Publicación
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
<div class="md:flex md:items-center flex-col justify-between ">
    <div class="md:w-1/2 px-0 ">
        <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-lime-400 text-lime-600 border-1 w-full h-56 rounded flex 
        flex-col justify-center items-center @error('imagen')border-red-400 text-red-400 @enderror">
        @csrf
        </form>
    </div>

    <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-10">
        <form action=" {{ route('posts.store') }} " method="POST" novalidate>
            @csrf
            <div class="mb-5">
                <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                    Titulo
                </label>
                <input id="titulo" name="titulo" type="text" placeholder="Titulo de la publicación" class="border p-3 w-full rounded-lg @error('titulo')
                        border-red-500
                    @enderror" value="{{ old('titulo') }}" /><!-- con "old 'name' " obtenemos el valor del input name-->

                @error('titulo')
                <!-- Si hay un error de validacion en el RegisterController se muestra este error -->
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                    Descripción
                </label>
                <textarea id="descripcion" name="descripcion" type="text" placeholder="Escribe algo aquí" class="border p-3 w-full rounded-lg @error('descripcion')
                        border-red-500
                    @enderror" />{{ old('descripcion') }}</textarea><!-- con "old 'name' " obtenemos el valor del input name-->

                @error('descripcion')
                <!-- Si hay un error de validacion en el RegisterController se muestra este error -->
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="mb-5">
                <input type="hidden" name="imagen" value="{{ old('imagen') }}" >
                @error('imagen')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <input type="submit" value="Publicar" class="bg-lime-600 hover:bg-lime-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
    </div>

</div>
@endsection