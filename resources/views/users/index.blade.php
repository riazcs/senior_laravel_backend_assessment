<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User List') }}
            </h2>
            <a href="{{ route('users.create') }}" class="text-right text-blue-600 dark:text-blue-500 hover:underline">Add New</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-7xl">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table class="w-full text-sm rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b dark:border-gray-700 mb-8">
                                <tr>
                                    <th scope="col">
                                        Name
                                    </th>
                                    <th scope="col">
                                        Email
                                    </th>
                                    <th scope="col">
                                        Designation
                                    </th>
                                    <th scope="col">
                                        Photo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="py-4 whitespace-nowrap dark:text-white">
                                        {{$user->name}}
                                    </td>
                                    <td class="py-4">
                                        {{$user->email}}
                                    </td>
                                    <td class=" py-4">
                                        {{$user->designation}}
                                    </td>
                                    <td class="py-4">
                                        @if ($user->profile_photo)
                                        <img src="{{ $user->profile_photo }}" alt="User Photo" class="h-30 w-30 rounded">
                                        @else
                                        <p>No image available</p>
                                        @endif
                                    </td>
                                    <td class="py-4 text-right">
                                        @if ($user->trashed())
                                        <form action="{{ route('users.restore', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-blue-600 dark:text-blue-500 hover:underline">Restore</button>
                                        </form>
                                        @else
                                        <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                        </form>
                                        <form action="{{ route('users.permanentlyDelete', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-500 hover:underline">Permanently Delete</button>
                                        </form>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>