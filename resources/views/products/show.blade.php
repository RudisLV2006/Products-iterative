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

        @if($product->tags->isNotEmpty())
    <div class="product-field">
        <strong>Tagi:</strong>
        <ul>
            @foreach($product->tags as $tag)
                <li>{{ $tag->name }}</li>
            @endforeach
        </ul>
    </div>
@else
    <div class="product-field">
        <strong>Tagi:</strong> Nav pievienoti tagi.
    </div>
@endif


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

<form id="addTagsForm" action="{{ route('product.addTags', $product->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="tags">Pievienot tagus:</label>
        <input type="text" name="tags" id="tags" class="form-control" placeholder="Ievadiet tagus, atdalot ar komatiem" />
        <small>Atdaliet tagus ar komatiem.</small>
    </div>
    <button type="submit" class="btn btn-primary">Pievienot tagus</button>
</form>



    </div>
</x-layout>
