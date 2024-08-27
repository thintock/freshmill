<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductSku;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Stripeのセットアップインテントを作成
        $user = auth()->user();
        $intent = $user->createSetupIntent();

        return view('cart.index', compact('cart', 'total', 'intent'));
    }

    public function add(Request $request)
    {
        $skuId = $request->sku_id;
        $quantity = $request->quantity;

        $sku = ProductSku::find($skuId);
        $cart = Session::get('cart', []);

        if (isset($cart[$skuId])) {
            $cart[$skuId]['quantity'] += $quantity;
        } else {
            $cart[$skuId] = [
                'name' => $sku->name,
                'price' => $sku->sale_price,
                'quantity' => $quantity,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index');
    }

    public function update(Request $request)
    {
        $skuId = $request->sku_id;
        $quantity = $request->quantity;

        $cart = Session::get('cart', []);

        if (isset($cart[$skuId])) {
            $cart[$skuId]['quantity'] = $quantity;
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    public function remove(Request $request)
    {
        $skuId = $request->sku_id;

        $cart = Session::get('cart', []);

        if (isset($cart[$skuId])) {
            unset($cart[$skuId]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }
}
