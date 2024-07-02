<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white p-4 rounded-lg shadow-md">
            <div role="tablist" class="tabs tabs-boxed">
                <a href="{{ route('products.index') }}" role="tab" class="tab {{ request()->routeIs('products.index') ? 'tab-active' : '' }}">商品管理</a>
                <a href="#" role="tab" class="tab {{ request()->routeIs('orders.index') ? 'tab-active' : '' }}">注文管理</a>
                <a href="#" role="tab" class="tab {{ request()->routeIs('users.index') ? 'tab-active' : '' }}">ユーザー管理</a>
                <a href="#" role="tab" class="tab {{ request()->routeIs('subscriptions.index') ? 'tab-active' : '' }}">サブスクリプション管理</a>
            </div>
        </div>
    </div>
</div>
