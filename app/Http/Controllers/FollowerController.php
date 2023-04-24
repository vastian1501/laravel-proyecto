<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user){
        $user->followers()->attach( auth()->user()->id ); 
        //Añade al usuario autenticado actual 
        //(es decir, el usuario que ha iniciado sesión en la aplicación)
        // a la lista de seguidores del usuario representado por la variable $user.
        return back();
    }

    public function destroy(User $user){
        $user->followers()->detach( auth()->user()->id);
        //Elimina la relación de seguimiento entre el usuario autenticado actual 
        //(es decir, el usuario que ha iniciado sesión en la aplicación) y el usuario representado por la variable $user.

        return back();
    }
}
