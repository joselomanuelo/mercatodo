<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(trans('buttons.show') . ' ' . $user->name) }}
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
                            <h3>{{ trans('auth.name') . ': ' . $user->name }}</h3>
                        </li>
                        <li>
                            <h3>{{ trans('auth.email') . ': ' . $user->email }}</h3>
                        </li>
                        <li>
                            <h3>{{ trans('auth.role') . ': ' . ($user->hasRole('admin') ? trans('auth.admin') : trans('auth.buyer')) }}
                            </h3>
                        </li>
                        @if ($user->disabled_at)
                            <li>
                                <h3>{{ trans('auth.disabledAt') . ': ' . $user->disabled_at }}</h3>
                            </li>
                        @endif
                        <li>
                            <h3>{{ trans('auth.verifiedAt') . ': ' . $user->email_verified_at }}</h3>
                        </li>
                        <li>
                            <h3>{{ trans('auth.createdAt') . ': ' . $user->created_at }}</h3>
                        </li>
                        <li>
                            <h3>{{ trans('auth.updatedAt') . ': ' . $user->updated_at }}</h3>
                        </li>
                    </ul>
                </div>
                <div class="container mx-auto p-6">
                    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                        <div class="w-full overflow-x-auto">
                            <h2>{{ trans('user.activities') }}</h2>
                            <table class="w-full">
                                <thead>
                                    <tr
                                        class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                        <th class="px-4 py-3">Id</th>
                                        <th class="px-4 py-3">{{ trans('user.type') }}</th>
                                        <th class="px-4 py-3">{{ trans('auth.createdAt') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <div class="container">
                                        @foreach ($userLogs as $userLog)
                                            <tr class="text-gray-700">
                                                <td class="px-4 py-3 border">
                                                    <div class="flex items-center text-sm">
                                                        <p class="font-semibold text-black">{{ $userLog->id }}</p>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 border">
                                                    <div class="flex items-center text-sm">
                                                        <p class="font-semibold text-black">{{ $userLog->type }}</p>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 border">
                                                    <div class="flex items-center text-sm">
                                                        <p class="font-semibold text-black">{{ $userLog->created_at }}
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
