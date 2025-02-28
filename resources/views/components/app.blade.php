<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SaveSmart | {{ $title ?? '' }}</title>

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 ">
            @include('partials.navigation')

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
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
