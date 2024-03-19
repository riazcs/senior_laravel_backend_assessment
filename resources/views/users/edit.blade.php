<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-4xl">
                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Designation -->
                        <div class="mt-4">
                            <x-input-label for="designation" :value="__('Designation')" />
                            <x-text-input id="designation" class="block mt-1 w-full" type="text" name="designation" :value="$user->designation" autofocus />
                            <x-input-error :messages="$errors->get('designation')" class="mt-2" />
                        </div>

                        <!-- Profile Photo -->
                        <div class="mt-4">
                            <x-input-label for="profile_photo" :value="__('Profile Photo')" />
                            <input id="profile_photo" class="block mt-1 w-full" type="file" name="profile_photo" />
                            @if ($user->profile_photo)
                            <img src="{{ asset($user->profile_photo) }}" alt="Profile Photo" class="h-10 w-10 mt-1">
                            @else
                            <p>No photo available</p>
                            @endif
                            <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
                        </div>

                        <!-- Addresses -->
                        <div class="mt-4">
                            <x-input-label for="addresses" :value="__('Addresses')" />
                            <div id="address-fields">
                                @foreach($user->addresses as $key => $address)
                                <div id="address_{{ $key }}" class="flex items-center space-x-4 mt-2">
                                    <x-text-input class="block w-full" type="text" name="addresses[]" :value="$address->address" placeholder="Address {{ $key + 1 }}" required />
                                    <button type="button" class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600" onclick="removeAddressField({{ $key }})">Remove</button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" onclick="addAddressField()" class="mt-2 py-1 px-3 bg-sky-500 text-white rounded hover:bg-blue-600">Add Address</button>
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    let addressFieldIndex = {{ count($user->addresses) }};

    function addAddressField() {
        addressFieldIndex++;

        const addressField = `
            <div id="address_${addressFieldIndex}" class="flex items-center space-x-4 mt-2">
                <x-text-input class="block w-full" type="text" name="addresses[]" placeholder="Address ${addressFieldIndex}" required />
                <button type="button" class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600" onclick="removeAddressField(${addressFieldIndex})">Remove</button>
            </div>
        `;

        document.getElementById('address-fields').insertAdjacentHTML('beforeend', addressField);
    }

    function removeAddressField(index) {
        const addressField = document.getElementById(`address_${index}`);
        if (addressField) {
            addressField.remove();
        }
}

</script>