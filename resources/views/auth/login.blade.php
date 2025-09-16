@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header"><h4>Login</h4></div>
            <div class="card-body">
                <form method="POST" action="{{ url('/loginweb') }}">
                    @csrf

                    <div class="form-group mb-2">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                </form>
                <p class="mt-2">¿No tienes cuenta? <a href="{{ url('/registerweb') }}">Regístrate</a></p>
            </div>
        </div>
    </div>
</div>

<!-- Modal de éxito -->
<div class="modal fade" id="registroExitosoModal" tabindex="-1" aria-labelledby="registroExitosoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="registroExitosoLabel">¡Éxito!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        {{ session('success') }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
@if(session('success'))
<script>
    const modal = new bootstrap.Modal(document.getElementById('registroExitosoModal'));
    modal.show();

    // opcional: cerrar y limpiar mensaje después de unos segundos
    setTimeout(() => {
        modal.hide();
    }, 3000);
</script>
@endif
@endpush
