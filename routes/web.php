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
Route::get('/tipoematerial/crear', [App\Http\Controllers\TipoMaterialController::class, 'create'])->name('TipoMaterial.create'); 
Route::get('/tipoematerial/{id}/editar', [App\Http\Controllers\TipoMaterialController::class, 'edit'])->name('TipoMaterial.edit');
Route::patch('/tipoematerial/{id}', [App\Http\Controllers\TipoMaterialController::class, 'update'])->name('TipoMaterial.update');
Route::delete('/tipoematerial/{id}', [App\Http\Controllers\TipoMaterialController::class, 'destroy'])->name('TipoMaterial.delete');   
Route::post('/tipoematerial', [App\Http\Controllers\TipoMaterialController::class, 'store'])->name('TipoMaterial.store'); 

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
Route::get('/material/{id}/editar', [App\Http\Controllers\MaterialController::class, 'edit'])->name('Material.edit');
Route::patch('/material/{id}', [App\Http\Controllers\MaterialController::class, 'update'])->name('Material.update');
Route::delete('/material/{id}', [App\Http\Controllers\MaterialController::class, 'destroy'])->name('Material.delete');  
/*
|--------------------------------------------------------------------------
| Web Routes Rollo
|--------------------------------------------------------------------------  
*/   
Route::get('/rollo/crear/{material}', [App\Http\Controllers\RolloController::class, 'create'])->name('Rollo.create'); 
Route::post('/rollo/{codmaterial}', [App\Http\Controllers\RolloController::class, 'store'])->name('Rollo.store'); 
Route::get('/rollo/{cod}', [App\Http\Controllers\RolloController::class, 'show'])->name('Rollo.show');
Route::get('/rollo/{cod}/crearmaterial', [App\Http\Controllers\RolloController::class, 'create'])->name('Rollo.create');
Route::get('/rollosigx', [App\Http\Controllers\RolloController::class, 'Igxs'])->name('Rollo.igxs'); 
Route::post('/rollocbx', [App\Http\Controllers\RolloController::class, 'cbx'])->name('Rollo.cbx');
Route::delete('/rollo/{id}', [App\Http\Controllers\RolloController::class, 'destroy'])->name('Rollo.delete');  
/*
|--------------------------------------------------------------------------
| Web Routes Cliente
|--------------------------------------------------------------------------  
*/   
Route::post('/datacliente', [App\Http\Controllers\clienteController::class, 'data'])->name('Cliente.data'); 
Route::get('/clientesdata', [App\Http\Controllers\clienteController::class, 'datas'])->name('Cliente.datas');
Route::get('/cliente/crear', [App\Http\Controllers\clienteController::class, 'create'])->name('Cliente.create'); 
// Route::post('/cliente', [App\Http\Controllers\clienteController::class, 'store'])->name('Cliente.store');
Route::get('/clientes', [App\Http\Controllers\clienteController::class, 'index'])->name('Cliente.index'); 
Route::get('/clientes/{cod}', [App\Http\Controllers\clienteController::class, 'show'])->name('Cliente.show');
Route::get('/cliente/{id}/editar', [App\Http\Controllers\clienteController::class, 'edit'])->name('Cliente.edit');
Route::patch('/cliente/{id}', [App\Http\Controllers\clienteController::class, 'update'])->name('Cliente.update');
Route::delete('/cliente/{id}', [App\Http\Controllers\clienteController::class, 'destroy'])->name('Cliente.delete');  
Route::get('/clientesigx', [App\Http\Controllers\clienteController::class, 'Igxs'])->name('Cliente.igxs');  

Route::post('/datadeuda', [App\Http\Controllers\DeudasController::class, 'data'])->name('Deudas.data'); 
Route::get('/deudasdata', [App\Http\Controllers\DeudasController::class, 'datas'])->name('Deudas.datas');
Route::post('/deuda/{id}/pagar', [App\Http\Controllers\DeudasController::class, 'pay'])->name('Deudas.pay'); 
// Route::post('/deuda', [App\Http\Controllers\DeudasController::class, 'store'])->name('Deudas.store');
Route::get('/deudas', [App\Http\Controllers\DeudasController::class, 'index'])->name('Deudas.index'); 
Route::get('/deudas/{cod}', [App\Http\Controllers\DeudasController::class, 'show'])->name('Deudas.show');
Route::get('/deuda/{id}/editar', [App\Http\Controllers\DeudasController::class, 'edit'])->name('Deudas.edit');
Route::patch('/deuda/{id}', [App\Http\Controllers\DeudasController::class, 'update'])->name('Deudas.update');
Route::delete('/deuda/{id}', [App\Http\Controllers\DeudasController::class, 'destroy'])->name('Deudas.delete');  
 

/*
|--------------------------------------------------------------------------
| Web Routes ingresos
|--------------------------------------------------------------------------  
*/   
Route::get('/ingresos/crear', [App\Http\Controllers\ingresosController::class, 'create'])->name('Ingresos.create'); 
Route::post('/ingresos', [App\Http\Controllers\ingresosController::class, 'store'])->name('Ingresos.store'); 
Route::get('/ingresos/{id}/editar', [App\Http\Controllers\ingresosController::class, 'edit'])->name('Ingresos.edit');
Route::patch('/ingresos/{id}', [App\Http\Controllers\ingresosController::class, 'update'])->name('Ingresos.update');
Route::delete('/ingresos/{id}', [App\Http\Controllers\ingresosController::class, 'destroy'])->name('Ingresos.delete');    
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
Route::get('/egresos/{id}/editar', [App\Http\Controllers\egresosController::class, 'edit'])->name('Egresos.edit');
Route::patch('/egresos/{id}', [App\Http\Controllers\egresosController::class, 'update'])->name('Egresos.update');
Route::delete('/egresos/{id}', [App\Http\Controllers\egresosController::class, 'destroy'])->name('Egresos.delete');  
 
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
| Web Routes tipo Egresos
|--------------------------------------------------------------------------  
*/   
Route::get('/metodopago', [App\Http\Controllers\MetodoPagoController::class, 'index'])->name('MetodoPago.index'); 
Route::get('/metodopagodata', [App\Http\Controllers\MetodoPagoController::class, 'data'])->name('MetodoPago.data'); 
Route::get('/metodopago/crear', [App\Http\Controllers\MetodoPagoController::class, 'create'])->name('MetodoPago.create'); 
Route::get('/metodopago/{id}/editar', [App\Http\Controllers\MetodoPagoController::class, 'edit'])->name('MetodoPago.edit');
Route::patch('/metodopago/{id}', [App\Http\Controllers\MetodoPagoController::class, 'update'])->name('MetodoPago.update');
Route::delete('/metodopago/{id}', [App\Http\Controllers\MetodoPagoController::class, 'destroy'])->name('MetodoPago.delete');   
Route::post('/metodopago', [App\Http\Controllers\MetodoPagoController::class, 'store'])->name('MetodoPago.store'); 
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
| Web Routes reportes
|--------------------------------------------------------------------------  
*/  

Route::get('/between', [App\Http\Controllers\ReportesController::class, 'betweenDate'])->name('Reporte.between');
Route::post('/betweenSearch', [App\Http\Controllers\ReportesController::class, 'betweenDateSearch'])->name('Reporte.betweenSearch');
Route::get('/ShowFecha/{fecha}', [App\Http\Controllers\ReportesController::class, 'ShowFecha'])->name('Reporte.ShowFecha');
Route::get('/ingresosfecha', [App\Http\Controllers\ReportesController::class, 'ingresos'])->name('Reportes.ingresos');
Route::get('/egresosfecha', [App\Http\Controllers\ReportesController::class, 'egresos'])->name('Reportes.egresos');

/*
|--------------------------------------------------------------------------
| Web Routes Home
|--------------------------------------------------------------------------  
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();