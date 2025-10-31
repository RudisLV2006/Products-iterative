<x-layout title="Produktu saraksts">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1>Produktu saraksts</h1>
</x-layout>
