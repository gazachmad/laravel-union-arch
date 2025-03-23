<!DOCTYPE html>
<html data-theme="corporate">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - {{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    @stack('scripts')
</head>

<body>
    @yield('content')
</body>

</html>