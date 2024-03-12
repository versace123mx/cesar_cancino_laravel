<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BdController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccesoController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\UtilesController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ProtegidaController;
use App\Http\Controllers\FormularioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/',[HomeController::class,'home_inicio'])->name('home_inicio');
Route::get('/hola',[HomeController::class,'hola_inicio'])->name('hola_inicio');
Route::get('/parametros/{id}/{slug}',[HomeController::class,'home_parametros'])->name('home_parametros');
Route::get('/template',[TemplateController::class,'template_inicio'])->name('template_inicio');

Route::get('/formularios',[FormularioController::class,'formularios_inicio'])->name('formularios_inicio');
Route::get('/formularios/simple',[FormularioController::class,'formularios_simple'])->name('formularios_simple');
Route::post('/formularios/simple',[FormularioController::class,'formularios_simple_post'])->name('formularios_simple_post');

Route::get('/formularios/flash',[FormularioController::class,'formularios_flash'])->name('formularios_flash');
Route::get('/formularios/flash2',[FormularioController::class,'formularios_flash2'])->name('formularios_flash2');
Route::get('/formularios/flash3',[FormularioController::class,'formularios_flash3'])->name('formularios_flash3');

Route::get('/formularios/upload',[FormularioController::class,'formularios_upload'])->name('formularios_upload');
Route::post('/formularios/upload',[FormularioController::class,'formularios_upload_post'])->name('formularios_upload_post');
Route::get('/helper',[HelperController::class,'helper_inicio'])->name('helper_inicio');


Route::get('/bd',[BdController::class,'bd_inicio'])->name('bd_inicio');
Route::get('/bd/categorias',[BdController::class,'bd_categorias'])->name('bd_categorias');
Route::get('/bd/categorias/add',[BdController::class,'bd_categorias_add'])->name('bd_categorias_add');
Route::post('/bd/categorias/add',[BdController::class,'bd_categorias_add_post'])->name('bd_categorias_add_post');
Route::get('/bd/categorias/edit/{id}',[BdController::class,'bd_categorias_edit'])->name('bd_categorias_edit');
Route::post('/bd/categorias/edit/{id}',[BdController::class,'bd_categorias_edit_post'])->name('bd_categorias_edit_post');


Route::get('/bd/categorias/delete/{id}',[BdController::class,'bd_categorias_delete'])->name('bd_categorias_delete');


Route::get('/bd/productos',[BdController::class,'bd_productos'])->name('bd_productos');
Route::get('/bd/productos/add',[BdController::class,'bd_productos_add'])->name('bd_productos_add');
Route::post('/bd/productos/add',[BdController::class,'bd_productos_add_post'])->name('bd_productos_add_post');
Route::get('/bd/productos/edit/{id}',[BdController::class,'bd_productos_edit'])->name('bd_productos_edit');
Route::post('/bd/productos/edit/{id}',[BdController::class,'bd_productos_edit_post'])->name('bd_productos_edit_post');

Route::get('/bd/productos/delete/{id}',[BdController::class,'bd_productos_delete'])->name('bd_productos_delete');

Route::get('/bd/productos/categorias/{id}',[BdController::class,'bd_productos_categoria'])->name('bd_productos_categoria');

Route::get('/bd/productos/fotos/{id}',[BdController::class,'bd_productos_fotos'])->name('bd_productos_fotos');
Route::post('/bd/productos/fotos/{id}',[BdController::class,'bd_productos_fotos_post'])->name('bd_productos_fotos_post');

Route::get('/bd/productos/fotos/delete/{producto_id}/{foto_id}',[BdController::class,'bd_productos_fotos_delete'])->name('bd_productos_fotos_delete');

Route::get('/bd/productos/paginacion',[BdController::class,'bd_productos_paginacion'])->name('bd_productos_paginacion');

Route::get('/bd/buscador',[BdController::class,'bd_productos_buscador'])->name('bd_productos_buscador');

Route::get('/utiles',[UtilesController::class,'utiles_inicio'])->name('utiles_inicio');
Route::get('/utiles/pdf',[UtilesController::class,'utiles_pdf'])->name('utiles_pdf');
Route::get('/utiles/excel',[UtilesController::class,'utiles_excel'])->name('utiles_excel');

Route::get('/acceso/login',[AccesoController::class,'acceso_login'])->name('acceso_login');
Route::post('/acceso/login',[AccesoController::class,'acceso_login_post'])->name('acceso_login_post');

Route::get('/acceso/registro',[AccesoController::class,'acceso_registro'])->name('acceso_registro');
Route::post('/acceso/registro',[AccesoController::class,'acceso_registro_post'])->name('acceso_registro_post');
Route::get('/acceso/logout',[AccesoController::class,'acceso_salir'])->name('acceso_salir');

Route::get('/protegida',[ProtegidaController::class,'protegida_inicio'])->name('protegida_inicio');
Route::get('/protegida/otra',[ProtegidaController::class,'protegida_otra'])->name('protegida_otra');
Route::get('/protegida/sin-accesso',[ProtegidaController::class,'protegida_sin_acceso'])->name('protegida_sin_acceso');

