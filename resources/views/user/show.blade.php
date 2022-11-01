<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Detail') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center px-4 py-2 mb-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-gray disabled:opacity-25">
                    <- Go back
                </a>
                <table class="w-full table-fixed">
                    <tbody>
                        <tr>
                            <td class="px-4 py-2 font-bold">Name</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 font-bold">Email</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 font-bold">Phone</td>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 font-bold">Birthdate</td>
                            <td>{{ $user->birthdate }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 font-bold">Identification</td>
                            <td>{{ $user->identification }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 font-bold">City</td>
                            <td>{{ $user->city->name }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 font-bold">Created on</td>
                            <td>{{ date_format($user->created_at, 'jS F Y g:i A') }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 font-bold">Last updated</td>
                            <td>{{ date_format($user->updated_at, 'jS F Y g:i A') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
