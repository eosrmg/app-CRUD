<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class ProductController extends Controller
{
    public function read(){
        $products = Product::all();
        return Inertia::render('Dashboard', ['products' => $products]);
    }

    public function create(){
        return Inertia::render('CreateProduct');
        
    }

    public function store( Request $request){
        $data=$request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'nullable|string|max:1000',
        ]);

        Product::create($data);
        return redirect()->route('dashboard')->with('success', 'Product created successfully.');
    }


    public function edit(Product $product){
        return Inertia::render('CreateProduct', ['product' => $product]);
    }

    public function update(Request $request, Product $product){
        $data=$request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'nullable|string|max:1000',
        ]);

        $product->update($data);
        return redirect()->route('dashboard')->with('success', 'Product updated successfully.');
    }

  public function destroy(Product $product)
{
    $product->delete();
    return response()->json(['message' => 'Product deleted successfully']);
}

public function watchchange()
{
    $products = Product::all();  // Fetch all products
    return response()->json($products);  // Return products as JSON response
}


   
}
