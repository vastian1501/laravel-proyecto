<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show','index']); //Si no esta autenticado redirecciona a la vista login
    }

    public function index(User $user)
    {
        //dd(auth()->user()); Los datos se miran en attributes

        //Vamos a filtrar para obtener el id del usuario que nos pasamos por la url /ejemplousuario
        //$posts = Post::where('user_id', $user->id)->get(); //Con esto se trae todos los post segun el id de la url y las mandamos a la vista
        $posts = Post::where('user_id', $user->id)->latest()->paginate(4); //Con esto pagina los resultados-> hay que editar el tailwind.config pa que muestre el dieseño
        
        return view('dashboard', ['user' => $user, 'posts'=>$posts ]); //Mandamos la variable $user del modelo al parametro view para poder obtenerlas en la vista
    }

    public function create()
    {
        return view('posts.create');
    }

    //La diferencia entre create y store es que store almacena los datos que se envian en la BD
    //y create es de tipo get y nos muestra el formulario

    public function store(Request $request)
    {
        //Validar formlario
        $this->validate($request, [
            'titulo' => 'required|max:50',
            'descripcion' => 'required|max:255',
            'imagen' => 'required'
        ]);

        //Guardar registro en la BD
        // Post::create([
        //     'titulo'=>$request->titulo,
        //     'descripcion'=>$request->descripcion,
        //     'imagen'=>$request->imagen,
        //     'user_id'=>auth()->user()->id,
        // ]);

        //Otra forma de guardar registros en la BD
        // $post = new Post();
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        //Almacenando con una relacion
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user,Post $post){
        return view('posts.show', [
            'post'=>$post,
            'user'=>$user
        ]);
    }

    public function destroy(Post $post){
        //dd("Eliminando", $post->id);
        $this->authorize('delete',$post);//Aqui hemos creado un policy llamado PostPolicy.php
        $post->delete();

        //Eliminar imagen del server
        $imagen_path = public_path('uploads/'.$post->imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
