<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Produktu pārvaldība' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="{{ route('product.index') }}">Produkti</a></li>
                <li><a href="{{ route('product.create') }}">Pievienot produktu</a></li>
            </ul>
        </nav>

        <main class="main-content">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
