<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class SubscriptionController extends Controller
{
    public function create(Request $request)
    {
        $user = $request->user();
        $intent = $user->createSetupIntent();

        return view('subscription.create', compact('intent'));
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $paymentMethod = $request->payment_method;
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'カートが空です。');
        }

        $lineItems = array_map(function($item) {
            return [
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['price'] * 100, // 円をセンに変換
                ],
                'quantity' => $item['quantity'],
            ];
        }, $cart);

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $checkoutSession = StripeSession::create([
                'payment_method_types' => ['card'],
                'mode' => 'subscription',
                'customer_email' => $user->email,
                'line_items' => $lineItems,
                'success_url' => route('dashboard').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cart.index'),
            ]);

            return redirect()->away($checkoutSession->url);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'サブスクリプションの作成に失敗しました: ' . $e->getMessage()]);
        }
    }
}
