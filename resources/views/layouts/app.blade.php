<!DOCTYPE html>
<html class="loading" lang="es" data-textdirection="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Panel de Administración - VentasFix">
    <meta name="keywords" content="admin template, dashboard">
    <meta name="author" content="VentasFix">
    <title>@yield('title', 'VentasFix Backoffice')</title>

    <!-- ========== CSS PRINCIPAL DEL TEMPLATE ========== -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core/menu/menu-types/vertical-menu.css') }}">
    
    <!-- Aquí puedes agregar más CSS si el template tiene adicionales -->
    @stack('styles')
</head>
<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- ======= HEADER / NAVBAR ======= -->
    @includeIf('partials.navbar')

    <!-- ======= MENU LATERAL ======= -->
    @includeIf('partials.sidebar')

    <!-- ======= CONTENIDO PRINCIPAL ======= -->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- ======= FOOTER ======= -->
    @includeIf('partials.footer')

    <!-- ========== JS PRINCIPAL DEL TEMPLATE ========== -->
    <script src="{{ asset('assets/vendor/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/customizer.js') }}"></script>

    <!-- Aquí puedes agregar JS adicionales si el template los tiene -->
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof feather !== 'undefined') {
                feather.replace({ width: 14, height: 14 });
            }
        });
    </script>
</body>
</html>