@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Usuarios</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>RUT</th>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody id="users-table-body">
            {{-- Aquí inyectaremos usuarios con JS --}}
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    fetch('/api/users', {
        headers: {
            'Authorization': 'Bearer TU_TOKEN_JWT'
        }
    })
    .then(response => response.json())
    .then(users => {
        const tbody = document.getElementById('users-table-body');
        tbody.innerHTML = users.map(user => `
            <tr>
                <td>${user.id}</td>
                <td>${user.rut}</td>
                <td>${user.nombre} ${user.apellido}</td>
                <td>${user.email}</td>
            </tr>
        `).join('');
    });
</script>
@endsection