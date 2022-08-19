<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //Por convencion si muestra una vista se le llama index
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        //Con Request $request obtenos informacion de lo que se esta enviando

        //dd($request);//Funcion que imprime lo que le pasemos y ya no ejecuta las siguientes lineas de codigo

        //dd($request->get('username'));//Imprime el valor del input username del formulario

        //VALIDACION
        $this->validate($request, [
            'name'=> 'required|max:25',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required'
        ]);

    }
}
