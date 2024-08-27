@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">注文内容の確認とお客様情報の入力</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-4 rounded-lg mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="payment-form" action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">名前</label>
                    <input type="text" name="name" id="name" class="block w-full mt-1 p-2 border rounded-md" value="{{ $user->name }}" required>
                </div>
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">名</label>
                    <input type="text" name="first_name" id="first_name" class="block w-full mt-1 p-2 border rounded-md" value="{{ $user->first_name }}" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
                    <input type="email" name="email" id="email" class="block w-full mt-1 p-2 border rounded-md" value="{{ $user->email }}" required>
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">電話番号</label>
                    <input type="text" name="phone" id="phone" class="block w-full mt-1 p-2 border rounded-md" value="{{ $user->phone }}" required>
                </div>
                <div>
                    <label for="postal_code" class="block text-sm font-medium text-gray-700">郵便番号</label>
                    <input type="text" name="postal_code" id="postal_code" class="block w-full mt-1 p-2 border rounded-md" value="{{ $user->postal_code }}" required>
                </div>
                <div>
                    <label for="address1" class="block text-sm font-medium text-gray-700">住所1</label>
                    <input type="text" name="address1" id="address1" class="block w-full mt-1 p-2 border rounded-md" value="{{ $user->address1 }}" required>
                </div>
                <div>
                    <label for="address2" class="block text-sm font-medium text-gray-700">住所2</label>
                    <input type="text" name="address2" id="address2" class="block w-full mt-1 p-2 border rounded-md" value="{{ $user->address2 }}">
                </div>
                <div>
                    <label for="prefecture" class="block text-sm font-medium text-gray-700">都道府県</label>
                    <input type="text" name="prefecture" id="prefecture" class="block w-full mt-1 p-2 border rounded-md" value="{{ $user->prefecture }}" required>
                </div>
            </div>

            <div class="mt-4">
                <h3>合計: ¥{{ number_format($total) }}</h3>
            </div>

            <div class="p-6 bg-white border-b border-gray-200">
                <h2>決済情報</h2>
                <input id="card-holder-name" name="card_holder_name" type="text" placeholder="カード名義人" required>
                <input type="hidden" name="payment_method" id="payment-method">
                <div id="card-element"></div>
                <button id="card-button" data-secret="{{ $intent->client_secret }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    注文を確定して決済へ進む
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (event) => {
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
    });
</script>
@endpush
@endsection
