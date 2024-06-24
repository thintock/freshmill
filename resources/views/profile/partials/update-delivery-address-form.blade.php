<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('配送先住所') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("新しい配送先住所を登録できます。") }}
        </p>
    </header>

    <div x-data="addressForm()">
        <!-- 既存の配送先住所を選択 -->
        <div>
            <x-input-label for="existing_addresses" :value="__('既存の配送先住所')" />
            <select id="existing_addresses" name="existing_addresses" class="mt-1 block w-full" x-model="selectedAddress" @change="loadAddress">
                <option value="">{{ __('住所を選択してください') }}</option>
                <template x-for="address in addresses" :key="address.id">
                    <option :value="address.id" x-text="`${address.da_last_name} ${address.da_first_name} (${address.da_postal_code})`"></option>
                </template>
            </select>
        </div>

        <!-- 新規配送先住所フォーム -->
        <form method="post" action="{{ route('delivery-address.store') }}" class="mt-6 space-y-6">
            @csrf

            <!-- 配送先の名前 -->
            <div>
                <x-input-label for="da_first_name" :value="__('名')" />
                <x-text-input id="da_first_name" name="da_first_name" type="text" class="mt-1 block w-full" x-model="form.da_first_name" required autocomplete="da_first_name" />
                <x-input-error class="mt-2" :messages="$errors->get('da_first_name')" />
            </div>

            <div>
                <x-input-label for="da_last_name" :value="__('姓')" />
                <x-text-input id="da_last_name" name="da_last_name" type="text" class="mt-1 block w-full" x-model="form.da_last_name" required autocomplete="da_last_name" />
                <x-input-error class="mt-2" :messages="$errors->get('da_last_name')" />
            </div>

            <!-- 配送先のセイ -->
            <div>
                <x-input-label for="da_first_kana" :value="__('メイ')" />
                <x-text-input id="da_first_kana" name="da_first_kana" type="text" class="mt-1 block w-full" x-model="form.da_first_kana" required autocomplete="da_first_kana" />
                <x-input-error class="mt-2" :messages="$errors->get('da_first_kana')" />
            </div>

            <div>
                <x-input-label for="da_last_kana" :value="__('セイ')" />
                <x-text-input id="da_last_kana" name="da_last_kana" type="text" class="mt-1 block w-full" x-model="form.da_last_kana" required autocomplete="da_last_kana" />
                <x-input-error class="mt-2" :messages="$errors->get('da_last_kana')" />
            </div>

            <!-- 配送先の会社名 -->
            <div>
                <x-input-label for="da_com_name" :value="__('会社名')" />
                <x-text-input id="da_com_name" name="da_com_name" type="text" class="mt-1 block w-full" x-model="form.da_com_name" autocomplete="da_com_name" />
                <x-input-error class="mt-2" :messages="$errors->get('da_com_name')" />
            </div>

            <!-- 配送先の郵便番号 -->
            <div>
                <x-input-label for="da_postal_code" :value="__('郵便番号')" />
                <x-text-input id="da_postal_code" name="da_postal_code" type="text" class="mt-1 block w-full" x-model="form.da_postal_code" required autocomplete="da_postal_code" />
                <x-input-error class="mt-2" :messages="$errors->get('da_postal_code')" />
            </div>

            <!-- 配送先の都道府県 -->
            <div>
                <x-input-label for="da_prefecture" :value="__('都道府県')" />
                <x-text-input id="da_prefecture" name="da_prefecture" type="text" class="mt-1 block w-full" x-model="form.da_prefecture" required autocomplete="da_prefecture" />
                <x-input-error class="mt-2" :messages="$errors->get('da_prefecture')" />
            </div>

            <!-- 配送先の住所 -->
            <div>
                <x-input-label for="da_address1" :value="__('住所')" />
                <x-text-input id="da_address1" name="da_address1" type="text" class="mt-1 block w-full" x-model="form.da_address1" required autocomplete="da_address1" />
                <x-input-error class="mt-2" :messages="$errors->get('da_address1')" />
            </div>

            <!-- 配送先の建物名 -->
            <div>
                <x-input-label for="da_address2" :value="__('建物名')" />
                <x-text-input id="da_address2" name="da_address2" type="text" class="mt-1 block w-full" x-model="form.da_address2" autocomplete="da_address2" />
                <x-input-error class="mt-2" :messages="$errors->get('da_address2')" />
            </div>

            <!-- 配送先の電話番号 -->
            <div>
                <x-input-label for="da_phone_number" :value="__('電話番号')" />
                <x-text-input id="da_phone_number" name="da_phone_number" type="text" class="mt-1 block w-full" x-model="form.da_phone_number" required autocomplete="da_phone_number" />
                <x-input-error class="mt-2" :messages="$errors->get('da_phone_number')" />
            </div>

            <!-- デフォルトの配送先 -->
            <div class="flex items-center">
                <x-input-label for="is_default" :value="__('デフォルトの配送先に設定')" />
                <input id="is_default" name="is_default" type="checkbox" class="mt-1 block ml-2" x-model="form.is_default">
                <x-input-error class="mt-2" :messages="$errors->get('is_default')" />
            </div>

            <!-- ボタン -->
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('登録') }}</x-primary-button>
                <button type="button" @click="copyUserInfo" class="ml-4 text-sm font-medium text-gray-700 hover:text-gray-500">
                    {{ __('お客様情報をコピー') }}
                </button>
            </div>

            <!-- 登録完了メッセージ -->
            @if (session('status') === 'address-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('保存しました。') }}</p>
            @endif
        </form>
    </div>
</section>

<script>
    function addressForm() {
        return {
            addresses: [],
            selectedAddress: '',
            form: {
                da_first_name: '',
                da_last_name: '',
                da_first_kana: '',
                da_last_kana: '',
                da_com_name: '',
                da_postal_code: '',
                da_prefecture: '',
                da_address1: '',
                da_address2: '',
                da_phone_number: '',
                is_default: false,
            },
            loadAddress() {
                if (this.selectedAddress) {
                    const address = this.addresses.find(addr => addr.id === parseInt(this.selectedAddress));
                    if (address) {
                        this.form = {
                            da_first_name: address.da_first_name,
                            da_last_name: address.da_last_name,
                            da_first_kana: address.da_first_kana,
                            da_last_kana: address.da_last_kana,
                            da_com_name: address.da_com_name,
                            da_postal_code: address.da_postal_code,
                            da_prefecture: address.da_prefecture,
                            da_address1: address.da_address1,
                            da_address2: address.da_address2,
                            da_phone_number: address.da_phone_number,
                            is_default: address.is_default,
                        };
                    }
                } else {
                    this.resetForm();
                }
            },
            copyUserInfo() {
                this.form = {
                    da_first_name: '{{ Auth::user()->first_name }}',
                    da_last_name: '{{ Auth::user()->name }}',
                    da_first_kana: '{{ Auth::user()->first_name_kana }}',
                    da_last_kana: '{{ Auth::user()->last_name_kana }}',
                    da_com_name: '{{ Auth::user()->company_name }}',
                    da_postal_code: '{{ Auth::user()->postal_code }}',
                    da_prefecture: '{{ Auth::user()->prefecture }}',
                    da_address1: '{{ Auth::user()->address1 }}',
                    da_address2: '{{ Auth::user()->address2 }}',
                    da_phone_number: '{{ Auth::user()->phone }}',
                    is_default: false,
                };
            },
            resetForm() {
                this.form = {
                    da_first_name: '',
                    da_last_name: '',
                    da_first_kana: '',
                    da_last_kana: '',
                    da_com_name: '',
                    da_postal_code: '',
                    da_prefecture: '',
                    da_address1: '',
                    da_address2: '',
                    da_phone_number: '',
                    is_default: false,
                };
            },
            init() {
                fetch('{{ route('delivery-addresses') }}')
                    .then(response => response.json())
                    .then(data => {
                        this.addresses = data;
                    });
            }
        };
    }
</script>
