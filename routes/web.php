<?php


use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\IndexCatalogosController;
use App\Http\Controllers\VentasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});


Route::get('/inicio', function () {
    return view('inicio');
})->middleware(['auth', 'verified'])->name('inicio');

Route::group(['middleware' => ['role:Administrador']], function () {
    Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/edicion/{id}', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuariosController::class, 'update'])->name('usuarios.update');
    Route::get('/usuarios/nuevo', [UsuariosController::class, 'mostrarFormulario'])->name('usuarios.create');
    Route::post('/usuarios/nuevo', [UsuariosController::class, 'crearUsuario'])->name('usuarios.store');

    Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/create', [VentasController::class, 'mostrarFormulario'])->name('ventas.create');
    Route::post('/ventas', [VentasController::class, 'registrarVenta'])->name('ventas.registrar');
    Route::get('/ventas/{id}/edit', [VentasController::class, 'edit'])->name('ventas.edit');
    Route::put('/ventas/{id}', [VentasController::class, 'update'])->name('ventas.update');
    Route::delete('/ventas/{id}', [VentasController::class, 'eliminar'])->name('ventas.eliminar');
    
    
    Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductosController::class, 'mostrarFormulario'])->name('productos.create');
    Route::post('/productos', [ProductosController::class, 'crearVenta'])->name('productos.store');
    Route::get('/productos/{id}/edit', [ProductosController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{id}', [ProductosController::class, 'update'])->name('productos.update');
    Route::get('/productos/buscar', [ProductosController::class, 'buscar'])->name('productos.buscar');
    Route::delete('/productos/{id}', [ProductosController::class, 'eliminar'])->name('productos.eliminar');


    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
   
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'checkRole:super-admin'])->group(function () {
    // Aquí van todas las rutas protegidas para el super administrador.
});

Route::group(['middleware' => ['role:admin']], function() {
    
});

Route::group(['middleware' => ['permission:edit articles']], function() {
    
});


require __DIR__.'/auth.php';