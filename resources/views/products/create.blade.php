<x-layout title="Jauns produkts">
    <h1>Pievienot jaunu produktu</h1>

    <form action="{{ route('product.store') }}" method="POST">
        @csrf
        <div>
            <label>Nosaukums:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label>Daudzums:</label>
            <input type="number" step="0.01" name="quantity" value="{{ old('quantity') }}" required>
            @error('quantity')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label>Apraksts:</label>
            <input type="text" name="description" value="{{ old('description') }}">
            @error('description')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label>Derīguma termiņš:</label>
            <input type="date" name="expiration_date" value="{{ old('expiration_date') }}" required>
            @error('expiration_date')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <label>Statuss:</label>
            <select name="status" required>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktīvs</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inaktīvs</option>
            </select>
            @error('status')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit">Saglabāt</button>
    </form>
</x-layout>
