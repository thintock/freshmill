<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\Auth;

class DeliveryAddressController extends Controller
{
    /**
     * 新しい配送先住所を保存する
     */
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'da_first_name' => 'required|string|max:50',
            'da_last_name' => 'required|string|max:50',
            'da_first_kana' => 'required|string|max:50',
            'da_last_kana' => 'required|string|max:50',
            'da_com_name' => 'nullable|string|max:50',
            'da_postal_code' => 'required|string|max:10',
            'da_prefecture' => 'required|string|max:50',
            'da_address1' => 'required|string|max:100',
            'da_address2' => 'nullable|string|max:100',
            'da_phone_number' => 'required|string|max:20',
            'is_default' => 'nullable|boolean',
        ]);

        // 配送先住所を作成
        $validated['user_id'] = Auth::id();
        DeliveryAddress::create($validated);

        // 成功メッセージと共にリダイレクト
        return redirect()->route('profile.edit')->with('status', 'address-updated');
    }
    /**
     * ユーザーの配送先住所を取得する
     */
    public function getUserAddresses()
    {
        $addresses = DeliveryAddress::where('user_id', Auth::id())->get();
        return response()->json($addresses);
    }
}
