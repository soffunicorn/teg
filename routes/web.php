<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;

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

/*Rutas Pagina de inicio o home*/
Route::get('/', [MainController::class, 'login'])->name('login.index'); //mostrar el login
/* Locales */
Route::resource('/locales', LocalController::class);
/* Empresa */
Route::resource('/company', CompanyController::class);
/*Department*/
Route::resource('/department', DepartmentController::class);









Route::get('/dashboard/incidents', function () {
    return view('panel.incidents.create');
})->name('incidents.create');

Route::get('/dashboard/historial', function () {
    return view('panel.incidents.history');
})->name('incidents.historial');
Route::get('/profile', function () {
    return view('panel.profile.user');
})->name('user.profile');



Route::get('/dashboard/department-register', function () {
    return view('panel.register.DepartmentRegister');
});


/*
Route::get('/test', [MainController::class, 'test'])->name('index.test');

Route::get('test/testing', function () {
    return "Esta es la vista de la ruta";;
})->name('test.testing');
Route::get('test/{testing}', function () {
    return  "Esta es la vista del parametro";
})->name('test.index');
*/



Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
