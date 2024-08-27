<!-- resources/views/products/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6">{{ $product->name }}</h1>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">製造者名:</label>
            <p class="text-lg">{{ $product->maker }}</p>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">分類:</label>
            <p class="text-lg">{{ $product->category }}</p>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">ステータス:</label>
            <p class="text-lg">{{ $product->status }}</p>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">備考:</label>
            <p class="text-lg">{{ $product->remarks }}</p>
        </div>

        @if($product->skus->isNotEmpty())
            <h2 class="text-2xl font-bold mb-4">SKU情報</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($product->skus as $sku)
                    <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold mb-2">SKU: {{ $sku->sku }}</h3>
                        <p><strong>SKU名:</strong> {{ $sku->name }}</p>
                        <p><strong>規格:</strong> {{ $sku->spec }}</p>
                        <p><strong>重量:</strong> {{ $sku->weight }} g</p>
                        <p><strong>消費税率:</strong> {{ $sku->tax_rate }}%</p>
                        <p><strong>原価:</strong> ¥{{ $sku->cost_price }}</p>
                        <p><strong>販売価格:</strong> ¥{{ $sku->sale_price }}</p>
                        <p><strong>在庫数:</strong> {{ $sku->stock }}</p>
                        <p><strong>ステータス:</strong> {{ $sku->status }}</p>
                        <p><strong>販売開始日:</strong> {{ $sku->start_date }}</p>
                        <p><strong>販売終了日:</strong> {{ $sku->end_date }}</p>
                        <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="sku_id" value="{{ $sku->id }}">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">数量:</label>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" class="block w-full mt-1 mb-2 p-2 border rounded-md">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">カートに追加</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
