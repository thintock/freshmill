<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\DeliveryAddress;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        $user = Auth::user();
        $addresses = $user->deliveryAddresses();
        $intent = $user->createSetupIntent();

        return view('checkout.index', compact('cart', 'total', 'user', 'addresses', 'intent'));
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'card_holder_name' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);
    
        $user = $request->user();
        $paymentMethod = $request->payment_method;
        $cart = Session::get('cart', []);
    
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'カートが空です。');
        }
    
        $amount = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
        
        try {
            // Stripe APIキーの設定
            Stripe::setApiKey(env('STRIPE_SECRET'));
            
            // PaymentIntentを作成
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'jpy',
                'payment_method' => $paymentMethod,
                'customer' => $user->stripe_id,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => route('checkout.index'),
                'metadata' => ['order_id' => uniqid()],
            ]);
            
            // PaymentIntentが成功したかどうかを確認
            if ($paymentIntent->status == 'requires_action' && $paymentIntent->next_action->type == 'use_stripe_sdk') {
                // リダイレクトを含む追加のアクションが必要
                return response()->json([
                    'requires_action' => true,
                    'payment_intent_client_secret' => $paymentIntent->client_secret,
                    'next_action' => $paymentIntent->next_action,
                ]);
            } elseif ($paymentIntent->status == 'succeeded') {
                // サブスクリプションを作成
                $user->newSubscription('default', 'your_product_id')  // ここはダミーのproduct_idを使うか、適切に処理してください
                     ->create($paymentMethod, [
                         'metadata' => ['order_id' => uniqid()],
                         'payment_behavior' => 'default_incomplete',
                     ]);
    
                // カートをクリア
                Session::forget('cart');
    
                return redirect()->route('dashboard')->with('success', 'サブスクリプションが作成されました。');
            } else {
                return back()->withErrors(['error' => '決済に失敗しました。もう一度お試しください。']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'サブスクリプションの作成に失敗しました: ' . $e->getMessage()]);
        }
    
    }
    public function complete(Request $request)
    {
        // 決済の結果を取得し、処理を行う
        $paymentIntentId = $request->input('payment_intent');
        $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

        if ($paymentIntent->status == 'succeeded') {
            // 支払い成功時の処理

            // ユーザー情報の取得
            $user = Auth::user();

            // カートの取得
            $cart = Session::get('cart', []);
            $amount = array_reduce($cart, function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);

            // サブスクリプションを作成
            $user->newSubscription('default', 'your_product_id')  // ここはダミーのproduct_idを使うか、適切に処理してください
                ->create($paymentIntent->payment_method, [
                    'metadata' => ['order_id' => uniqid()],
                ]);

            // カートをクリア
            Session::forget('cart');

            return redirect()->route('dashboard')->with('success', 'サブスクリプションが作成されました。');
        } else {
            return redirect()->route('checkout.index')->withErrors(['error' => '決済に失敗しました。もう一度お試しください。']);
        }
    }
}