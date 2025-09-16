<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>Formulario de Registro</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Campo RUT -->
        <label for="rut">RUT</label>
        <input type="text" id="rut" name="rut" value="{{ old('rut') }}" required>
        @error('rut')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <!-- Campo Nombre -->
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        @error('nombre')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <!-- Campo Apellido -->
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}" required>
        @error('apellido')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <!-- Campo Email -->
        <label for="email">Correo Electrónico</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <!-- Campo Contraseña -->
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>
        @error('password')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <!-- Campo Confirmar Contraseña -->
        <label for="password_confirmation">Confirmar Contraseña</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        @error('password_confirmation')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>

        <button type="submit">Registrar</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
</body>
</html>