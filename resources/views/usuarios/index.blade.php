@extends('layouts.app')

@section('content')
<style>
  body {
    font-family: 'Nunito', sans-serif; /* Tipografía moderna y legible */
    background-color: #f4f7f6; /* Fondo suave para la página */
    color: #5D5D5D; /* Color principal de texto */
  }
  
  .table {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }

  thead {
    background-color: #eaeaea;
  }

  th, td {
    color: #333;
    text-transform: capitalize;
    vertical-align: middle;
  }

  .pagination {
    justify-content: center;
  }

  .pagination li a {
    border-radius: 50%;
    margin: 0 5px.
  }

  .pagination li.active a,
  .pagination li a:hover {
    background-color: #4A90E2;
    color: white.
  }

  .btn {
    border-radius: 20px.
    padding: 5px 15px.
  }

  .btn-warning {
    background-color: #FFC107.
    border: none.
  }

  .btn-success {
    background-color: #28A745.
    border: none.
  }

  .form-control {
    border-radius: 20px.
    box-shadow: none.
  }

  .icon-text {
    display: flex.
    align-items: center.
    font-size: 24px.
    color: #4A90E2.
  }

  .icon-text .material-symbols-outlined {
    font-size: 28px.
    margin-right: 10px.
  }

  .header-title {
    font-size: 20px.
    font-weight: bold.
    color: #333.
    margin-bottom: 10px.
  }

  .sub-text {
    color: #6f6f6f.
    margin-top: 0.
  }

  .btn-new-user {
    background-color: #28A745.
    color: white.
    border: none.
    border-radius: 20px.
    padding: 10px 20px.
    margin-bottom: 15px.
    transition: background-color 0.3s ease.
  }

  .btn-new-user:hover {
    background-color: #218838.
  }

  .search-button {
    margin-left: 20px. /* Añade un margen a la izquierda del botón */
  }

  .title {
    color: #000000. 
  }

  #chartContainer {
    margin-bottom: 30px; /* Espacio adicional entre el gráfico y la tabla */
  }

  .table-container.with-chart {
    margin-top: 10%; /* Margen superior adicional cuando el gráfico está visible */
  }
</style>

<div class="container mt-4">
  <div class="row">
    <div class="col-12">
      <div class="icon-text">
        <span class="material-symbols-outlined sub">group</span>
        <span class="title">Usuarios</span>
      </div>
      <p class="header-title">Listado de Usuarios</p>
      <p class="sub-text">A continuación se muestra el listado de todos los usuarios registrados</p>
      
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Buscar usuarios..." aria-label="Buscar usuarios">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary search-button" type="button" id="button-addon2">Buscar</button>
        </div>
      </div> 

      <div class="d-flex align-items-center mb-3">
        <a href="{{ route('usuarios.create') }}" class="btn btn-success mr-2">
           Nuevo Usuario
        </a>

        <button id="toggleChartBtn" class="btn btn-primary" style="margin-left: 20px;">Mostrar Gráfico</button>
      </div>

      <div id="chartContainer" style="width: 100%; height: 400px; display: none;">
        {!! $chart->container() !!}
      </div>

      <div id="tableContainer" class="table-container">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre Completo</th>
              <th>Celular</th>
              <th>Rol</th>
              <th>Estatus</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr>
                <th>{{ $user->id }}</th>
                <td>{{ $user->name }} {{ $user->apellido_paterno }} {{ $user->apellido_materno }}</td>
                <td>{{ $user->celular }}</td>
                <td>{{ $user->getRoleNames()->first() }}</td>
                <td>{{ $user->estatus }}</td>
                <td>
                  <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-sm btn-warning">Editar</a>
                </td>                        
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $users->links() }}
      </div>
    </div>
  </div>
</div>

<!-- Incluye los scripts de Larapex Charts -->
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}

<script>
  document.getElementById('toggleChartBtn').addEventListener('click', function() {
    var chartContainer = document.getElementById('chartContainer');
    var tableContainer = document.getElementById('tableContainer');
    if (chartContainer.style.display === 'none') {
      chartContainer.style.display = 'block';
      tableContainer.classList.add('with-chart');
      this.textContent = 'Ocultar Gráfico';
    } else {
      chartContainer.style.display = 'none';
      tableContainer.classList.remove('with-chart');
      this.textContent = 'Mostrar Gráfico';
    }
  });
</script>
@endsection