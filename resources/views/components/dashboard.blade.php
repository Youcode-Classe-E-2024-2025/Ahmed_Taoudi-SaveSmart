<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaveSmart - Tableau de Bord</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
{{ $head }}
</head>
<body class="bg-gray-50">
    @if(session('error'))
    <div class=" relative bg-red-200 text-red-700 w-fit p-4 rounded-md m-auto">
            <button class="absolute top-0 right-0 p-2" onclick="this.parentElement.style.display='none'">
                &times;
            </button>
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class=" relative bg-green-200 text-green-700 w-fit p-4 rounded-md m-auto">
            <button class="absolute top-0 right-0 p-2" onclick="this.parentElement.style.display='none'">
                &times;
            </button>
            {{ session('success') }}
        </div>
    @endif
    <div class="flex h-screen overflow-hidden">
        @include('partials.sidebar')

        {{ $slot }}
    </div>


    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('-translate-x-full');
        });

        document.getElementById('close-mobile-menu').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.add('-translate-x-full');
        });
    </script>
    {{ $script }} 
</body>
</html>


