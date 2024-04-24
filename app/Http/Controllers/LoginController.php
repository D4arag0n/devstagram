<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        //Verificar si los datos son correctos e inicia sesion
        //$request->remember esta variable la usamos por si requiere mantener su sesion iniciada, se usa como parametro dentro del attempt
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Usuario o Contraseña Incorrectos');
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
