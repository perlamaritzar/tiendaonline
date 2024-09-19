<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Producto;
use App\Models\Venta;
use App\Http\Controllers\VentasController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VentasControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_registrar_venta()
    {
        // Crear datos de prueba (puedes adaptarlos según tus necesidades)
        $producto = Producto::factory()->create(['cantidad' => 10]);
        $ventaData = [
            ['producto_id' => $producto->id, 'cantidad' => 5],
            ['producto_id' => $producto->id, 'cantidad' => 3],
        ];

        // Crear instancia del controlador
        $controller = new VentasController();

        // Ejecutar el método registrarVenta
        $response = $controller->registrarVenta($this->createRequest($ventaData));

        // Verificar que la venta se registra correctamente
        $this->assertCount(2, Venta::all());
        $this->assertEquals(2, Producto::find($producto->id)->cantidad);
        $response->assertRedirect(route('ventas.index'));
        $response->assertSessionHas('success', 'Venta registrada correctamente.');
    }

    // Método para crear una instancia de Request con los datos de venta
    private function createRequest($ventas)
    {
        return new \Illuminate\Http\Request(['ventas' => $ventas]);
    }
}
