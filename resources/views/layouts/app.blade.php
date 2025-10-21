<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tribunal App</title>

    <!-- FullCalendar CSS en premier -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Contenu principal -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            @include('layouts.navigation')

            <!-- Page Content -->
            <main class="flex-1 p-6">
                @isset($header)
                    <div class="bg-white shadow p-4 mb-6 rounded">
                        {{ $header }}
                    </div>
                @endisset

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
