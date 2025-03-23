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
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content min-h-full overflow-auto">
            <div class="p-3 h-14 flex items-center gap-2">
                <label for="my-drawer-2" class="btn btn-ghost btn-square btn-sm drawer-button lg:hidden">
                    <i data-feather="sidebar" class="w-5"></i>
                </label>
                <div class="truncate text-xl font-semibold">{{ $title }}</div>
            </div>

            @yield('content')

        </div>

        @include('layouts.sidebar')
    </div>

</body>

</html>