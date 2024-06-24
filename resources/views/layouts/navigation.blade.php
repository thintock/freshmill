<nav x-data="{ open: false }" class="bg-white shadow-md">
    <!-- プライマリナビゲーションメニュー -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- ロゴマーク -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('top') }}">
                        <img src="{{ asset('images/logos/bakerista_logo_200px.png') }}" class="block h-8 w-auto" alt="Logo" />
                    </a>
                </div>

                <!-- ナビゲーションリンク -->
                <div class="hidden sm:flex sm:items-center sm:ml-10 space-x-8">
                    <a href="{{ route('dashboard') }}" class="font-semibold text-base leading-5 {{ request()->routeIs('dashboard') ? 'border-b-2 border-indigo-500' : 'hover:text-gray-400 hover:border-gray-300' }} focus:outline-none transition duration-150 ease-in-out">
                        マイページ
                    </a>
                </div>
            </div>

            @auth
            <!-- 設定ドロップダウン -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="flex items-center space-x-4">
                    <div class="font-semibold text-base leading-4">
                        {{ Auth::user()->name }} {{ Auth::user()->first_name }} 様
                    </div>
                    
                    <a href="{{ route('profile.edit') }}" class="font-semibold text-base leading-4 hover:text-gray-700">
                        プロフィール
                    </a>
            
                    <!-- 認証 -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="font-semibold text-base leading-4 hover:text-gray-700">
                            ログアウト
                        </button>
                    </form>
                </div>
            </div>
            @endauth

            @guest
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <a href="{{ route('login') }}" class="font-semibold text-base leading-4 hover:text-gray-700">
                    ログイン
                </a>
                <a href="{{ route('register') }}" class="ml-4 font-semibold text-base leading-4 hover:text-gray-700">
                    新規登録
                </a>
            </div>
            @endguest

            <!-- ハンバーガー -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- レスポンシブナビゲーションメニュー -->
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('dashboard') ? 'border-indigo-400 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                マイページ
            </a>
        </div>

        <!-- レスポンシブ設定メニュー -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }} {{ Auth::user()->first_name }} 様</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                    プロフィール
                </a>

                <!-- 認証 -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out" onclick="event.preventDefault(); this.closest('form').submit();">
                        ログアウト
                    </a>
                </form>
            </div>
            @endauth

            @guest
            <div class="px-4">
                <a href="{{ route('login') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                    ログイン
                </a>
                <a href="{{ route('register') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                    新規登録
                </a>
            </div>
            @endguest
        </div>
    </div>
</nav>
