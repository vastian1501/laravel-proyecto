<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
    }
    
    public function index(User $user){
        $this->middleware('auth');//Si no esta autenticado redirecciona a la vista login
        //dd(auth()->user()); Los datos se miran en attributes
        return view('dashboard', ['user'=>$user]);//Mandamos la variable $user del modelo al parametro view
    }

    public function create(){
        return view('posts.create');
    }

    
}
