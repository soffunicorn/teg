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

Route::get('/dashboard', function () {
    return view('app');
});

Route::get('/dashboard/local-register', function () {
    return view('panel.register.localRegister');
});
Route::get('/dashboard/department-register', function () {
    return view('panel.register.DepartmentRegister');
});


Route::get('/test', [MainController::class, 'test'])->name('index.test');
Route::get('/', [MainController::class, 'login'])->name('login.index');
Route::get('test/testing', function () {
    return "Esta es la vista de la ruta";;
})->name('test.testing');
Route::get('test/{testing}', function () {
    return  "Esta es la vista del parametro";
})->name('test.index');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
