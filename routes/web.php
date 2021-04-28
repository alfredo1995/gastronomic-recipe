<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//implementando o mapeamento das rotas p/ com o controller
// Metodo Route:resource (passando um grupo de rotas Receitas, relacionar esse grupo de rotas com namespace )  
Route::resource('Receita', 'App\http\Controllers\ReceitaController')->parameters(['Receita' => 'id']); 


