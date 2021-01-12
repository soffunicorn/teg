<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
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

/*Rutas para el controlador Usuario*/
Route::get('/', [MainController::class, 'login'])->name('login.index'); //mostrar el login


Route::post('/login', [UserController::class, 'login'])->name('login'); //procesar el login form

Route::get('/login', function () {
    return view('app');
});

Route::get('/dashboard', function () {
    return view('app');
});



Route::get('/dashboard/incidents', function () {
    return view('panel.incidents.create');
});

Route::get('/dashboard/local-register', function () {
    return view('panel.register.localRegister');
});
Route::get('/dashboard/department-register', function () {
    return view('panel.register.DepartmentRegister');
});


Route::get('/test', [MainController::class, 'test'])->name('index.test');

Route::get('test/testing', function () {
    return "Esta es la vista de la ruta";;
})->name('test.testing');
Route::get('test/{testing}', function () {
    return  "Esta es la vista del parametro";
})->name('test.index');


