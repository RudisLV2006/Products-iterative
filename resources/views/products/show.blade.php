<x-layout title="Produkta informācija">
    <div class="product-show">
        <h1>{{ $product->name }}</h1>

        <div class="product-field">
            <strong>Daudzums:</strong> {{ $product->quantity }}
        </div>

        <div class="product-field">
            <strong>Apraksts:</strong>
            <p>{{ $product->description }}</p>
        </div>

        <div class="product-field">
            <strong>Derīguma termiņš:</strong> {{ $product->expiration_date->format('Y-m-d') }}
        </div>

        <div class="product-field">
            <strong>Statuss:</strong> {{ ucfirst($product->status) }}
        </div>

        <div class="product-actions">
            <a href="{{ route('product.edit', $product->id) }}" class="button">Rediģēt</a>
            <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Vai tiešām dzēst?')">Dzēst</button>
            </form>
            <a href="{{ route('product.index') }}" class="button">Atpakaļ uz sarakstu</a>
        </div>
    </div>
</x-layout>
