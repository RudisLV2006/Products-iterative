<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Produktu pārvaldība' }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">    
</head>
<body>

    <!-- Navigācija -->
    <nav style="background: #f5f5f5; padding: 1em;">
        <a href="{{ route('product.index') }}">Produkti</a> |
        <a href="{{ route('product.create') }}">Pievienot produktu</a>
    </nav>

    <main style="padding: 2em;">
        {{ $slot }}
    </main>
</body>
</html>
