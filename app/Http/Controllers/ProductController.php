<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'colors'])->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        return view('products.create', compact('categories', 'colors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'colors' => 'nullable|array',
            'colors.*' => 'exists:colors,id',
        ]);

        $product = Product::create($request->only('name', 'description', 'price', 'category_id'));

        if ($request->has('colors')) {
            $product->colors()->sync($request->colors);
        }

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'colors']);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::with('colors')->findOrFail($id);
        $categories = Category::all();
        $colors = Color::all();
        return view('products.edit', compact('product', 'categories', 'colors'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'colors' => 'nullable|array',
            'colors.*' => 'exists:colors,id',
        ]);

        $product->update($request->only('name', 'description', 'price', 'category_id'));

        if ($request->has('colors')) {
            $product->colors()->sync($request->colors);
        } else {
            $product->colors()->sync([]); // makni sve ako nema boja
        }

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
