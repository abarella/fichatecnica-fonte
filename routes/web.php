<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();
Route::view('/', 'auth.login');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', 'UserController@profile')->name('admin.profile');
Route::get ('/beto', [App\Http\Controllers\BetoController::class, 'index'])->name('beto');
Route::post('/beto', [App\Http\Controllers\BetoController::class, 'func1'])->name('beto');

Route::get ('/catprod', [App\Http\Controllers\CatProdController::class, 'index'])->name('catprod');
Route::post('/catprod', [App\Http\Controllers\CatProdController::class, 'func1'])->name('catprod');

Route::get('/insumos', [App\Http\Controllers\InsumosController::class, 'index'])->name('insumos');

Route::get ('/cadficha', [App\Http\Controllers\CadFichaController::class, 'index'])->name('cadficha');

Route::post ('/cadficha', [App\Http\Controllers\CadFichaController::class, 'update'])->name('cadficha');




Route::get('/api/func5/{id}', [App\Http\Controllers\CatProdController::class, 'func5']);

Route::post('/api/func6', [App\Http\Controllers\CadFichaController::class, 'func6']);



Route::get ('/useradmin', [\App\Http\Controllers\UserController\adminuserController::class, 'index'])->name('useradmin');
