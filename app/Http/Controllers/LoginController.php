<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        //dd('Validando...');
        //dd($request->remember);
        //Validacion 
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Validacion INCORRECTA
        if(!auth()->attempt($request->only('email','password'),$request->remember)){
            return back()->with('mensaje', 'Credenciales incorrectas');
            //Regresate a la pagina anterior con este mensaje
        }

        return redirect()->route('home', auth()->user()->username);

        
    }
}
