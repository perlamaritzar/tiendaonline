<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function index()
    {
        $ventas = Venta::orderBy('created_at', 'desc')->paginate(10);
        return view('ventas.index', compact('ventas'));
    }

    public function mostrarFormulario()
    {
        $productos = Producto::all();
        return view('ventas.create', compact('productos'));
    }

    public function registrarVenta(Request $request)
    {
        $ventas = $request->input('ventas', []);
    
        try {
            DB::beginTransaction();
    
            foreach ($ventas as $venta) {
                $producto_id = $venta['producto_id'];
                $cantidad = $venta['cantidad'];
    
                if ($cantidad > 0) {
                    $producto = Producto::findOrFail($producto_id);
                    $producto->cantidad -= $cantidad;
                    $producto->save();
    
                    Venta::create([
                        'producto_id' => $producto_id,
                        'cantidad' => $cantidad,
                        'created_at' => now(),
                    ]);
                }
            }
    
            DB::commit();
    
            return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('ventas.index')->with('error', 'Error al registrar la venta. Por favor, inténtalo de nuevo.');
        }
    }
}