<x-layout title="Produktu saraksts">

    <x-flash-message />
    
    <h1>Produktu saraksts</h1>

    <table class="product-table">
        <thead>
            <tr>
                <th>Nosaukums</th>
                <th>Daudzums</th>
                <th>Apraksts</th>
                <th>Derīguma termiņš</th>
                <th>Statuss</th>
                <th>Darbības</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ Str::limit($product->description, 50) }}</td>
                    <td>{{ $product->expiration_date->format('Y-m-d') }}</td>
                    <td>{{ ucfirst($product->status) }}</td>
                    <td>
                        <a href="{{ route('product.show', $product->id) }}">Apskatīt</a>
                        <a href="{{ route('product.edit', $product->id) }}">Rediģēt</a>
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Vai tiešām dzēst?')">Dzēst</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
