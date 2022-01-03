<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(trans('buttons.show').' '.$user->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                        <li>
                            <h3>Id: {{ $user->id }}</h3>
                        </li>
                        <li>
                            <h3>{{ trans('auth.name').': '.$user->name }}</h3>
                        </li>
                        <li>
                            <h3>{{ trans('auth.email').': '.$user->email }}</h3>
                        </li>
                        <li>
                            <h3>{{ trans('auth.role').': '.($user->role == 'admin' ? trans('auth.admin') : trans('auth.buyer')) }}</h3>
                        </li>
                        @if($user->disabled_at)
                        <li>
                            <h3>{{ trans('auth.disabledAt').': '.$user->disabled_at }}</h3>
                        </li>
                        @endif
                        <li>
                            <h3>{{ trans('auth.verifiedAt').': '.$user->email_verified_at }}</h3>
                        </li>
                        <li>
                            <h3>{{ trans('auth.createdAt').': '.$user->created_at}}</h3>
                        </li>
                        <li>
                            <h3>{{ trans('auth.updatedAt').': '.$user->updated_at}}</h3>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
