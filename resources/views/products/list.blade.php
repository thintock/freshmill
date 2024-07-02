@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">商品一覧</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-700 mb-4">{{ $product->category }}</p>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">詳細を見る</a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
