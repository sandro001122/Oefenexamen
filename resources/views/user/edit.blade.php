<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-md">
            <div class="py-4 px-6">
                <h1 class="text-2xl font-semibold mb-6">Edit User</h1>
                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="form-input mt-1 block w-full"
                               value="{{ $user->name }}" required autofocus>
                        @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="form-input mt-1 block w-full"
                               value="{{ $user->email }}" required>
                        @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="telephone_number" class="block font-medium text-sm text-gray-700">Telephone
                            Number</label>
                        <input type="text" name="telephone_number" id="telephone_number"
                               class="form-input mt-1 block w-full" value="{{ $user->telephone_number }}"
                               pattern="^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$"
                               required>
                        @error('telephone_number')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Update
                        </button>
                        <a href="{{ route('user.index') }}" class="ml-4 text-sm text-gray-600 underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
