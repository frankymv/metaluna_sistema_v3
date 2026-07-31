<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\AbonoController;
use App\Livewire\MarcaController;
use App\Livewire\InicioController;
use App\Livewire\AjusteInventarioController;
use App\Livewire\AsignacionRutaController;
use App\Livewire\DisenioController;
use App\Livewire\InventarioController;

use App\Livewire\MaterialController;
use App\Livewire\ProductoController;
use App\Livewire\TipoController;
use App\Livewire\ClienteController;
use App\Livewire\CombustibleController;
use App\Livewire\CompraController;
use App\Livewire\CotizacionController;
use App\Livewire\CreditoController;
use App\Livewire\CuentaCobrarController;
use App\Livewire\EnvioController;
use App\Livewire\EstadoCuentaController;
use App\Livewire\EstadoCuentaVentaController;
use App\Livewire\EstadoEnvioController;
use App\Livewire\HistorialCotizacionController;
use App\Livewire\InformeEstadoCuentaController;
use App\Livewire\InformeVentaController;
use App\Livewire\NotaCreditoController;
use App\Livewire\ProveedorController;
use App\Livewire\RoleController;
use App\Livewire\RolesController;
use App\Livewire\RutaController;
use App\Livewire\ServicioController;
use App\Livewire\SucursalController;
use App\Livewire\TrasladoController;
use App\Livewire\UsuarioController;
use App\Livewire\VehiculoController;
use App\Livewire\VentaController;
use App\Livewire\VentaRapidaController;
use App\Livewire\ViaticoController;
use App\Models\AjusteInventario;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

Route::view('/', 'welcome');


    Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::middleware('auth')->group(function () {
        Route::get('marca', MarcaController::class)->name('marca');
        Route::get('tipo', TipoController::class)->name('tipo');
        Route::get('material', MaterialController::class)->name('material');
        Route::get('disenio', DisenioController::class)->name('disenio');
        Route::get('producto', ProductoController::class)->name('producto');
        Route::get('inventario', InventarioController::class)->name('inventario');
        Route::get('cliente', ClienteController::class)->name('cliente');
        Route::get('proveedor', ProveedorController::class)->name('proveedor');
        Route::get('inicio', InicioController::class)->name('inicio');
        Route::get('compra', CompraController::class)->name('compra');
        Route::get('usuario', UsuarioController::class)->name('usuario');

        Route::get('venta', VentaController::class)->name('venta');
        Route::get('estado_cuenta', EstadoCuentaController::class)->name('estado_cuenta');
        Route::get('estado_cuenta_venta', EstadoCuentaVentaController::class)->name('estado_cuenta_venta');
        Route::get('ajuste_inventario', AjusteInventarioController::class)->name('ajuste_inventario');
        Route::get('vehiculo', VehiculoController::class)->name('vehiculo');
        Route::get('envio', EnvioController::class)->name('envio');

        Route::get('credito', CreditoController::class)->name('credito');
        Route::get('cuenta_cobrar', CuentaCobrarController::class)->name('cuenta_cobrar');
        Route::get('venta_rapida', VentaRapidaController::class)->name('venta_rapida');
        Route::get('asignacion_ruta', AsignacionRutaController::class)->name('asignacion_ruta');

        Route::get('ruta', RutaController::class)->name('ruta');

        Route::get('estado_envio', EstadoEnvioController::class)->name('estado_envio');
        Route::get('envio', EnvioController::class)->name('envio');

        Route::get('sucursal', SucursalController::class)->name('sucursal');
        Route::get('traslado', TrasladoController::class)->name('traslado');

        Route::get('servicio', ServicioController::class)->name('servicio');
        Route::get('abono', AbonoController::class)->name('abono');
        Route::get('nota_credito', NotaCreditoController::class)->name('nota_credito');
        Route::get('cotizacion', CotizacionController::class)->name('cotizacion');
        Route::get('historial_cotizacion', HistorialCotizacionController::class)->name('historial_cotizacion');


        Route::get('informe_venta', InformeVentaController::class)->name('informe_venta');
        Route::get('informe_estado_cuenta', InformeEstadoCuentaController::class)->name('informe_estado_cuenta');

        Route::get('combustible', CombustibleController::class)->name('combustible');
        Route::get('viatico', ViaticoController::class)->name('viatico');

        Route::get('roles', RolesController::class)->name('roles');
    });
        Route::get('exportar-venta-rapida/{id?}}', [VentaRapidaController::class, 'exportarVentaRapida'])->name('exportarVentaRapida');
        Route::get('pdf-cotizacion/{id?}}', [CotizacionController::class, 'pdfCotizacion'])->name('pdfCotizacion');

require __DIR__.'/auth.php';
