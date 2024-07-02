<div id="sku-modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">SKU新規作成</h3>
        <form action="{{ route('products.skus.store', $product->id) }}" id="sku-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="new_sku" class="block text-sm font-medium text-gray-700">SKU</label>
                    <input type="text" id="new_sku" name="sku" class="input input-bordered w-full" required maxlength="50">
                </div>
                <div>
                    <label for="new_sku_name" class="block text-sm font-medium text-gray-700">SKU名</label>
                    <input type="text" id="new_sku_name" name="name" class="input input-bordered w-full">
                </div>
                <div>
                    <label for="new_sku_spec" class="block text-sm font-medium text-gray-700">規格</label>
                    <input type="text" id="new_sku_spec" name="spec" class="input input-bordered w-full">
                </div>
                <div>
                    <label for="new_sku_weight" class="block text-sm font-medium text-gray-700">重量</label>
                    <input type="number" step="0.01" id="new_sku_weight" name="weight" class="input input-bordered w-full">
                </div>
                <div>
                    <label for="new_sku_tax_rate" class="block text-sm font-medium text-gray-700">消費税率</label>
                    <input type="number" id="new_sku_tax_rate" name="tax_rate" class="input input-bordered w-full">
                </div>
                <div>
                    <label for="new_sku_cost_price" class="block text-sm font-medium text-gray-700">原価</label>
                    <input type="number" id="new_sku_cost_price" name="cost_price" class="input input-bordered w-full">
                </div>
                <div>
                    <label for="new_sku_sale_price" class="block text-sm font-medium text-gray-700">販売価格</label>
                    <input type="number" id="new_sku_sale_price" name="sale_price" class="input input-bordered w-full">
                </div>
                <div>
                    <label for="new_sku_stock" class="block text-sm font-medium text-gray-700">在庫数</label>
                    <input type="number" id="new_sku_stock" name="stock" class="input input-bordered w-full">
                </div>
                
                                    <label for="new_sku_status" class="block text-sm font-medium text-gray-700">SKUステータス</label>
                    <select id="new_sku_status" name="status" class="input input-bordered w-full">
                        <option value="販売中">販売中</option>
                        <option value="停止中">停止中</option>
                    </select>
                </div>
            </div>
            <div class="modal-action">
                <button type="submit" id="save-sku" class="btn btn-primary">保存</button>
                <button type="button" id="cancel-sku" class="btn">キャンセル</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('add-sku').addEventListener('click', function () {
        document.getElementById('sku-modal').classList.add('modal-open');
    });

    document.getElementById('cancel-sku').addEventListener('click', function () {
        document.getElementById('sku-modal').classList.remove('modal-open');
    });
</script>
