@extends('layouts.app')

@section('admin-nav')
    @include('components.adminNav')
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-12">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">商品編集</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-4 rounded-lg mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Product Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">商品名</label>
                    <input type="text" name="name" id="name" class="input input-bordered w-full" value="{{ old('name', $product->name) }}" required maxlength="100">
                </div>

                <div>
                    <label for="maker" class="block text-sm font-medium text-gray-700">製造者名</label>
                    <input type="text" name="maker" id="maker" class="input input-bordered w-full" value="{{ old('maker', $product->maker) }}" maxlength="100">
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">分類</label>
                    <input type="text" name="category" id="category" class="input input-bordered w-full" value="{{ old('category', $product->category) }}" maxlength="50">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">ステータス</label>
                    <select name="status" id="status" class="input input-bordered w-full">
                        <option value="販売中" {{ old('status', $product->status) == '販売中' ? 'selected' : '' }}>販売中</option>
                        <option value="停止中" {{ old('status', $product->status) == '停止中' ? 'selected' : '' }}>停止中</option>
                    </select>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="remarks" class="block text-sm font-medium text-gray-700">備考</label>
                    <textarea name="remarks" id="remarks" class="textarea textarea-bordered w-full" rows="3" maxlength="1000">{{ old('remarks', $product->remarks) }}</textarea>
                </div>

            </div>
            
            <div class="flex justify-between">
                <button type="button" id="add-sku" class="btn btn-outline btn-primary">SKU新規作成</button>
                <button type="submit" class="btn btn-primary">更新</button>
            </div>
        </form>
            
            <h3 class="text-xl font-semibold mb-4">SKU情報</h3>

            @if($product->skus->isEmpty())
                <div class="mb-6">
                    <p class="text-gray-700">SKUが登録されていません。</p>
                </div>
            @else
                @include('products.partials.editSku')
            @endif
            
    </div>
</div>

<!-- SKU新規作成モーダル -->
@include('products.partials.createSku')

@endsection
