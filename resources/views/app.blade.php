<!DOCTYPE html>
<html data-theme="cmyk">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - {{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    @stack('scripts')
</head>

<body>
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content min-h-full overflow-auto">
            @include('layouts.navbar')

            @yield('content')

        </div>

        @include('layouts.sidebar')
    </div>

</body>

</html>