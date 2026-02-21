<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->get();
        return view('master.products.index', compact('products'));
    }

    public function create()
    {
        return view('master.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|unique:products,sku',
            'name' => 'required|max:255',
            'unit' => 'required|max:20',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create($request->all());
        return redirect()->route('master.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        return view('master.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('master.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'sku' => 'required|unique:products,sku,' . $product->id,
            'name' => 'required|max:255',
            'unit' => 'required|max:20',
            'price' => 'required|numeric|min:0',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $product->update($data);

        return redirect()->route('master.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->route('master.products.index')->with('success', 'Produk berhasil dihapus.');
        }
        catch (\Exception $e) {
            return redirect()->route('master.products.index')->with('error', 'Produk tidak dapat dihapus.');
        }
    }
}
