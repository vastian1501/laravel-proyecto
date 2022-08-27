<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request){
        // $imagen=$request->all();
        // return response()->json($imagen);
        //Obtenemos la informacion de la imagen del formulario y guardamos en variable
        $imagen=$request->file('file');

        //Creamos una variable para darle nombre y extension 
        $nombreImagen = Str::uuid().".".$imagen->extension();//Str::uuid() genera un id unico

        //Procesamos la imagen con la libreria "Intervention Image"
        $imagenServidor = Image::make($imagen);//OJO como parametro pasamos la imagen y no la ruta
        //Le aplicamos un recorte
        $imagenServidor->fit(1000,1000,null,'center');
        //Le damos escalas de grises
        $imagenServidor->greyscale();
        
        //Creamos la ruta donde queremos almacenar la imagen OJO solo es la ruta
        $imagenPath = public_path('uploads').'/'.$nombreImagen;
        
        //Y lo guardamos
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen'=>$nombreImagen]);
    }
}
