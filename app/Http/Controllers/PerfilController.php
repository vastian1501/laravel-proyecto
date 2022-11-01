<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(User $user)
    {
        return view('perfil.index', ['user' => $user]);
        //php artisan route:list
    }

    public function store(Request $request)
    {
        //dd("guardando perfil");
        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:puta,sexo'] // in:admin. user, 
        ]);

        if ($request->imagen) {
            $imagen = $request->file('imagen');

            //Creamos una variable para darle nombre y extension 
            $nombreImagen = Str::uuid() . "." . $imagen->extension(); //Str::uuid() genera un id unico

            //Procesamos la imagen con la libreria "Intervention Image"
            $imagenServidor = Image::make($imagen); //OJO como parametro pasamos la imagen y no la ruta
            //Le aplicamos un recorte
            $imagenServidor->fit(1000, 1000, null, 'center');
            //Le damos escalas de grises
            //$imagenServidor->greyscale();

            //Creamos la ruta donde queremos almacenar la imagen OJO solo es la ruta
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            //Y lo guardamos
            $imagenServidor->save($imagenPath);
        }

        //Guardamos los cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null ;
        $usuario->save();

        //Redireccionar
        return redirect( route('posts.index', $usuario->username));
    }
}
