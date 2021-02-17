<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\IncidentController;
use \App\Http\Controllers\HomeController;

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
Route::resource('/locales', LocalController::class)->middleware('auth')->middleware('auth');
/* Empresa */
Route::resource('/company', CompanyController::class)->middleware('auth');
Route::get('/companyEdit/{slug}', [CompanyController::class, 'companyEdit'])->middleware('auth');
Route::get('/getCompany/{slug}', [CompanyController::class, 'get_company'])->middleware('auth');

/*Department*/
Route::resource('/department', DepartmentController::class)->middleware('auth');
Route::get('/getdepartment/{id}', [DepartmentController::class, 'getDepartment'])->middleware('auth');
Route::get('/midepa', [DepartmentController::class, 'midepa'])->middleware('auth');

/*User*/
Route::resource('/user', UserController::class)->middleware('auth');


Route::put('/password-edit/{slug}', [UserController::class, 'password_edit'])->middleware('auth'); //reset password
Route::POST('/changeImage/{id}', [UserController::class, 'change_image'])->middleware('auth'); //change Image

Route::get('/password-reset/', function (){
    return view('login.reset-password');
})->name('passwordReset'); //reset password



Route::get('/worker', [UserController::class, 'indexWorkers']);
Route::get('/worker/create', [UserController::class, 'createWorkers']);

Route::get('/worker/create/current-department/{id}', [UserController::class, 'createWorkerCurrentDepartment']);
Route::post('/workers/store/CurrentD', [UserController::class, 'storeWorkersCurrentD']);
Route::post('/workers', [UserController::class, 'storeWorkers']);


// ********************************* Al iniciar sesión

Route::get('/setDepartment/{id}', [App\Http\Controllers\HomeController::class, 'setDepartment'])->middleware('auth');
Route::get('/setCompany/{id}', [App\Http\Controllers\HomeController::class, 'setCompany'])->middleware('auth');



// ********************************INCICENCIAS



Route::resource('/incidents', IncidentController::class)->middleware('auth');;
Route::post('/comentar', [IncidentController::class,'comentario'])->middleware('auth');
Route::post('/elegir', [IncidentController::class,'elegir'])->middleware('auth');
Route::post('/estados', [IncidentController::class,'estados'])->middleware('auth');
Route::get('/reportedeincidencia/{id}', [IncidentController::class,'reportedeincidencia']);


// ***************************++Comentarios
Route::post('/deleteComment/{id}', [IncidentController::class,'commentDelete'])->middleware('auth');
//Route::resource('/setCompany/{id}', [App\Http\Controllers\HomeController::class, 'setCompany']);


Route::get('/profile', function () {
    return view('panel.profile.user');
})->name('user.profile');



/*
Route::get('/incidents/details', function () {
    return view('panel.incidents.details');
})->name('incidents.details');

Route::get('/detalle', function () {
    return view('panel.incidents.detalle');
});

Route::get('/dashboard/local-register', function () {
    return view('panel.register.localRegister');
});

Route::get('/dashboard/empleado', function () {

});

Route::get('/dashboard/department-register', function () {
    return view('panel.register.department');
});
*/

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
