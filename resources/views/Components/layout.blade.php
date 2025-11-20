<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Produktu pārvaldība' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="header">
            <a href="/">
                <img src="{{ $logo ?? 'https://www.getautismactive.com/wp-content/uploads/2021/01/Test-Logo-Circle-black-transparent.png' }}" alt="Logo">
            </a>
    </header>

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

        <aside class="ads">
            <p>Jūsu reklāmas teksts šeit</p>
        </aside>

        <footer class="footer">
            &copy; {{ date('Y') }} Jūsu uzņēmums. Visas tiesības aizsargātas.
        </footer>
    </div>
</body>
</html>
