@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">姓</label>
                <input id="name" class="block mt-1 w-full form-input rounded-md shadow-sm" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- First Name -->
            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium text-gray-700">名</label>
                <input id="first_name" class="block mt-1 w-full form-input rounded-md shadow-sm" type="text" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name">
                @error('first_name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Last Name Kana -->
            <div class="mb-4">
                <label for="last_name_kana" class="block text-sm font-medium text-gray-700">セイ</label>
                <input id="last_name_kana" class="block mt-1 w-full form-input rounded-md shadow-sm" type="text" name="last_name_kana" value="{{ old('last_name_kana') }}" required autocomplete="last_name_kana">
                @error('last_name_kana')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- First Name Kana -->
            <div class="mb-4">
                <label for="first_name_kana" class="block text-sm font-medium text-gray-700">メイ</label>
                <input id="first_name_kana" class="block mt-1 w-full form-input rounded-md shadow-sm" type="text" name="first_name_kana" value="{{ old('first_name_kana') }}" required autocomplete="first_name_kana">
                @error('first_name_kana')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Company Name -->
            <div class="mb-4">
                <label for="company_name" class="block text-sm font-medium text-gray-700">会社名</label>
                <input id="company_name" class="block mt-1 w-full form-input rounded-md shadow-sm" type="text" name="company_name" value="{{ old('company_name') }}" autocomplete="company_name">
                @error('company_name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Postal Code -->
            <div class="mb-4">
                <label for="postal_code" class="block text-sm font-medium text-gray-700">郵便番号</label>
                <input id="postal_code" class="block mt-1 w-full form-input rounded-md shadow-sm" type="text" name="postal_code" value="{{ old('postal_code') }}" required autocomplete="postal_code">
                @error('postal_code')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Prefecture -->
            <div class="mb-4">
                <label for="prefecture" class="block text-sm font-medium text-gray-700">都道府県</label>
                <input id="prefecture" class="block mt-1 w-full form-input rounded-md shadow-sm" type="text" name="prefecture" value="{{ old('prefecture') }}" required autocomplete="prefecture">
                @error('prefecture')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address 1 -->
            <div class="mb-4">
                <label for="address1" class="block text-sm font-medium text-gray-700">住所</label>
                <input id="address1" class="block mt-1 w-full form-input rounded-md shadow-sm" type="text" name="address1" value="{{ old('address1') }}" required autocomplete="address1">
                @error('address1')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address 2 -->
            <div class="mb-4">
                <label for="address2" class="block text-sm font-medium text-gray-700">建物名</label>
                <input id="address2" class="block mt-1 w-full form-input rounded-md shadow-sm" type="text" name="address2" value="{{ old('address2') }}" autocomplete="address2">
                @error('address2')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">電話番号</label>
                <input id="phone" class="block mt-1 w-full form-input rounded-md shadow-sm" type="text" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                @error('phone')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Eメール</label>
                <input id="email" class="block mt-1 w-full form-input rounded-md shadow-sm" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">パスワード</label>
                <input id="password" class="block mt-1 w-full form-input rounded-md shadow-sm" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">パスワード確認</label>
                <input id="password_confirmation" class="block mt-1 w-full form-input rounded-md shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- User Type -->
            <div class="mb-4">
                <label for="user_type" class="block text-sm font-medium text-gray-700">ユーザー区分</label>
                <select id="user_type" name="user_type" class="block mt-1 w-full form-select rounded-md shadow-sm" required>
                    <option value="personal" {{ old('user_type') == 'personal' ? 'selected' : '' }}>個人</option>
                    <option value="corporate" {{ old('user_type') == 'corporate' ? 'selected' : '' }}>法人(個人事業主)</option>
                </select>
                @error('user_type')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    すでに登録済みですか？
                </a>

                <button type="submit" class="ml-4 btn btn-primary">
                    登録
                </button>
            </div>
        </form>
    </div>
@endsection
