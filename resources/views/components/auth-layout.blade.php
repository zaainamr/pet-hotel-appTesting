<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            
            .gradient-bg {
                background: linear-gradient(to bottom right, #fdf2f8, #fef9c3);
            }
            
            .gradient-button {
                background: linear-gradient(90deg, #FFE489 0%, #FFB6C9 100%);
                transition: all 0.3s ease;
            }
            
            .gradient-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(255, 182, 201, 0.3);
            }
            
            .input-field {
                transition: all 0.3s ease;
            }
            
            .input-field:focus {
                border-color: #FFB6C9;
                box-shadow: 0 0 0 3px rgba(255, 182, 201, 0.1);
            }
            
            .toggle-button {
                transition: all 0.3s ease;
            }
            
            .toggle-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            }
            
            .pet-image {
                border-radius: 24px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            }
            
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            
            .float-animation {
                animation: float 3s ease-in-out infinite;
            }
        </style>
    </head>
    <body class="antialiased">
        {{ $slot }}
        @stack('scripts')
    </body>
</html>
