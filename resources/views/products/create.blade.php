<x-layout title="Jauns produkts">
    <h1>Pievienot jaunu produktu</h1>

    <form action="{{ route('product.store') }}" method="POST">
        @csrf
        <div>
            <label>Nosaukums:</label>
            <input type="text" name="name">
        </div>

        <div>
            <label>Cena:</label>
            <input type="number" step="0.01" name="price">
        </div>

        <button type="submit">Saglabāt</button>
    </form>
</x-layout>
