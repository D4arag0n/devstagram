@extends('layouts.app')

@section('titulo')
Inicia sesión en DevStagram
@endsection

@section('contenido')
<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-6/12 p-5">
        <img src="{{asset('img/login.jpg')}}" alt="Imagen login">
    </div>

    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
        <form method="POST" action="{{route('login')}}">
            @csrf <!-- Esta directiva se usa para evitar el bloque de laravel o algo asi..-->
            @if(session('mensaje'))
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{session('mensaje')}}</p>
            @endif
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">email</label>
                <input type="text" name="email" id="email" class="border p-3 w-full rounded-lg @error('email')
                border-red-500
            @enderror"
            >
                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                <input type="password" name="password" id="password" class="border p-3 w-full rounded-lg @error('password')
                border-red-500
            @enderror">
            </div>
            @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
            @enderror

            <div class="mb-5">
                <input type="checkbox" name="remember" id="remember"> <label class="mb-2 text-gray-500 text-sm">Manetener mi sesión abierta</label>
            </div>
            
            <input type="submit" value="Iniciar sesión" class="p-3 bg-blue-600 w-full rounded-md text-white font-bold uppercase cursor-pointer hover:bg-blue-500">
        </form>
    </div>
</div>
@endsection