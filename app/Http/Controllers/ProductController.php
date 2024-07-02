<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('skus')->get();
        return view('products.index', compact('products'));
    }
    
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'maker' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:20',
            'remarks' => 'nullable|string|max:1000',
        ]);
    
        $product = Product::create($validatedData);
    
        return redirect()->route('products.edit', $product->id)->with('success', '商品が登録されました。');
    }


    public function edit(Product $product)
    {
        $product->load('skus');
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'maker' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:20',
            'remarks' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $product->update($request->all());
        return redirect()->route('products.edit', $product->id)->with('success', '商品情報が更新されました');
        
    }
    
    public function list()
    {
        $products = Product::all();
        return view('products.list', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
    
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', '商品が削除されました');
    }
    
    public function storeSku(Request $request, $productId)
    {
        
        $validatedData = $request->validate([
            'sku' => 'required|string|max:50',
            'name' => 'nullable|string|max:100',
            'spec' => 'nullable|string|max:100',
            'weight' => 'nullable|numeric',
            'tax_rate' => 'nullable|integer',
            'cost_price' => 'nullable|integer',
            'sale_price' => 'nullable|integer',
            'stock' => 'nullable|integer',
            'status' => 'nullable|string|max:20',
        ]);

        $skuData = array_merge(['product_id' => $productId], $validatedData);

        $sku = ProductSku::create($skuData);

        return redirect()->route('products.edit', $productId)->with('success', 'SKU情報が登録されました。');
    }
    
    public function updateSku(Request $request, $productId, $skuId)
    {
        $validatedData = $request->validate([
            'sku' => 'required|string|max:50',
            'name' => 'nullable|string|max:100',
            'spec' => 'nullable|string|max:100',
            'weight' => 'nullable|numeric',
            'tax_rate' => 'nullable|integer',
            'cost_price' => 'nullable|integer',
            'sale_price' => 'nullable|integer',
            'stock' => 'nullable|integer',
            'status' => 'nullable|string|max:20',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);
        
        $sku = ProductSku::findOrFail($skuId);
        $sku->update($validatedData);
        
        return redirect()->route('products.edit', $productId)->with('success', 'SKU情報が更新されました。');
    }


    public function destroySku($skuId)
    {
        $sku = ProductSku::findOrFail($skuId);
        $productId = $sku->product_id;
        $sku->delete();

        return redirect()->route('products.edit', $productId)->with('success', 'SKU情報が削除されました。');
    }
    
}