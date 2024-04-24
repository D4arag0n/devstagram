<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class PerfilController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        //Modifica el valor del request generando el username como una url amigable
        $request->request->add([Str::slug($request->username)]);

        //'unique:users,username,'.auth()->user()->id Con esta linea le decimos que verifique que sea unico, pero que valida
        //si es el mismo usuario 
        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil']
        ]);

        if ($request->imagen) {

            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            /*$imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);*/

            $imagenPath = public_path('perfiles');
            $imagen->move($imagenPath, $nombreImagen);
        }

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';

        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
