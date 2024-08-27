@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">ショッピングカート</h2>

        @if(count($cart))
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th>商品名</th>
                        <th>数量</th>
                        <th>価格</th>
                        <th>合計</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $skuId => $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>¥{{ number_format($item['price']) }}</td>
                            <td>¥{{ number_format($item['price'] * $item['quantity']) }}</td>
                            <td>
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="sku_id" value="{{ $skuId }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}">
                                    <button type="submit">更新</button>
                                </form>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="sku_id" value="{{ $skuId }}">
                                    <button type="submit">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                <h3>合計: ¥{{ number_format($total) }}</h3>
                <a href="{{ route('checkout.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    レジに進む
                </a>
            </div>
        @else
            <p>カートに商品がありません。</p>
        @endif
    </div>
</div>
@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value }
                }
            }
        );

        if (error) {
            console.error(error.message);
            alert('カード情報に誤りがあります。もう一度確認してください。');
        } else {
            document.getElementById('payment-method').value = setupIntent.payment_method;
            form.submit();
        }
    });
</script>
@endpush
@endsection
