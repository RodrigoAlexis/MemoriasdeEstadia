<?php

use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\HashController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tutores\TutoresController;
use App\Http\Controllers\BibliotecaController;
use App\Http\Controllers\Administrador\RegisterNewController;
use App\Http\Controllers\Administrador\AdministradorController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\Director\DirectorController;


Route::get('/', function (){
        return view('welcome');
});
Route::get('/pp', function () {
        return view('CuPRUEBA');
});

Auth::routes();

Route::group(['middleware' => 'role:Administrador'], function() {
        
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource("/estudiante", EstudianteController::class);


//Route::get('/fileDrBx', [App\Http\Controllers\FileController::class, 'vista']);
Route::post('/fileUpDrBx', [App\Http\Controllers\FileController::class, 'store']);

Route::get('/onePrueba', [App\Http\Controllers\FileOneDrive\OAuthController::class, 'prueba']);
Route::get('/oneResponse', [App\Http\Controllers\FileOneDrive\OAuthController::class, 'response']);
Route::get('/holi', 'App\Http\Controllers\FileOneDrive\OAuthController@holi');
Route::get('/Oauthsignin', 'App\Http\Controllers\FileOneDrive\OAuthController@signin');
Route::get('/Oauthcallback', 'App\Http\Controllers\FileOneDrive\OAuthController@callback');

Route::get('/pp', 'App\Http\Controllers\Permisos\PermissionController@Permission');


Route::resource("/Tutores",TutoresController::class);
//Rutas para revision memoria
Route::get('/revision/{id}',[TutoresController::class,'memoria']);
Route::get('/download/{id}',[TutoresController::class,'download']);
//Rutas  Documentacion del alumno Formatos
Route::get('/docs/{id}',[TutoresController::class,'documentos']);
Route::get('/descargar/{id}',[TutoresController::class,'prueba']);
//Ruta button regresar
Route::post('/regresar/{id}',[TutoresController::class,'regresar']);




Route::resource("biblioteca", BibliotecaController::class);//se crean todas las rutas para el controlador
Route::post("/GetMemorias",[BibliotecaController::class,'GetMemorias']);
Route::post("/GetMemorias",[BibliotecaControllergir::class,'GetMemoria']);

Route::get("/newUser",[RegisterNewController::class,'index']);
Route::post("/newUser",[RegisterNewController::class,'create']);

Route::get("/newGrupo",[AdministradorController::class,'home']);
Route::post("/newGrupo",[AdministradorController::class,'insertGrupo']);
Route::post("/GetProfesores",[AdministradorController::class,'GetProfesores']);
Route::post("/GetAlumnos",[AdministradorController::class,'GetAlumnos']);
Route::post("/GetTutorados",[AdministradorController::class,'GetTutorados']);
Route::post("/GetGrupos",[AdministradorController::class,'GetGrupos']);
Route::post("/GetPerfiles",[AdministradorController::class,'GetPerfiles']);
Route::post("/GetCuatrimestre",[AdministradorController::class,'GetCuatrimestre']);
Route::post("/InsertGrupo",[AdministradorController::class,'InsertGrupo']);
Route::post("/DropGrupo",[AdministradorController::class,'DropGrupo']);
Route::post("/InsertAlumnos",[AdministradorController::class,'InsertAlumnos']);
Route::post("/DeleteAlumnos",[AdministradorController::class,'DeleteAlumnos']);


Route::post("/GetMemorias",[DirectorController::class,'GetMemorias']);
Route::get("/Director",[DirectorController::class,'index']);
Route::post("/GetMemoria",[DirectorController::class,'GetMemoria']);
