<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatilloController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\CocineroController;
use App\Http\Controllers\PagosController;

/*
|--------------------------------------------------------------------------
| Rutas de Cliente
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/menu');
});
Route::post('/registrar', [AuthController::class, 'registrarCliente'])->name('registrar.cliente');
Route::get('/registrar', function () {
    return view('registrar_cliente');
})->name('registrar.formulario');

Route::get('/menu', [PlatilloController::class, 'index']);
Route::get('/menu/filtrar', [PlatilloController::class, 'filtrarPorCategoriaPrecio'])->name('menu.filtrar');
Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.cliente');
Route::get('/carrito', [OrdenController::class, 'verCarrito'])->name('cliente.carrito');
Route::get('/carrito/eliminar', [OrdenController::class, 'cancelarOrden'])->name('cliente.cancelarOrden');

Route::post('/orden', [OrdenController::class, 'enviar'])->name('orden.enviar');
Route::post('/orden/{id}/nota', [OrdenController::class, 'guardarNota'])->name('orden.guardarNota');
Route::get('/orden/{id}/descargar', [OrdenController::class, 'descargarPDF'])->name('orden.descargarPDF');

Route::get('/perfil', [AuthController::class, 'mostrarPerfil'])->name('cliente.perfil');


Route::get('/cliente/ordenes', [OrdenController::class, 'historialCliente'])
    ->name('cliente.ordenes');



Route::get('/logout', function () {
    session()->flush();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Rutas de Negocio (Administrador)
|--------------------------------------------------------------------------
*/
Route::get('/negocio/login', function () {
    return view('negocio.login');
})->name('negocio.login.formulario');

Route::post('/negocio/login', [AuthController::class, 'loginUsuarioNegocio'])->name('negocio.login.submit');

Route::middleware(['admin.negocio'])->group(function () {
    // Dashboard
    Route::get('/negocio/admin/dashboard', function () {
        return view('negocio.dashboard_admin');
    })->name('negocio.admin.dashboard');

    // Gestión de menú
    Route::get('/negocio/admin/gestion/menu', [App\Http\Controllers\Negocio\MenuController::class, 'obtenerPlatillos'])
        ->name('negocio.admin.gestion_menu');

    Route::post('/negocio/admin/gestion/menu/agregar', [App\Http\Controllers\Negocio\MenuController::class, 'guardarNuevoPlatillo'])
        ->name('negocio.admin.agregar_platillo');

    Route::get('/negocio/admin/gestion/menu/editar/{id}', [App\Http\Controllers\Negocio\MenuController::class, 'editarPlatillo'])
        ->name('negocio.admin.editar_platillo');

    Route::put('/negocio/admin/gestion/menu/actualizar', [App\Http\Controllers\Negocio\MenuController::class, 'actualizarPlatillo'])
        ->name('negocio.admin.actualizar_platillo');

    Route::delete('/negocio/admin/gestion/menu/eliminar', [App\Http\Controllers\Negocio\MenuController::class, 'eliminarPlatillo'])
        ->name('negocio.admin.eliminar_platillo');

    // Gestión de usuarios y roles
    Route::get('/negocio/admin/gestion/usuarios', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'listarUsuariosRoles'])
        ->name('negocio.admin.gestion_usuarios_roles');

    Route::get('/negocio/admin/gestion/usuarios/{id}', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'getUsuario'])
        ->name('negocio.admin.obtener_usuario');

    Route::post('/negocio/admin/gestion/usuarios/crear', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'crearUsuario'])
        ->name('negocio.admin.crear_usuario');

    Route::put('/negocio/admin/gestion/usuarios/actualizar', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'actualizarUsuario'])
        ->name('negocio.admin.actualizar_usuario');

    Route::delete('/negocio/admin/gestion/usuarios/eliminar', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'eliminarUsuario'])
        ->name('negocio.admin.eliminar_usuario');

    Route::get('/negocio/admin/gestion/rol/{id}', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'getRol'])
        ->name('negocio.admin.obtener_rol');

    Route::post('/negocio/admin/gestion/rol/crear', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'crearRol'])
        ->name('negocio.admin.crear_rol');

    Route::put('/negocio/admin/gestion/rol/actualizar', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'actualizarRol'])
        ->name('negocio.admin.actualizar_rol');

    Route::delete('/negocio/admin/gestion/rol/eliminar', [App\Http\Controllers\Negocio\UsuarioRolesController::class, 'eliminarRol'])
        ->name('negocio.admin.eliminar_rol');

    Route::get('/negocio/admin/gestion/ordenes', [App\Http\Controllers\OrdenController::class, 'historialOrdenes'])
        ->name('negocio.admin.historial_ordenes');
});

/*
|--------------------------------------------------------------------------
| Rutas de Cocinero
|--------------------------------------------------------------------------
*/
Route::middleware(['cocinero.negocio'])->group(function () {
    Route::get('/cocinero/dashboard', [CocineroController::class, 'index'])->name('cocinero.dashboard');

    Route::get('/cocinero/ordenes/pendientes', [CocineroController::class, 'pendientes'])->name('cocinero.ordenesPendientes');
    Route::post('/cocinero/ordenes/{id}/asignar', [CocineroController::class, 'asignarOrden'])->name('cocinero.asignarOrden');

    Route::get('/cocinero/ordenes/asignadas', [CocineroController::class, 'ordenesAsignadas'])->name('cocinero.ordenesAsignadas');
    Route::post('/cocinero/ordenes/{id}/finalizar', [CocineroController::class, 'finalizarOrden'])->name('cocinero.finalizarOrden');

    Route::get('/cocinero/ordenes/finalizadas', [CocineroController::class, 'ordenesFinalizadas'])->name('cocinero.ordenesFinalizadas');
    Route::get('/cocinero/notificaciones', [CocineroController::class, 'notificaciones'])->name('cocinero.notificaciones');
    // Reportes de cocina
Route::get('/cocinero/reportes', [App\Http\Controllers\CocineroController::class, 'verReportes'])
    ->name('cocinero.reportes');

Route::post('/cocinero/reportes', [App\Http\Controllers\CocineroController::class, 'registrarReporte'])
    ->name('cocinero.registrarReporte');

});
