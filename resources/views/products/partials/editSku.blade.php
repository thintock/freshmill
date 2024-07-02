<div class="mb-6">
    <div role="tablist" class="tabs tabs-lifted">
        @foreach($product->skus as $index => $sku)
            <input type="radio" name="sku_tabs" role="tab" class="tab" aria-label="{{ $sku->name }}" id="tab-{{ $index }}" {{ $index == 0 ? 'checked' : '' }} />
            <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6 {{ $index == 0 ? 'block' : 'hidden' }}" id="panel-{{ $index }}">
                <form action="{{ route('products.updateSku', [$product->id, $sku->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h4 class="text-lg font-bold mb-4">SKU: {{ $sku->sku }}</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                            <input type="text" name="sku" class="input input-bordered w-full" value="{{ old('sku', $sku->sku) }}" required>
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">SKU名</label>
                            <input type="text" name="name" class="input input-bordered w-full" value="{{ old('name', $sku->name) }}">
                        </div>

                        <div>
                            <label for="spec" class="block text-sm font-medium text-gray-700">規格</label>
                            <input type="text" name="spec" class="input input-bordered w-full" value="{{ old('spec', $sku->spec) }}">
                        </div>

                        <div>
                            <label for="weight" class="block text-sm font-medium text-gray-700">重量</label>
                            <input type="number" step="0.01" name="weight" class="input input-bordered w-full" value="{{ old('weight', $sku->weight) }}">
                        </div>

                        <div>
                            <label for="tax_rate" class="block text-sm font-medium text-gray-700">消費税率</label>
                            <input type="number" name="tax_rate" class="input input-bordered w-full" value="{{ old('tax_rate', $sku->tax_rate) }}">
                        </div>

                        <div>
                            <label for="cost_price" class="block text-sm font-medium text-gray-700">原価</label>
                            <input type="number" name="cost_price" class="input input-bordered w-full" value="{{ old('cost_price', $sku->cost_price) }}">
                        </div>

                        <div>
                            <label for="sale_price" class="block text-sm font-medium text-gray-700">販売価格</label>
                            <input type="number" name="sale_price" class="input input-bordered w-full" value="{{ old('sale_price', $sku->sale_price) }}">
                        </div>

                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700">在庫数</label>
                            <input type="number" name="stock" class="input input-bordered w-full" value="{{ old('stock', $sku->stock) }}">
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">SKUステータス</label>
                            <select name="status" class="input input-bordered w-full">
                                <option value="販売中" {{ old('status', $sku->status) == '販売中' ? 'selected' : '' }}>販売中</option>
                                <option value="停止中" {{ old('status', $sku->status) == '停止中' ? 'selected' : '' }}>停止中</option>
                            </select>
                        </div>

                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">販売開始日</label>
                            <input type="date" name="start_date" class="input input-bordered w-full" value="{{ old('start_date', $sku->start_date) }}">
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">販売終了日</label>
                            <input type="date" name="end_date" class="input input-bordered w-full" value="{{ old('end_date', $sku->end_date) }}">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="submit" class="btn btn-primary">更新</button>
                        </form>
                        <form action="{{ route('products.destroySku', $sku->id) }}" method="POST" onsubmit="return confirm('本当にこのSKUを削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</div>
