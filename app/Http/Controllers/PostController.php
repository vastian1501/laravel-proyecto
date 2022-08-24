<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');//Si no esta autenticado redirecciona a la vista login
    }

    public function index(User $user){
        //dd(auth()->user()); Los datos se miran en attributes
        return view('dashboard', ['user'=>$user]);//Mandamos la variable $user del modelo al parametro view
    }

    
}
