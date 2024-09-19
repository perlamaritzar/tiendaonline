<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Support\Carbon;
class ProductosController extends Controller
{
    public function index()
    {
        $productos = Producto::all(); 
        $productos = Producto::orderBy('id', 'desc')->paginate(10);
        return view('productos.index', compact('productos'));
    }

    public function edit($id)
    {
        $producto = Producto::find($id);
        
        if (!$producto) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado');
        }
    
        return view('productos.edit', compact('producto'));
    }
    
    
    public function mostrarFormulario()
    {
        return view('productos.create');
    }

    public function crearVenta(Request $request)
    {
        $messages = [
            'marca.required' => 'El campo Marca es obligatorio.',
            'silueta.required' => 'El campo Silueta es obligatorio.',
            'modelo.required' => 'El campo Modelo es obligatorio.',
            'talla.required' => 'El campo Talla es obligatorio.',
            'estado.required' => 'El campo Estado es obligatorio.',
            'condicion.required' => 'El campo Condición es obligatorio.',
            'cantidad.required' => 'El campo Cantidad es obligatorio.',
            'imagen.required' => 'El campo Imagen es obligatorio.',
            'descripcion.required' => 'El campo Descripción es obligatorio.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser un archivo de tipo: jpeg, png, jpg, gif, svg.',
            'imagen.max' => 'La imagen no debe ser mayor a 2048 kilobytes.',
            'precio.required' => 'El campo Imagen es obligatorio.',

            
            // ... puedes agregar más mensajes personalizados aquí
        ];
    
        $validated = $request->validate([
            'marca' => 'required|string|max:255',
            'silueta' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'talla' => 'required|numeric', 
            'estado' => 'required|string|max:255',
            'condicion' => 'required|string|max:255',
            'cantidad' => 'required|numeric', 
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric', 
        ], $messages);
    
        // Creación del objeto Producto
        $producto = new Producto; 
        $producto->marca = $request->marca;
        $producto->silueta = $request->silueta;
        $producto->modelo = $request->modelo;
        $producto->talla = $request->talla;
        $producto->estado = $request->estado;
        $producto->condicion = $request->condicion;
        $producto->cantidad = $request->cantidad;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;

    
        // Manejo de la carga de la imagen
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $producto->imagen = $name; // Asumiendo que tienes una columna 'imagen'
        }
    
        $producto->save();
    
        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
    }
    
    public function update(Request $request, $id)
    {
        // Validación de datos (esto es un ejemplo básico, puedes agregar más reglas según lo necesites)
        $request->validate([
            'marca' => 'required|string|max:255',
            'silueta' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'talla' => 'required|numeric', 
            'estado' => 'required|in:Nuevo,Usado',
            'condicion' => 'required|in:Noventa,Ochenta,Setenta',
            'cantidad' => 'required|numeric', 
            'descripcion' => 'required|string|max:255',            
            'precio' => 'required|numeric', 

        ]);

        // Busca el producto por ID
        $producto = Producto::find($id);

        // Si el producto no se encuentra, redirige con un mensaje de error (puedes manejar esto de diferentes maneras)
        if (!$producto) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado.');
        }

        // Actualiza el producto con los datos del formulario
        $producto->update([
            'marca' => $request->marca,
            'silueta' => $request->silueta,
            'modelo' => $request->modelo,
            'talla' => $request->talla,
            'estado' => $request->estado,
            'condicion' => $request->condicion,
            'cantidad' => $request->cantidad,
            'imagen' => $request->imagen,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,

        ]);


        // Redirige de vuelta a la página de lista o a donde prefieras con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito.');
    }

    
    public function buscar(Request $request) {
        $busqueda = $request->get('busqueda');
    
        $productos = Producto::where('marca', 'LIKE', "%$busqueda%")
                             ->orWhere('silueta', 'LIKE', "%$busqueda%")
                             ->orWhere('modelo', 'LIKE', "%$busqueda%")
                             ->orWhere('talla', 'LIKE', "%$busqueda%")
                             ->orWhere('estado', 'LIKE', "%$busqueda%")
                             ->orWhere('precio', 'LIKE', "%$busqueda%")
                             ->paginate(10);
    
        return view('productos.index', compact('productos'));
    }

    public function eliminar($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrada.');
        }

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminada con éxito.');
    }

    
}
