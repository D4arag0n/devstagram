@extends('layouts.app')

@section('titulo')
Crea una nueva publicación
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
<div class="md:flex md:items-center">
    <div class="md:w-6/12 px-10">
        <form action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data" 
        id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded 
        flex flex-col justify-center items-center">
@csrf
        </form>
    </div>
    <div class="md:w-6/12 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
        <form action="{{route('posts.store')}}" method="POST">
            @csrf <!-- Esta directiva se usa para evitar el bloque de laravel o algo asi..-->
            <div class="mb-5">
                <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Titulo</label>
                <input type="text" name="titulo" id="titulo" class="border p-3 w-full rounded-lg @error('titulo')
                    border-red-500
                @enderror"
                    value="{{old('titulo')}}"
                >
                @error('titulo')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="border p-3 w-full rounded-lg @error('descripcion')
                    border-red-500
                @enderror"
                >{{old('descripcion')}}</textarea>
                @error('descripcion')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <input type="hidden" name="imagen" value="{{old('imagen')}}">
                @error('imagen')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>
            <input type="submit" value="Crear publicación" class="p-3 bg-blue-600 w-full rounded-md text-white font-bold uppercase cursor-pointer hover:bg-blue-500">
        </form>
    </div>
    
</div>
@endsection