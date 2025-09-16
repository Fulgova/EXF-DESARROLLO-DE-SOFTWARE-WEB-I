@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<section class="row flexbox-container">
  <div class="col-xl-8 col-11 d-flex justify-content-center">
    <div class="card bg-authentication rounded-3 mb-0 w-100">
      <div class="card-body">
        <h1 class="mb-2">Crear cuenta</h1>

        {{-- 
          Si tu endpoint es API, usa action="{{ url('/api/register') }}".
          Si definiste una ruta web con nombre "register", usa route('register').
        --}}
        <form method="POST" action="{{ url('/api/register') }}">
          @csrf

          {{-- RUT --}}
          <div class="form-group mb-2">
            <label for="rut">RUT</label>
            <input type="text" class="form-control" id="rut" name="rut" value="{{ old('rut') }}" placeholder="12.345.678-9" required>
            @error('rut') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Nombre --}}
          <div class="form-group mb-2">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Apellido --}}
          <div class="form-group mb-2">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido') }}" required>
            @error('apellido') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Email --}}
          <div class="form-group mb-2">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Password --}}
          <div class="form-group mb-2">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Confirmación --}}
          <div class="form-group mb-3">
            <label for="password_confirmation">Confirmar contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">Registrar</button>
        </form>

        <p class="mt-2">
          ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
        </p>
      </div>
    </div>
  </div>
</section>
@endsection
