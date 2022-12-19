<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user){
        // dd($user->username);
        //Accdemos al metodo followers del modelo de User
        $user->followers()->attach( auth()->user()->id ); //El usuario que estamos visitando su muro le va a agregar la persona que le esta siguiendo(la persona autenticada)
        return back();
    }

    public function destroy(User $user){
        $user->followers()->detach( auth()->user()->id);

        return back();
    }
}
