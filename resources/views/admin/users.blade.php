<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="container mx-auto p-6 font-mono">
                        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                            <th class="px-4 py-3">Id</th>
                                            <th class="px-4 py-3">Nombre</th>
                                            <th class="px-4 py-3">Email</th>
                                            <th class="px-4 py-3">Rol</th>
                                            <th class="px-4 py-3">Estado</th>
                                            <th class="px-4 py-3">Ver</th>
                                            <th class="px-4 py-3">Editar</th>
                                            <th class="px-4 py-3">Borrar</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        <div class="container">
                                            @foreach ($users as $user)
                                                <tr class="text-gray-700">
                                                    <td class="px-4 py-3 border">
                                                        <div class="flex items-center text-sm">
                                                            <p class="font-semibold text-black">{{ $user->id }}</p>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3 border">
                                                        <div class="flex items-center text-sm">
                                                            <p class="font-semibold text-black">{{ $user->name }}</p>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3 border">
                                                        <div class="flex items-center text-sm">
                                                            <p class="font-semibold text-black">{{ $user->email }}</p>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3 border">
                                                        <div class="flex items-center text-sm">
                                                            <p class="font-semibold text-black">{{ trans('roles.'.$user->role) }}</p>
                                                        </div>
                                                    </td> 
                                                    <td class="px-4 py-3 border">
                                                        <div class="flex items-center text-sm">
                                                            <p class="font-semibold text-black">{{ !$user->disable_at ? 'Habilitado' : 'Deshabilitado' }}</p>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3 border">
                                                        <div class="flex items-center text-sm">
                                                            <x-button-link href="{{ route('admin.users.show', $user) }}">Ver</x-button-link>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3 border">
                                                        <div class="flex items-center text-sm">
                                                            <x-button-link href="{{ route('admin.users.edit', $user) }}">Editar</x-button-link>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3 border">
                                                        <div class="flex items-center text-sm">
                                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                                                @csrf
                                                                {{ method_field('DELETE') }}
                                                                <x-button onclick="return confirm('¿Quieres borrar el usuario');">
                                                                    {{ __('Borrar') }}
                                                                </x-button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </div>
                                        {{ $users->links() }}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
