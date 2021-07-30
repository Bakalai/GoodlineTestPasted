<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class,'home'] );

Route::get('/about', [MainController::class,'about'] );

Route::get('/publicat', [MainController::class,'publicat'] );
Route::get('/lk', [MainController::class,'lk'] );
$publicates = DB::select("select hash from pasteds");
foreach ($publicates as $onepasta)
{
    Route::get($onepasta->hash, [MainController::class, 'onepasta'] );      // Заполнение routes значениями ссылок на "пасты" из базы
}

Route::post('/publicat/check', [MainController::class,'publicat_check'] );
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
