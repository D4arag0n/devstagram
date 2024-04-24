<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Cuando tenemos un metodo __invoke en el controller, no es necesario añadir el controller en un arrelo como en las otra rutas
Route::get('/', HomeController::class)->name('home');

Route::get('/crear-cuenta', [RegistrarController::class, 'index'])->name('register');
Route::post('/crear-cuenta', [RegistrarController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//Rutas para el perfil
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');


Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
//Ruta para mostrar una publicacion
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
//Ruta para guardar los comentarios
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
//Metodo para guardar el Like al post
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
//Metodo para eliminar un like
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');
//Metodo para eliminar una publicacion
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');

//Metodo para seguir a un usuario
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow.store');
Route::post('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');
