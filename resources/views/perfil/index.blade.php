@extends('layouts.headprofile')

@section('titulo')
{{ auth()->user()->name }} (&commat;{{auth()->user()->username}}) | Editar perfil
@endsection

@section('cabecera')
{{ auth()->user()->name }} <span>(@</span>{{auth()->user()->username}}<span>)</span>
@endsection

@section('contenido')
<div class="md:flex md:justify-center">
    <div class="md:w-1/2 bg-white shadow px-6 py-12">
        <form method="POST" action="{{ route("perfil.store") }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
            @csrf
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                    Nombre de Usuario
                </label>
                <input
                    id="username"
                    name="username" 
                    type="text"
                    placeholder="Tu Nombre de Usuario"
                    class="border p-3 w-full rounded-lg @error('username')
                        border-red-500
                    @enderror"
                    value="{{ auth()->user()->username }}"
                /><!-- con "old 'name' " obtenemos el valor del input name-->

                @error('username') <!-- Si hay un error de validacion en el RegisterController se muestra este error -->
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                    Imagen de Usuario
                </label>
                <input
                    id="imagen"
                    name="imagen" 
                    type="file"
                    class="border p-3 w-full rounded-lg "
                    value=""
                    accept=".jpg, .png, .jpeg"
                />
            </div>

            <input type="submit" value="Guardar Cambios" class="bg-lime-600 hover:bg-lime-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

        </form>

    </div>

</div>
@endsection