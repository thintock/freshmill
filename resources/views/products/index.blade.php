@extends('layouts.app')

@section('admin-nav')
    @include('components.adminNav')
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-12">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h1>商品管理</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">新規商品登録</a>
        <table class="table">
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>メーカー</th>
                    <th>カテゴリ</th>
                    <th>ステータス</th>
                    <th>アクション</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->maker }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->status }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">編集</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
