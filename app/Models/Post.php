<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [ //Estos datos son los que espera recibir el modelo, aqui añadiremos las columnas que necesitos para el formulario
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class)->select(['name','username']);
    }

    public function comentario(){
        return $this->hasMany(Comentario::class);
    }

    //Consulta tinker
    //$post = Post::find(1);
}
