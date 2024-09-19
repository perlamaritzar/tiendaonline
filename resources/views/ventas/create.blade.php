@extends('layouts.app')

@section('content')
<div class="row" style="margin: 10px; margin-top: 5px;">
    <!-- Formulario para creación individual -->
    <p class="icon-text">
        <span class="material-symbols-outlined sub">sell</span>
        Catalogo
    </p>
    <div class="col-12" style="padding: 5px;">
        <div style="background-color: white; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding: 10px; border-radius: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <p style="font-size: 20px; color: #125e2b; margin-bottom: 0;">Seleccione la cantidad y producto deseado.</p>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 0; margin-bottom: 15px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                @foreach($productos as $producto)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div style="height: 200px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                            <img src="{{ asset('images/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->descripcion }}" style="max-height: 100%; max-width: 100%;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->descripcion }}</h5>
                            <p class="card-text">Precio: ${{ $producto->precio }}</p>
                            <p class="card-text">Cantidad Disponible: {{ $producto->cantidad }}</p>
                            <form action="{{ route('ventas.registrar') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="cantidad">Cantidad a Vender</label>
                                    <input type="number" class="form-control" id="cantidad" name="ventas[{{ $producto->id }}][cantidad]" min="0" max="{{ $producto->cantidad }}">
                                    <input type="hidden" name="ventas[{{ $producto->id }}][producto_id]" value="{{ $producto->id }}">
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Vender</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
