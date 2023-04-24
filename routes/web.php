<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RegisterController;
use Faker\Guesser\Name;
use Illuminate\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->middleware('auth')->name('home');

Route::get('/register', [RegisterController::class, 'index'])->name('register'); //Usamos el helper {{ route('register') }} y podemos dar el nombre que queramos "/nombre-ruta"
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/auth/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.create');
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.delete');

Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::delete('/posts/destroy/{comentario}', [ComentarioController::class, 'destroy'])->name('comentarios.delete');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
//Esta ruta definida por una solicitud GET, para una URL que tiene un PARAMETRO de ruta dinámico {user:username}.
//El parámetro de ruta dinámico especifica que se espera un valor para este parámetro en la URL
// y que el valor debe coincidir con el campo username de la tabla de usuarios en la base de datos.

//Siguiendo usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::post('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');