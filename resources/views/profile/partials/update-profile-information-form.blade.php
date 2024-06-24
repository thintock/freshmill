<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('お客様情報') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("お客様情報を更新できます。") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- 姓 -->
        <div>
            <x-input-label for="name" :value="__('姓')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- 名 -->
        <div>
            <x-input-label for="first_name" :value="__('名')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <!-- セイ -->
        <div>
            <x-input-label for="last_name_kana" :value="__('セイ')" />
            <x-text-input id="last_name_kana" name="last_name_kana" type="text" class="mt-1 block w-full" :value="old('last_name_kana', $user->last_name_kana)" required autocomplete="last_name_kana" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name_kana')" />
        </div>

        <!-- メイ -->
        <div>
            <x-input-label for="first_name_kana" :value="__('メイ')" />
            <x-text-input id="first_name_kana" name="first_name_kana" type="text" class="mt-1 block w-full" :value="old('first_name_kana', $user->first_name_kana)" required autocomplete="first_name_kana" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name_kana')" />
        </div>

        <!-- Company Name -->
        <div>
            <x-input-label for="company_name" :value="__('会社名')" />
            <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full" :value="old('company_name', $user->company_name)" autocomplete="company_name" />
            <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
        </div>

        <!-- Postal Code -->
        <div>
            <x-input-label for="postal_code" :value="__('郵便番号')" />
            <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" :value="old('postal_code', $user->postal_code)" required autocomplete="postal_code" />
            <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
        </div>

        <!-- Prefecture -->
        <div>
            <x-input-label for="prefecture" :value="__('都道府県')" />
            <x-text-input id="prefecture" name="prefecture" type="text" class="mt-1 block w-full" :value="old('prefecture', $user->prefecture)" required autocomplete="prefecture" />
            <x-input-error class="mt-2" :messages="$errors->get('prefecture')" />
        </div>

        <!-- Address 1 -->
        <div>
            <x-input-label for="address1" :value="__('住所')" />
            <x-text-input id="address1" name="address1" type="text" class="mt-1 block w-full" :value="old('address1', $user->address1)" required autocomplete="address1" />
            <x-input-error class="mt-2" :messages="$errors->get('address1')" />
        </div>

        <!-- Address 2 -->
        <div>
            <x-input-label for="address2" :value="__('建物名')" />
            <x-text-input id="address2" name="address2" type="text" class="mt-1 block w-full" :value="old('address2', $user->address2)" autocomplete="address2" />
            <x-input-error class="mt-2" :messages="$errors->get('address2')" />
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('電話番号')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" required autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>
        
        <!-- email -->
        <div>
            <x-input-label for="email" :value="__('Eメール')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        
        <!-- User Type -->
        <div>
            <x-input-label for="user_type" :value="__('ユーザー区分')" />
            <select id="user_type" name="user_type" class="mt-1 block w-full" required>
                <option value="personal" {{ old('user_type', $user->user_type) == 'personal' ? 'selected' : '' }}>{{ __('個人') }}</option>
                <option value="corporate" {{ old('user_type', $user->user_type) == 'corporate' ? 'selected' : '' }}>{{ __('法人(個人事業主)') }}</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('user_type')" />
        </div>
        
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('更新') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('保存しました。') }}</p>
            @endif
        </div>
    </form>
</section>
