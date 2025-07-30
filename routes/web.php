<?php

use App\Http\Controllers\Backend\CategoriaController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\MenuRolController;
use App\Http\Controllers\Backend\PermisoController;
use App\Http\Controllers\Backend\PermisoRolController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\RolController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\MiCuentaController;

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

Route::get('/', function () {
    return view('theme.front.index');
})->name('inicio');

Route::get('mi-cuenta', [MiCuentaController::class, 'index'])->middleware('auth')->name('mi-cuenta');

Route::group(['prefix' => 'admin-backend', 'middleware' => ['auth', 'superadministrador']], function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');
    /* RUTAS DEL MENU */
    Route::get('menu', [MenuController::class, 'index'])->name('menu');
    Route::get('menu/crear', [MenuController::class, 'crear'])->name('menu.crear');
    Route::get('menu/{id}/editar', [MenuController::class, 'editar'])->name('menu.editar');
    Route::post('menu', [MenuController::class, 'guardar'])->name('menu.guardar');
    Route::post('menu/guardar-orden', [MenuController::class, 'guardarOrden'])->name('menu.orden');
    Route::put('menu/{id}', [MenuController::class, 'actualizar'])->name('menu.actualizar');
    Route::delete('menu/{id}/eliminar', [MenuController::class, 'eliminar'])->name('menu.eliminar');
    /* RUTAS DEL MENU ROL */
    Route::get('menu-rol', [MenuRolController::class, 'index'])->name('menu-rol');
    Route::post('menu-rol', [MenuRolController::class, 'guardar'])->name('menu-rol.guardar');

    /* Rutas de Roles */
    Route::get('rol', [RolController::class, 'index'])->name('rol');
    Route::get('rol/crear', [RolController::class, 'crear'])->name('rol.crear');
    Route::get('rol/{rol}/editar', [RolController::class, 'editar'])->name('rol.editar');
    Route::post('rol', [RolController::class, 'guardar'])->name('rol.guardar');
    Route::put('rol/{rol}', [RolController::class, 'actualizar'])->name('rol.actualizar');
    Route::delete('rol/{rol}/eliminar', [RolController::class, 'eliminar'])->name('rol.eliminar');

    /* RUTAS DE PERMISO */
    Route::get('permiso', [PermisoController::class, 'index'])->name('permiso');
    Route::get('permiso/crear', [PermisoController::class, 'crear'])->name('permiso.crear');
    Route::get('permiso/{id}/editar', [PermisoController::class, 'editar'])->name('permiso.editar');
    Route::post('permiso', [PermisoController::class, 'guardar'])->name('permiso.guardar');
    Route::put('permiso/{id}', [PermisoController::class, 'actualizar'])->name('permiso.actualizar');
    Route::delete('permiso/{id}', [PermisoController::class, 'eliminar'])->name('permiso.eliminar');
    /* RUTAS DEL PERMISO ROL */
    Route::get('permiso-rol', [PermisoRolController::class, 'index'])->name('permiso-rol');
    Route::post('permiso-rol', [PermisoRolController::class, 'guardar'])->name('permiso-rol.guardar');

    /* Rutas Categoria */
    Route::get('categoria', [CategoriaController::class, 'index'])->name('categoria');
    Route::post('categoria/crear', [CategoriaController::class, 'crear'])->name('categoria.crear');
    Route::put('categoria/{id}/editar', [CategoriaController::class, 'editar'])->name('categoria.editar');
    Route::post('categoria', [CategoriaController::class, 'guardar'])->name('categoria.guardar');
    Route::put('categoria/{id}', [CategoriaController::class, 'actualizar'])->name('categoria.actualizar');
    Route::delete('categoria/{id}', [CategoriaController::class, 'eliminar'])->name('categoria.eliminar');

    /* Rutas Post */
    Route::get('post', [PostController::class, 'index'])->name('post');
    Route::get('post/crear', [PostController::class, 'crear'])->name('post.crear');
    Route::post('post/{post}/mostrar', [PostController::class, 'mostrar'])->name('post.mostrar');
    Route::get('post/{post}/editar', [PostController::class, 'editar'])->name('post.editar');
    Route::post('post', [PostController::class, 'guardar'])->name('post.guardar');
    Route::put('post/{post}', [PostController::class, 'actualizar'])->name('post.actualizar');
    Route::delete('post/{post}', [PostController::class, 'eliminar'])->name('post.eliminar');

    /* Rutas Tag */
    Route::get('tag', [TagController::class, 'index'])->name('tag');
    Route::get('tag/crear', [TagController::class, 'crear'])->name('tag.crear');
    Route::get('tag/{id}/editar', [TagController::class, 'editar'])->name('tag.editar');
    Route::post('tag', [TagController::class, 'guardar'])->name('tag.guardar');
    Route::put('tag/{id}', [TagController::class, 'actualizar'])->name('tag.actualizar');
    Route::delete('tag/{id}', [TagController::class, 'eliminar'])->name('tag.eliminar');
});
