<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register'); //Usamos el helper {{ route('register') }} y podemos dar el nombre que queramos "/nombre-ruta"
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/contacto', function (){
    return view("contacto");
});

Route::get('users/{id}', function ($id) {
    
});