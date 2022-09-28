<?php

use Illuminate\Support\Facades\Auth;
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
 


/*
|--------------------------------------------------------------------------
| Web Routes Tipo Material
|--------------------------------------------------------------------------  
*/
Route::get('/tipomaterial', [App\Http\Controllers\TipoMaterialController::class, 'index'])->name('TipoMaterial.index');
Route::get('/tipomaterialdata', [App\Http\Controllers\TipoMaterialController::class, 'data'])->name('TipoMaterial.data'); 
/*
|--------------------------------------------------------------------------
| Web Routes  Material
|--------------------------------------------------------------------------  
*/ 
Route::get('/material', [App\Http\Controllers\MaterialController::class, 'index'])->name('Material.index');
Route::get('/material/crear', [App\Http\Controllers\MaterialController::class, 'create'])->name('Material.create'); 
Route::post('/material', [App\Http\Controllers\MaterialController::class, 'store'])->name('Material.store');
Route::get('/materialdata', [App\Http\Controllers\MaterialController::class, 'data'])->name('Material.data');
Route::get('/material/{cod}', [App\Http\Controllers\MaterialController::class, 'show'])->name('Material.show');
/*
|--------------------------------------------------------------------------
| Web Routes Rollo
|--------------------------------------------------------------------------  
*/   
Route::get('/rollo/crear/{material}', [App\Http\Controllers\RolloController::class, 'create'])->name('Rollo.create'); 
Route::post('/rollo/{codmaterial}', [App\Http\Controllers\RolloController::class, 'store'])->name('Rollo.store'); 
Route::get('/rollo/{cod}', [App\Http\Controllers\RolloController::class, 'show'])->name('Rollo.show');
Route::get('/rollo/{cod}/crearmaterial', [App\Http\Controllers\RolloController::class, 'create'])->name('Rollo.create');
/*
|--------------------------------------------------------------------------
| Web Routes Cliente
|--------------------------------------------------------------------------  
*/   
Route::post('/datacliente', [App\Http\Controllers\clienteController::class, 'data'])->name('Cliente.data'); 
Route::get('/clientesdata', [App\Http\Controllers\clienteController::class, 'datas'])->name('Cliente.datas'); 
Route::get('/clientes', [App\Http\Controllers\clienteController::class, 'index'])->name('Cliente.index'); 
Route::get('/clientes/{cod}', [App\Http\Controllers\clienteController::class, 'show'])->name('Cliente.show'); 
/*
|--------------------------------------------------------------------------
| Web Routes Rollo
|--------------------------------------------------------------------------  
*/   
Route::get('/ingresos/crear', [App\Http\Controllers\ingresosController::class, 'create'])->name('Ingresos.create'); 
Route::post('/ingresos', [App\Http\Controllers\ingresosController::class, 'store'])->name('Ingresos.store'); 
// Route::get('/ingresos/{cod}', [App\Http\Controllers\RolloController::class, 'show'])->name('Rollo.show');
// Route::get('/ingresos/{cod}/crearmaterial', [App\Http\Controllers\RolloController::class, 'create'])->name('Rollo.create'); 
/*

/*
|--------------------------------------------------------------------------
| Web Routes Egresos
|--------------------------------------------------------------------------  
*/   
Route::get('/egresosdata', [App\Http\Controllers\egresosController::class, 'data'])->name('Egresos.data'); 
Route::get('/egresos', [App\Http\Controllers\egresosController::class, 'index'])->name('Egresos.index'); 
Route::get('/egresos/crear', [App\Http\Controllers\egresosController::class, 'create'])->name('Egresos.create'); 
Route::post('/egresos', [App\Http\Controllers\egresosController::class, 'store'])->name('Egresos.store'); 
/*

/*
|--------------------------------------------------------------------------
| Web Routes tipo Egresos
|--------------------------------------------------------------------------  
*/   
Route::get('/tipoegresos', [App\Http\Controllers\tipoEgresosController::class, 'index'])->name('TipoEgresos.index'); 
Route::get('/tipoegresosdata', [App\Http\Controllers\tipoEgresosController::class, 'data'])->name('TipoEgresos.data'); 
Route::get('/tipoegresos/crear', [App\Http\Controllers\tipoEgresosController::class, 'create'])->name('TipoEgresos.create'); 
Route::get('/tipoegresos/{id}/editar', [App\Http\Controllers\tipoEgresosController::class, 'edit'])->name('TipoEgresos.edit');
Route::patch('/tipoegresos/{id}', [App\Http\Controllers\tipoEgresosController::class, 'update'])->name('TipoEgresos.update');
Route::delete('/tipoegresos/{id}', [App\Http\Controllers\tipoEgresosController::class, 'destroy'])->name('TipoEgresos.delete');   
Route::post('/tipoegresos', [App\Http\Controllers\tipoEgresosController::class, 'store'])->name('TipoEgresos.store'); 
/*

/*
|--------------------------------------------------------------------------
| Web Routes pendientes
|--------------------------------------------------------------------------  
*/   
Route::get('/pedientes', [App\Http\Controllers\PendientesController::class, 'index'])->name('Pendientes.index'); 
Route::get('/pedientesdata', [App\Http\Controllers\PendientesController::class, 'data'])->name('Pendientes.data'); 
Route::get('/pedientes/crear', [App\Http\Controllers\PendientesController::class, 'create'])->name('Pendientes.create'); 
Route::get('/pedientes/{id}/editar', [App\Http\Controllers\PendientesController::class, 'edit'])->name('Pendientes.edit');
Route::patch('/pedientes/{id}', [App\Http\Controllers\PendientesController::class, 'update'])->name('Pendientes.update');
Route::delete('/pedientes/{id}', [App\Http\Controllers\PendientesController::class, 'destroy'])->name('Pendientes.delete');   
Route::post('/pedientes', [App\Http\Controllers\PendientesController::class, 'store'])->name('Pendientes.store'); 
/*
|--------------------------------------------------------------------------
| Web Routes Home
|--------------------------------------------------------------------------  
*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();