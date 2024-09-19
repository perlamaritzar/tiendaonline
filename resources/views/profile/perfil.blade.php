@extends('layouts.app')

@section('content')
<div class="row justify-content-center" style="margin: 10px; margin-top: 5px;">
    <div class="col-md-6">
        <p style="font-size: 20px; font-weight: bold; color: #6f6f6f; margin: 0px">Editar Perfil</p>
        <div style="background-color: white; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding: 10px; border-radius: 10px;">
            <p style="color: #6f6f6f; margin-bottom:0">Actualice los datos del usuario.</p><br>
            @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 0px; margin-bottom: 15px">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('usuarios.updateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
<!-- edit.blade.php -->
<div class="form-group row" style="margin-bottom: 10px;">
    <label for="avatar" class="col-md-4 col-form-label text-md-right">Imagen de Perfil:</label>
    <div class="col-md-8">
        <input type="file" name="avatar" class="form-control-file" id="avatar">
    </div>
</div>


                <div class="form-group row" style="margin-bottom: 10px;">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Nombres:</label>
                    <div class="col-md-8">
                        <input type="text" name="name" class="form-control" id="name" style="text-transform: uppercase;" value="{{ $usuario->name }}">
                    </div>
                </div>
                <div class="form-group row" style="margin-bottom: 10px;">
                    <label for="apellido_paterno" class="col-md-4 col-form-label text-md-right">Apellido Paterno:</label>
                    <div class="col-md-8">
                        <input type="text" name="apellido_paterno" class="form-control" id="apellido_paterno" style="text-transform: uppercase;" value="{{ $usuario->apellido_paterno }}">
                    </div>
                </div>
                <div class="form-group row" style="margin-bottom: 10px;">
                    <label for="apellido_materno" class="col-md-4 col-form-label text-md-right">Apellido Materno:</label>
                    <div class="col-md-8">
                        <input type="text" name="apellido_materno" class="form-control" id="apellido_materno" style="text-transform: uppercase;" value="{{ $usuario->apellido_materno }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="celular" class="col-md-4 col-form-label text-md-right">Celular:</label>
                    <div class="col-md-8">
                        <input type="text" name="celular" class="form-control" id="celular" style="text-transform: uppercase;" value="{{ $usuario->celular }}">
                    </div>
                </div>
                <br>
                <div style="text-align: end">
                    <a href="/usuarios" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
