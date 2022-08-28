<?php

namespace App\Http\Controllers;

use App\Models\Post;
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

    //La diferencia entre create y store es que store almacena los datos que se envian en la BD
    //y create es de tipo get y nos muestra el formulario

    public function store(Request $request){
        //Validar formlario
        $this->validate($request, [
            'titulo'=>'required|max:50',
            'descripcion'=>'required|max:255',
            'imagen'=>'required'
        ]);

        //Guardar registro en la BD
        // Post::create([
        //     'titulo'=>$request->titulo,
        //     'descripcion'=>$request->descripcion,
        //     'imagen'=>$request->imagen,
        //     'user_id'=>auth()->user()->id,
        // ]);
        
        //Otra forma de guardar registros en la BD
        $post = new Post();
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect()->route('posts.index',auth()->user()->username);
    }

    
}
