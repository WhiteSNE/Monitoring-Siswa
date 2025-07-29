<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <title>Dashboard Admin</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 min-h-screen font-sans">
    <div class="flex flex-col h-screen text-gray-600">
        @include('layouts.navigation')

        <div class="flex flex-1 overflow-hidden">
            @include('components.sidebar')

            <main class="flex-1 p-6 overflow-auto">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
