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

                <!-- Botones -->
                <button class="btn btn-outline-primary btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#usuariosModal">
                    Ver usuarios
                </button>
                <button class="btn btn-outline-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#buscarUsuarioModal">
                    Buscar por ID
                </button>
                <button class="btn btn-outline-primary btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#crearUsuarioModal">
                    Crear usuario
                </button>
                <button class="btn btn-outline-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#eliminarUsuarioModal">
                    Eliminar por ID
                </button>
                <button class="btn btn-outline-warning btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#editarUsuarioModal">
                    Editar usuario
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

      <!-- Botones -->
      <button class="btn btn-outline-primary btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#productosModal">
          Ver productos
      </button>
      <button class="btn btn-outline-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#buscarProductoModal">
          Buscar por ID
      </button>
      <button class="btn btn-outline-primary btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#crearProductoModal">
          Crear producto
      </button>
      <button class="btn btn-outline-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#eliminarProductoModal">
          Eliminar por ID
      </button>
      <button class="btn btn-outline-warning btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#editarProductoModal">
          Editar producto
      </button>
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

<!-- ====================== MODALES ====================== -->

<!-- Ver usuarios -->
<div class="modal fade" id="usuariosModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Lista de Usuarios</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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

<!-- Buscar usuario -->
<div class="modal fade" id="buscarUsuarioModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buscar Usuario por ID</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="number" id="usuarioId" class="form-control mb-2" placeholder="Ej: 1">
        <button type="button" class="btn btn-success w-100" onclick="buscarUsuario()">Buscar</button>
        <div id="usuarioResultado" class="mt-3"></div>
      </div>
    </div>
  </div>
</div>

<!-- Crear usuario -->
<div class="modal fade" id="crearUsuarioModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form id="crearUsuarioForm">
          <input type="text" id="rut" class="form-control mb-2" placeholder="RUT" required>
          <input type="text" id="nombre" class="form-control mb-2" placeholder="Nombre" required>
          <input type="text" id="apellido" class="form-control mb-2" placeholder="Apellido" required>
          <input type="email" id="email" class="form-control mb-2" placeholder="Correo" required>
          <input type="password" id="password" class="form-control mb-2" placeholder="Contraseña" required>
          <button type="button" class="btn btn-primary w-100" onclick="crearUsuario()">Crear</button>
        </form>
        <div id="crearUsuarioResultado" class="mt-2"></div>
      </div>
    </div>
  </div>
</div>
<!-- Eliminar usuario -->
<div class="modal fade" id="eliminarUsuarioModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Eliminar Usuario</h5></div>
      <div class="modal-body">
        <input type="number" id="eliminarUsuarioId" class="form-control mb-2" placeholder="ID del usuario">
        <button type="button" class="btn btn-danger w-100" onclick="eliminarUsuario()">Eliminar</button>
        <div id="eliminarUsuarioResultado" class="mt-2"></div>
      </div>
    </div>
  </div>
</div>

<!-- Editar usuario -->
<div class="modal fade" id="editarUsuarioModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Editar Usuario</h5></div>
      <div class="modal-body">
        <input type="number" id="editarUsuarioId" class="form-control mb-2" placeholder="ID del usuario">
        <input type="text" id="editarNombre" class="form-control mb-2" placeholder="Nuevo nombre">
        <input type="text" id="editarApellido" class="form-control mb-2" placeholder="Nuevo apellido">
        <input type="email" id="editarEmail" class="form-control mb-2" placeholder="Nuevo correo">
        <button type="button" class="btn btn-warning w-100" onclick="editarUsuario()">Guardar cambios</button>
        <div id="editarUsuarioResultado" class="mt-2"></div>
      </div>
    </div>
  </div>
</div>
<!-- Ver productos -->
<div class="modal fade" id="productosModal" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Lista de Productos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>SKU</th>
              <th>Nombre</th>
              <th>Descripción corta</th>
              <th>Descripción larga</th>
              <th>Imagen</th>
              <th>Precio Neto</th>
              <th>Precio Venta</th>
              <th>Stock Actual</th>
              <th>Stock Mínimo</th>
              <th>Stock Bajo</th>
              <th>Stock Alto</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)
            <tr>
              <td>{{ $product->id }}</td>
              <td>{{ $product->sku }}</td>
              <td>{{ $product->nombre }}</td>
              <td>{{ $product->descripcion_corta }}</td>
              <td>{{ $product->descripcion_larga }}</td>
              <td>
                @if($product->imagen)
                  <img src="{{ $product->imagen }}" alt="imagen" width="50">
                @endif
              </td>
              <td>{{ $product->precio_neto }}</td>
              <td>{{ $product->precio_venta }}</td>
              <td>{{ $product->stock_actual }}</td>
              <td>{{ $product->stock_minimo }}</td>
              <td>{{ $product->stock_bajo }}</td>
              <td>{{ $product->stock_alto }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<!-- Buscar producto -->
<div class="modal fade" id="buscarProductoModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Buscar Producto por ID</h5></div>
      <div class="modal-body">
        <input type="number" id="productoId" class="form-control mb-2" placeholder="Ej: 1">
        <button type="button" class="btn btn-success w-100" onclick="buscarProducto()">Buscar</button>
        <div id="productoResultado" class="mt-2"></div>
      </div>
    </div>
  </div>
</div>

<!-- Crear producto -->
<div class="modal fade" id="crearProductoModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Crear Producto</h5></div>
      <div class="modal-body">
        <form id="crearProductoForm">
          <input type="text" id="skuProducto" class="form-control mb-2" placeholder="SKU" required>
          <input type="text" id="nombreProducto" class="form-control mb-2" placeholder="Nombre" required>
          <input type="text" id="descripcionCortaProducto" class="form-control mb-2" placeholder="Descripción corta">
          <textarea id="descripcionLargaProducto" class="form-control mb-2" placeholder="Descripción larga"></textarea>
          <input type="text" id="imagenProducto" class="form-control mb-2" placeholder="URL Imagen">
          <input type="number" id="precioNetoProducto" class="form-control mb-2" placeholder="Precio Neto" required>
          <input type="number" id="precioVentaProducto" class="form-control mb-2" placeholder="Precio Venta" required>
          <input type="number" id="stockActualProducto" class="form-control mb-2" placeholder="Stock Actual" required>
          <input type="number" id="stockMinimoProducto" class="form-control mb-2" placeholder="Stock Mínimo" required>
          <input type="number" id="stockBajoProducto" class="form-control mb-2" placeholder="Stock Bajo" required>
          <input type="number" id="stockAltoProducto" class="form-control mb-2" placeholder="Stock Alto" required>

          <button type="button" class="btn btn-primary w-100" onclick="crearProducto()">Crear</button>
        </form>
        <div id="crearProductoResultado" class="mt-2"></div>
      </div>
    </div>
  </div>
</div>
<!-- Eliminar producto -->
<div class="modal fade" id="eliminarProductoModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Eliminar Producto</h5></div>
      <div class="modal-body">
        <input type="number" id="eliminarProductoId" class="form-control mb-2" placeholder="ID del producto">
        <button type="button" class="btn btn-danger w-100" onclick="eliminarProducto()">Eliminar</button>
        <div id="eliminarProductoResultado" class="mt-2"></div>
      </div>
    </div>
  </div>
</div>

<!-- Editar producto -->
<div class="modal fade" id="editarProductoModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Editar Producto</h5></div>
      <div class="modal-body">
        <form id="editarProductoForm">
          <input type="number" id="editarProductoId" class="form-control mb-2" placeholder="ID del producto" required>

          <!-- Botón para cargar datos del producto -->
          <button type="button" class="btn btn-info w-100 mb-3" onclick="cargarProductoEditar()">Cargar datos</button>

          <input type="text" id="editarSkuProducto" class="form-control mb-2" placeholder="SKU" required>
          <input type="text" id="editarNombreProducto" class="form-control mb-2" placeholder="Nombre" required>
          <input type="text" id="editarDescripcionCortaProducto" class="form-control mb-2" placeholder="Descripción corta">
          <textarea id="editarDescripcionLargaProducto" class="form-control mb-2" placeholder="Descripción larga"></textarea>
          <input type="text" id="editarImagenProducto" class="form-control mb-2" placeholder="URL Imagen">
          <input type="number" id="editarPrecioNetoProducto" class="form-control mb-2" placeholder="Precio Neto" required>
          <input type="number" id="editarPrecioVentaProducto" class="form-control mb-2" placeholder="Precio Venta" required>
          <input type="number" id="editarStockActualProducto" class="form-control mb-2" placeholder="Stock Actual" required>
          <input type="number" id="editarStockMinimoProducto" class="form-control mb-2" placeholder="Stock Mínimo" required>
          <input type="number" id="editarStockBajoProducto" class="form-control mb-2" placeholder="Stock Bajo" required>
          <input type="number" id="editarStockAltoProducto" class="form-control mb-2" placeholder="Stock Alto" required>

          <button type="button" class="btn btn-warning w-100" onclick="editarProducto()">Guardar cambios</button>
        </form>
        <div id="editarProductoResultado" class="mt-2"></div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
// Buscar usuario
function buscarUsuario() {
    let id = document.getElementById('usuarioId').value;
    fetch(`/users/${id}`, { headers: { 'Accept': 'application/json' } })
    .then(res => { if (!res.ok) throw new Error('Usuario no encontrado'); return res.json(); })
    .then(user => {
        document.getElementById('usuarioResultado').innerHTML = `
            <div class="card"><div class="card-body">
              <h5>${user.nombre} ${user.apellido}</h5>
              <p><b>RUT:</b> ${user.rut}</p>
              <p><b>Email:</b> ${user.email}</p>
            </div></div>`;
    })
    .catch(err => document.getElementById('usuarioResultado').innerHTML = `<div class="alert alert-danger">${err.message}</div>`);
}

// Crear usuario
function crearUsuario() {
  let rut = document.getElementById('rut').value.trim();
  let nombre = document.getElementById('nombre').value.trim();
  let apellido = document.getElementById('apellido').value.trim();
  let email = document.getElementById('email').value.trim();
  let password = document.getElementById('password').value.trim();

  if (!rut || !nombre || !apellido || !email || !password) {
    document.getElementById('crearUsuarioResultado').innerHTML =
      `<div class="alert alert-warning">Todos los campos son obligatorios</div>`;
    return;
  }

  fetch('/users', {
    method: 'POST',
    headers: { 
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({ rut, nombre, apellido, email, password })
  })
  .then(res => res.json())
  .then(data => {
    document.getElementById('crearUsuarioResultado').innerHTML =
      `<div class="alert alert-success">Usuario creado con ID: ${data.id}</div>`;

    // limpiar inputs
    document.getElementById('crearUsuarioForm').reset();

    // refrescar la página o lista de usuarios automáticamente
    setTimeout(() => location.reload(), 1000);
  })
  .catch(() => {
    document.getElementById('crearUsuarioResultado').innerHTML =
      `<div class="alert alert-danger">Error al crear usuario</div>`;
  });
}

// Eliminar usuario
function eliminarUsuario() {
  let id = document.getElementById('eliminarUsuarioId').value.trim();

  if (!id) {
    document.getElementById('eliminarUsuarioResultado').innerHTML =
      `<div class="alert alert-warning">El campo ID es obligatorio</div>`;
    return;
  }

  fetch(`/users/${id}`, { 
      method: 'DELETE', 
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } 
  })
  .then(res => {
    if(res.ok){
      document.getElementById('eliminarUsuarioResultado').innerHTML =
        `<div class="alert alert-success">Usuario eliminado</div>`;
      setTimeout(() => location.reload(), 1000);
    } else {
      document.getElementById('eliminarUsuarioResultado').innerHTML =
        `<div class="alert alert-danger">No se pudo eliminar</div>`;
    }
  })
  .catch(() => {
    document.getElementById('eliminarUsuarioResultado').innerHTML =
      `<div class="alert alert-danger">Error en la solicitud</div>`;
  });
}
/// Editar usuario
function editarUsuario() {
  let id = document.getElementById('editarUsuarioId').value.trim();
  let nombre = document.getElementById('editarNombre').value.trim();
  let apellido = document.getElementById('editarApellido').value.trim();
  let email = document.getElementById('editarEmail').value.trim();

  if (!id || !nombre || !apellido || !email) {
    document.getElementById('editarUsuarioResultado').innerHTML =
      `<div class="alert alert-warning">Todos los campos son obligatorios</div>`;
    return;
  }

  fetch(`/users/${id}`, {
    method: 'PUT',
    headers: { 
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({ nombre, apellido, email })
  })
  .then(res => {
    if (!res.ok) throw new Error('Error al actualizar');
    return res.json();
  })
  .then(data => {
    document.getElementById('editarUsuarioResultado').innerHTML =
      `<div class="alert alert-success">Usuario actualizado: ${data.nombre} ${data.apellido}</div>`;
    
    // refrescar después de un momento
    setTimeout(() => location.reload(), 1000);
  })
  .catch(() => {
    document.getElementById('editarUsuarioResultado').innerHTML =
      `<div class="alert alert-danger">Error al editar usuario</div>`;
  });
}

// Buscar producto
function buscarProducto() {
  let id = document.getElementById('productoId').value.trim();
  if (!id) {
    document.getElementById('productoResultado').innerHTML =
      `<div class="alert alert-warning">El campo ID es obligatorio</div>`;
    return;
  }

  fetch(`/products/${id}`, { headers: { 'Accept': 'application/json' } })
    .then(res => { if (!res.ok) throw new Error('Producto no encontrado'); return res.json(); })
    .then(product => {
      document.getElementById('productoResultado').innerHTML = `
        <div class="card">
          <div class="card-body">
            <h5>${product.nombre} (${product.sku})</h5>
            <p><b>Descripción corta:</b> ${product.descripcion_corta || '-'}</p>
            <p><b>Descripción larga:</b> ${product.descripcion_larga || '-'}</p>
            <p><b>Precio Neto:</b> ${product.precio_neto || '-'}</p>
            <p><b>Precio Venta:</b> ${product.precio_venta || '-'}</p>
            <p><b>Stock Actual:</b> ${product.stock_actual || '-'}</p>
            <p><b>Stock Mínimo:</b> ${product.stock_minimo || '-'}</p>
            <p><b>Stock Bajo:</b> ${product.stock_bajo || '-'}</p>
            <p><b>Stock Alto:</b> ${product.stock_alto || '-'}</p>
            ${product.imagen ? `<img src="${product.imagen}" alt="imagen" width="100">` : ''}
          </div>
        </div>`;
    })
    .catch(err => {
      document.getElementById('productoResultado').innerHTML =
        `<div class="alert alert-danger">${err.message}</div>`;
    });
}

// Crear producto
function crearProducto() {
  let data = {
    sku: document.getElementById('skuProducto').value.trim(),
    nombre: document.getElementById('nombreProducto').value.trim(),
    descripcion_corta: document.getElementById('descripcionCortaProducto').value.trim(),
    descripcion_larga: document.getElementById('descripcionLargaProducto').value.trim(),
    imagen: document.getElementById('imagenProducto').value.trim(),
    precio_neto: document.getElementById('precioNetoProducto').value.trim(),
    precio_venta: document.getElementById('precioVentaProducto').value.trim(),
    stock_actual: document.getElementById('stockActualProducto').value.trim(),
    stock_minimo: document.getElementById('stockMinimoProducto').value.trim(),
    stock_bajo: document.getElementById('stockBajoProducto').value.trim(),
    stock_alto: document.getElementById('stockAltoProducto').value.trim(),
  };

  // Validación
  if (!data.sku || !data.nombre || !data.precio_neto || !data.precio_venta || !data.stock_actual || !data.stock_minimo || !data.stock_bajo || !data.stock_alto) {
    document.getElementById('crearProductoResultado').innerHTML =
      `<div class="alert alert-warning">Todos los campos requeridos deben estar completos</div>`;
    return;
  }

  fetch('/products', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
    body: JSON.stringify(data)
  })
  .then(res => res.json())
  .then(prod => {
    document.getElementById('crearProductoResultado').innerHTML =
      `<div class="alert alert-success">Producto creado con ID: ${prod.id}</div>`;
    document.getElementById('crearProductoForm').reset();
    setTimeout(() => location.reload(), 1000);
  })
  .catch(() => {
    document.getElementById('crearProductoResultado').innerHTML =
      `<div class="alert alert-danger">Error al crear producto</div>`;
  });
}

// Eliminar producto
function eliminarProducto() {
  let id = document.getElementById('eliminarProductoId').value.trim();
  if (!id) {
    document.getElementById('eliminarProductoResultado').innerHTML =
      `<div class="alert alert-warning">El campo ID es obligatorio</div>`;
    return;
  }

  fetch(`/products/${id}`, { 
    method: 'DELETE',
    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
  })
  .then(res => {
    if(res.ok){
      document.getElementById('eliminarProductoResultado').innerHTML =
        `<div class="alert alert-success">Producto eliminado</div>`;
      setTimeout(() => location.reload(), 1000);
    } else {
      document.getElementById('eliminarProductoResultado').innerHTML =
        `<div class="alert alert-danger">No se pudo eliminar</div>`;
    }
  })
  .catch(() => {
    document.getElementById('eliminarProductoResultado').innerHTML =
      `<div class="alert alert-danger">Error en la solicitud</div>`;
  });
}

// Editar producto
function editarProducto() {
  let id = document.getElementById('editarProductoId').value.trim();

  let data = {
    sku: document.getElementById('editarSkuProducto').value.trim(),
    nombre: document.getElementById('editarNombreProducto').value.trim(),
    descripcion_corta: document.getElementById('editarDescripcionCortaProducto').value.trim(),
    descripcion_larga: document.getElementById('editarDescripcionLargaProducto').value.trim(),
    imagen: document.getElementById('editarImagenProducto').value.trim(),
    precio_neto: document.getElementById('editarPrecioNetoProducto').value.trim(),
    precio_venta: document.getElementById('editarPrecioVentaProducto').value.trim(),
    stock_actual: document.getElementById('editarStockActualProducto').value.trim(),
    stock_minimo: document.getElementById('editarStockMinimoProducto').value.trim(),
    stock_bajo: document.getElementById('editarStockBajoProducto').value.trim(),
    stock_alto: document.getElementById('editarStockAltoProducto').value.trim(),
  };

  if (!id || !data.sku || !data.nombre || !data.precio_neto || !data.precio_venta || !data.stock_actual || !data.stock_minimo || !data.stock_bajo || !data.stock_alto) {
    document.getElementById('editarProductoResultado').innerHTML =
      `<div class="alert alert-warning">Todos los campos son obligatorios</div>`;
    return;
  }

  fetch(`/products/${id}`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
    body: JSON.stringify(data)
  })
  .then(res => {
    if (!res.ok) throw new Error('Error en actualización');
    return res.json();
  })
  .then(prod => {
    document.getElementById('editarProductoResultado').innerHTML =
      `<div class="alert alert-success">Producto actualizado: ${prod.nombre}</div>`;
    setTimeout(() => location.reload(), 1000);
  })
  .catch(() => {
    document.getElementById('editarProductoResultado').innerHTML =
      `<div class="alert alert-danger">Error al editar producto</div>`;
  });
}
function cargarProductoEditar() {
  let id = document.getElementById('editarProductoId').value.trim();
  if (!id) {
    document.getElementById('editarProductoResultado').innerHTML =
      `<div class="alert alert-warning">Debes ingresar un ID primero</div>`;
    return;
  }

  fetch(`/products/${id}`, { headers: { 'Accept': 'application/json' } })
    .then(res => { if (!res.ok) throw new Error('Producto no encontrado'); return res.json(); })
    .then(prod => {
      // Cargar valores en los inputs
      document.getElementById('editarSkuProducto').value = prod.sku || '';
      document.getElementById('editarNombreProducto').value = prod.nombre || '';
      document.getElementById('editarDescripcionCortaProducto').value = prod.descripcion_corta || '';
      document.getElementById('editarDescripcionLargaProducto').value = prod.descripcion_larga || '';
      document.getElementById('editarImagenProducto').value = prod.imagen || '';
      document.getElementById('editarPrecioNetoProducto').value = prod.precio_neto || '';
      document.getElementById('editarPrecioVentaProducto').value = prod.precio_venta || '';
      document.getElementById('editarStockActualProducto').value = prod.stock_actual || '';
      document.getElementById('editarStockMinimoProducto').value = prod.stock_minimo || '';
      document.getElementById('editarStockBajoProducto').value = prod.stock_bajo || '';
      document.getElementById('editarStockAltoProducto').value = prod.stock_alto || '';

      document.getElementById('editarProductoResultado').innerHTML =
        `<div class="alert alert-success">Datos cargados, ahora puedes editarlos</div>`;
    })
    .catch(err => {
      document.getElementById('editarProductoResultado').innerHTML =
        `<div class="alert alert-danger">${err.message}</div>`;
    });
}

</script>
@endpush
