<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-md">
            <div class="py-4 px-6">
                <h1 class="text-2xl font-semibold mb-6">Bewerk Behandeling</h1>
                <form action="{{ route('treatments.update', $treatment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-700">Behandeling naam</label>
                        <input type="text" name="name" id="name" class="form-input mt-1 block w-full" value="{{ $treatment->name }}" required autofocus>
                        @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block font-medium text-sm text-gray-700">Prijs</label>
                        <input type="number" name="price" id="price" class="form-input mt-1 block w-full" value="{{ $treatment->price }}" required>
                        @error('price')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Bijwerken
                        </button>
                        <a href="{{ route('treatments.index') }}" class="ml-4 text-sm text-gray-600 underline">Annuleren</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
