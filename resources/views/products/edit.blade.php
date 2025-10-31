<x-layout title="Jauns produkts">
    <h1>Pievienot jaunu produktu</h1>

    <form action="{{ route('product.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label>Nosaukums:</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Quantity -->
        <div>
            <label>Daudzums:</label>
            <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
            @error('quantity')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label>Apraksts:</label>
            <textarea name="description">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Expiration Date -->
        <div>
            <label>Derīguma termiņš:</label>
            <input type="date" name="expiration_date" value="{{ old('expiration_date', $product->expiration_date->format('Y-m-d')) }}" required>
            @error('expiration_date')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Status -->
        <div>
            <label>Statuss:</label>
            <select name="status" required>
                <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Aktīvs</option>
                <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inaktīvs</option>
            </select>
            @error('status')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Saglabāt</button>
    </form>

</x-layout>
