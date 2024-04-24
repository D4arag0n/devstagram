@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')

<div class="md:flex md:justify-center">
    <div class="md:w-1/2 bg-white shadow p-6">
        <form method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
            @csrf
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">username</label>
                <input type="text" name="username" id="username" class="border p-3 w-full rounded-lg @error('username')
                    border-red-500
                @enderror"
                    value="{{auth()->user()->username}}"
                >
                @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="border p-3 w-full rounded-lg"
                    accept=".jpg, .png, .jpeg"
                >
            </div>
            <input type="submit" value="Crear cuenta" class="p-3 bg-blue-600 w-full rounded-md text-white font-bold uppercase cursor-pointer hover:bg-blue-500">
        </form>
    </div>
</div>

@endsection