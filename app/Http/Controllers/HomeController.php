<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke() //Accede directamente a este metodo sin necesidad de espeicifcarlo en las rutas
    {

        $ids = auth()->user()->followings->pluck('id')->toArray();//Extraemos el id de los usuarios que seguimos
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        

        return view('home', [ 'posts' => $posts]);
    }
}
