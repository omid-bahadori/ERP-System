<!DOCTYPE html>
<html lang="fa" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name'))</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light py-5">
            <div class="w-100" style="max-width: 400px;">
                <div class="text-center mb-4">
                    <a href="/" class="text-decoration-none">
                        <h3 class="text-primary fw-bold">
                            <i class="bi bi-box-seam me-2"></i>
                            {{ config('app.name') }}
                        </h3>
                    </a>
                </div>
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
