@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">サブスクリプションの作成</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-4 rounded-lg mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="p-6 bg-white border-b border-gray-200">
            <h2>サブスクリプション</h2>
            <form id="payment-form" action="{{ route('subscription.store') }}" method="POST">
                @csrf
                <input id="card-holder-name" name="card_holder_name" type="text" placeholder="カード名義人" required>
                <input type="hidden" name="payment_method" id="payment-method">
                <div id="card-element"></div>
                <button id="card-button" data-secret="{{ $intent->client_secret }}">
                    サブスクリプション
                </button>
            </form>
        </div>
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
