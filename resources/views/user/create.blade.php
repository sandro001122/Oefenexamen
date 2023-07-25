<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gebruiker toevoegen') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto bg-white rounded-md shadow-md overflow-hidden">
            <div class="py-4 px-6">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="flex">
                        <div class="w-full pr-2">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Naam:</label>
                            <input type="text" name="name" id="name"
                                   class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   required>
                        </div>
                    </div>

                    <div class="flex mt-4">
                        <div class="w-1/2 pr-2">
                            <label for="telephone_number"
                                   class="block text-gray-700 font-bold mb-2">Telefoonnummer:</label>
                            <input type="tel" placeholder="+31 xx-xxxxxxxx of vul in xxxxxxxxxx" name="telephone_number"
                                   id="telephone_number"
                                   class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   pattern="^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$"
                                   required>
                        </div>

                        <div class="w-1/2 pl-2">
                            <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                            <input type="email" name="email" id="email"
                                   class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                        <input type="password" name="password" id="password"
                               class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               required>
                    </div>
                    <div class="mt-4">
                        <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm
                            Password:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-input rounded-md shadow-sm w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               required>
                    </div>

                    <div class="mt-6 mb-6">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Opslaan
                        </button>
                    </div>
                </form>
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                         role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>

                    </div>

                @endif
                @if ($errors->has('telephone_number'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ $errors->first('telephone_number') }}</span>

                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
