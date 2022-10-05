<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post){
        //dd(auth()->user()->id);
        //dd('Publicando comentario..');
        //Validar 
        $this->validate($request, [
            'comentario' => 'required|max:255|min:2',
        ]);

        //Almacenar 
        Comentario::create([
            'user_id'=>auth()->user()->id,
            'post_id'=>$post->id,
            'comentario'=>$request->comentario
            ]);

        //Imprimir un mensaje
        return back()->with('mensaje', 'Comentario agregado con exito');
    }
}
