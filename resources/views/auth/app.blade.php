<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="html"
    data-bs-theme="{{ $_COOKIE['theme'] ?? 'light' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Auth System')</title>

    @yield('meta')

    <!-- CSS CORE -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/frontend/assets/css/theme.min.css?v=2" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


    <!-- EXTRA CSS -->
    @yield('css')
</head>

<body class="sidebar-collapse">
    <main id="panel">
        @yield('content')
    </main>

    <!-- JS CORE -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/js/index.js') }}"></script>

    <!-- EXTRA JS -->
    @yield('scripts')

</body>

</html>
