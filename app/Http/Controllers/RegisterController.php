<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        //MODIFICAOMOS EL REQUEST (Por que hemos marcado la columna username como unique, si metemos un valor repetido, nos salta un error )
        //De este modo obtenemos el valor del input username y lo modificamos para que se quede como url y se pueda VALIDAR.
        //Importante añadir 'username' en fillable del model User, si no dara error
        $request->request->add(['username' => Str::slug( $request->username ) ]); 
        //Str::slug, este helper no sabe diferenciar valores duplicados, para corregir esto, en la migration add_username..., la marcamos  como ->unique()

        //VALIDACION del formulario
        $this->validate($request, [
            'name'=> 'required|max:25',
            'username' => 'required|unique:users|min:3|max:20',//Con unique, se comprueba en la BD que no exista ese valor especificando la tabla
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|min:2|confirmed',
            'password_confirmation' => 'required'
        ]);

        //INSERTAR DATOS A LA BD
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make( $request->password ), //Con hash protegemos la contraseña
            'username' => $request->username
        ]);

        //ATUTENTICAR
        auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ]);

        //OTRA FORMA DE AUTENTICAR
        //auth()->attempt($request->only('email','password'));

        //REDIRECCIONAR

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
