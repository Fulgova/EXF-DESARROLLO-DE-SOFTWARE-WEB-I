@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header"><h4>Login</h4></div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
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
                <p class="mt-2">¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
