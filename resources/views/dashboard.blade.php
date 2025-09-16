@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
  <!-- Header con botón logout -->
  <nav class="navbar navbar-light bg-white shadow-sm px-3 d-flex justify-content-between">
      <span class="navbar-brand mb-0 h4">Dashboard</span>
      <form method="POST" action="{{ route('logoutweb') }}">
          @csrf
          <button type="submit" class="btn btn-danger btn-sm">
              <i class="fa fa-sign-out-alt"></i> Cerrar sesión
          </button>
      </form>
  </nav>

<div class="row mt-3">
    <!-- Usuarios -->
    <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
        <div class="card text-center">
            <div class="card-body">
                <h4 class="card-title">Usuarios</h4>
                <h2>{{ $usersCount }}</h2>
                <p class="card-text">Total registrados</p>

                <!-- Botón para mostrar todos los usuarios -->
                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#usuariosModal">
                    Ver usuarios
                </button>

                <!-- Botón para buscar usuario por ID -->
                <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#buscarUsuarioModal">
                    Buscar por ID
                </button>
            </div>
        </div>
    </div>

    <!-- Productos -->
    <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
        <div class="card text-center">
            <div class="card-body">
                <h4 class="card-title">Productos</h4>
                <h2>{{ $productsCount }}</h2>
                <p class="card-text">Total en inventario</p>
            </div>
        </div>
    </div>

    <!-- Clientes -->
    <div class="col-lg-4 col-md-6 col-sm-12 mb-2">
        <div class="card text-center">
            <div class="card-body">
                <h4 class="card-title">Clientes</h4>
                <h2>{{ $clientsCount }}</h2>
                <p class="card-text">Total registrados</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal para mostrar usuarios -->
<div class="modal fade" id="usuariosModal" tabindex="-1" aria-labelledby="usuariosModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="usuariosModalLabel">Lista de Usuarios</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>RUT</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->rut }}</td>
              <td>{{ $user->nombre }}</td>
              <td>{{ $user->apellido }}</td>
              <td>{{ $user->email }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal para buscar usuario por ID -->
<div class="modal fade" id="buscarUsuarioModal" tabindex="-1" aria-labelledby="buscarUsuarioModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buscarUsuarioModalLabel">Buscar Usuario por ID</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form id="buscarUsuarioForm">
          <div class="mb-3">
            <label for="usuarioId" class="form-label">ID del usuario</label>
            <input type="number" class="form-control" id="usuarioId" placeholder="Ej: 1">
          </div>
          <button type="button" class="btn btn-success w-100" onclick="buscarUsuario()">Buscar</button>
        </form>

        <!-- Resultado -->
        <div id="usuarioResultado" class="mt-3"></div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
function buscarUsuario() {
    let id = document.getElementById('usuarioId').value;

    fetch(`/users/${id}`, { // 👉 usamos la ruta web, no API
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Usuario no encontrado o no autorizado');
        }
        return response.json();
    })
    .then(user => {
        document.getElementById('usuarioResultado').innerHTML = `
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">${user.nombre} ${user.apellido}</h5>
                <p><strong>RUT:</strong> ${user.rut}</p>
                <p><strong>Email:</strong> ${user.email}</p>
              </div>
            </div>
        `;
    })
    .catch(error => {
        document.getElementById('usuarioResultado').innerHTML = `
            <div class="alert alert-danger">${error.message}</div>
        `;
    });
}
</script>
@endpush
