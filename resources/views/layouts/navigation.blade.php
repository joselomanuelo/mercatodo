<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-2">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route(App\Constants\RouteNames::DASHBOARD) }}">
                        <img
                            src="{{ asset('images/logo.png') }}" 
                            alt="MercaTodo logo"
                            width="150"
                        />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @auth
                        <x-nav-link :href="route(App\Constants\RouteNames::DASHBOARD)" :active="request()->routeIs(App\Constants\RouteNames::DASHBOARD)">
                            {{ __(trans('navigation.dashboard')) }}
                        </x-nav-link>
                        <x-nav-link :href="route(App\Constants\RouteNames::BUYER_INDEX_ORDERS)" :active="request()->routeIs(App\Constants\RouteNames::BUYER_INDEX_ORDERS)">
                            {{ __('Ordenes') }}
                        </x-nav-link>
                    @endauth
                    
                                        
                    @can (App\Constants\Permissions::INDEX_USERS)
                        <x-nav-link :href="App\Models\User::indexRoute()" :active="request()->routeIs(App\Constants\RouteNames::INDEX_USERS)">
                            {{ __(trans('navigation.users')) }}
                        </x-nav-link>
                    @endcan
                    @can(App\Constants\Permissions::INDEX_PRODUCTS)
                        <x-nav-link :href="App\Models\Product::indexRoute()" :active="request()->routeIs(App\Constants\RouteNames::INDEX_PRODUCTS)">
                            {{ __(trans('navigation.products')) }}
                        </x-nav-link>
                    @endcan
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ auth()->user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route(App\Constants\RouteNames::LOGOUT) }}">
                                @csrf

                                <x-dropdown-link :href="route(App\Constants\RouteNames::LOGOUT)"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __(trans('buttons.logOut')) }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
                @guest
                    <div>
                        <x-button-link class="ml-4" href="{{ route(App\Constants\RouteNames::LOGIN) }}">
                            {{ __(trans('buttons.logIn')) }}
                        </x-button-link>
                    </div>
                    <div>
                        <x-button-link class="ml-4" href="{{ route(App\Constants\RouteNames::REGISTER   ) }}">
                            {{ __(trans('buttons.signUp')) }}
                        </x-button-link>
                    </div>
                @endguest
            </div>

            <!-- Hamburger -->
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

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route(App\Constants\RouteNames::DASHBOARD)" :active="request()->routeIs(App\Constants\RouteNames::DASHBOARD)">
                {{ __(trans('navigation.dashboard')) }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route(App\Constants\RouteNames::LOGOUT) }}">
                        @csrf

                        <x-responsive-nav-link :href="route(App\Constants\RouteNames::LOGOUT)"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __(trans('buttons.logOut')) }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
