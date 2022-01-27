<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __(trans('auth.verifyMessage')) }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __(trans('auth.sentMessage')) }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route(App\Constants\RouteNames::VERIFICATION_SEND) }}">
                @csrf

                <div>
                    <x-button>
                        {{ __(trans('auth.resend')) }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route(App\Constants\RouteNames::LOGOUT) }}">
                @csrf

                <x-button type="submit" class="ml-4">
                    {{ __(trans('buttons.logOut')) }}
                </x-button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
