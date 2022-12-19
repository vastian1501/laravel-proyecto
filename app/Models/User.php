<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ //Estos datos son los que espera recibir el modelo, aqui añadiremos las columnas que necesitos para el formulario
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class);//Un usuario tiene muchos posts
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    //Almacena los seguidores de un usuario(cuando yo siguo a una persona)
    public function followers(){//Se especifica todo por que nos hemos salido de las convenciones de laravel
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id'); //El metodo de followers en la tabla de followers pertenece a muchos usuarios
    }
    //Comprobar si un usuario ya sigue a otro
    public function siguiendo(User $user){
        return $this->followers->contains($user->id);
    }

    //Almacena los que seguimos
    public function followings(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id'); 
    }

    //Accedemos a tinker -> php artisan tinker
    //$usuario = User::find(7); buscamos el usuario y lo añadimos a una var
    //$usuario->posts Accedemos a los posts de dicho usuario
}
