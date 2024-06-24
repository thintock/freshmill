@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10">
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Eメール</label>
                <input id="email" class="block mt-1 w-full form-input rounded-md shadow-sm" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">パスワード</label>
                <input id="password" class="block mt-1 w-full form-input rounded-md shadow-sm" type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="block mb-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">ログインを記憶</span>
                </label>
            </div>

            <div class="flex items-center justify-end mb-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        パスワードをお忘れですか？
                    </a>
                @endif

                <button type="submit" class="ml-3 btn btn-primary">
                    ログイン
                </button>
            </div>
        </form>
    </div>
@endsection
