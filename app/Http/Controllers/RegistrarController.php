<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrarController extends Controller
{
    //

    //este metodo manda a la vista del formulario
    public function index()
    {
        return view('auth.register');
    }

    //Guarda los datos que 
    public function store(Request $request)
    {
        //Modifica el valor del request generando el username como una url amigable
        $request->request->add([Str::slug($request->username)]);
        //dd($request);
        //dd($request->name);
        //Validaciones 
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:6'
        ]);

        //Guarda los datos
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //De esta forma se puede hacer el inicio de sesion 
        /*auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);*/

        //Otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));



        return redirect()->route('posts.index');
    }
}
