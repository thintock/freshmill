@extends('layouts.app')

@section('admin-nav')
    @include('components.adminNav')
@endsection

@section('content')

<div class="max-w-7xl mx-auto py-12">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">ユーザーの権限を編集します。</h2>

        <form action="{{ route('profile.06dcb1f31edd373e5f8a99ad7f76129a74e408e7') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">役割:</label>
                <select name="role" id="role" class="select select-bordered w-full">
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn btn-primary">役割を変更</button>
            </div>
        </form>
    </div>
</div>

@endsection
