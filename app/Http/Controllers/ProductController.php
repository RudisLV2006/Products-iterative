<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view("products.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("products.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'expiration_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        Product::create($validation);

        session()->flash("success", "Produkts veiksmīgi pievienots!");

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view("products.show", compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        
        return view("products.edit", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validation = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'expiration_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $product->update($validation);

        session()->flash("success", "Produkts veiksmīgi atjaunots!");

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        session()->flash("success", "Produkts veiksmīgi izdzēsts!");

        return redirect()->route('product.index');
    }

public function updateQuantity(Request $request, $id)
{
    // Atrodam produktu
    $product = Product::findOrFail($id);
    $action = $request->input('action');

    // Apstrādājam darbības
    if ($action === 'increase') {
        $product->increaseQuantity(); // Izmanto metodi, lai palielinātu daudzumu
    } elseif ($action === 'decrease') {
        $product->decreaseQuantity(); // Izmanto metodi, lai samazinātu daudzumu
    }
    
    // Atgriežam JSON atbildi ar jauniem datiem (piemēram, jauns daudzums)
    return response()->json([
        'quantity' => $product->quantity,  // Jaunais daudzums
        'success' => true
    ]);
}


}
