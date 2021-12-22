<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver') }}
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
                            <h3>Nombre: {{ $user->name }}</h3>
                        </li>
                        <li>
                            <h3>Email: {{ $user->email }}</h3>
                        </li>
                        <li>
                            <h3>Estado: {{ $user->status ? 'Habilitado' : 'Inhabilitado' }}</h3>
                        </li>
                        <li>
                            <h3>Fecha de verificación de email: {{ $user->email_verified_at }}</h3>
                        </li>
                        <li>
                            <h3>Fecha de creación: {{ $user->created_at}}</h3>
                        </li>
                        <li>
                            <h3>Fecha de actualización: {{ $user->updated_at}}</h3>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
