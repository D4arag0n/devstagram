<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;


class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
        //$input = $request->all();
        //Asi obtenemos los datos de la imagen que viene desde la vista
        $imagen = $request->file('file');

        //Str::uuid() nos sirve para generar un id unico
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //Creamos la instancia de la imagen
        //$imagenServidor = Image::make($imagen);
        //$imagenServidor->fit(1000, 1000);

        //Creamos la ruta ára guardar la imagen
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;

        //Guardamos la imagen
        //$imagenServidor->save($imagenPath);


        return response()->json(['imagen' => $nombreImagen]);
    }
}
