<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SATGAS PPKS')</title>
    
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <!-- @stack('styles') -->
     @vite('resources/css/app.css')
</head>
<body>
    @yield('content')
    
    @stack('scripts')
</body>
</html>