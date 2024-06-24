@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10">
        <div class="mb-4 text-sm text-gray-600">
            <h2 class="font-bold text-lg">パスワード再登録</h2>
            <p class="mt-2">
                登録されたメールアドレスをお知らせいただければ、パスワード再登録のご案内をお送りします。<br>
                下記のフォームにメールアドレスを入力してください。パスワード再登録のリンクが記載されたメールが届きます。<br>
                メールに記載されたリンクをクリックし、新しいパスワードを登録してください。
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block font-medium text-sm text-gray-700">メールアドレス</label>
                <input id="email" class="block mt-1 w-full p-2 border border-gray-300 rounded-md" type="email" name="email" value="{{ old('email') }}" required autofocus />
                @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                    パスワード再登録のご案内を送信
                </button>
            </div>
        </form>
    </div>
@endsection
