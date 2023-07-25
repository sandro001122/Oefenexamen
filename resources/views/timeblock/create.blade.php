<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-md">
            <div class="py-4 px-6">
                <h1 class="text-2xl font-semibold mb-6">Nieuw Tijdblok</h1>
                <form action="{{ route('timeblock.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="time_start" class="block font-medium text-sm text-gray-700">Start Tijd</label>
                        <input type="time" name="time_start" id="time_start" min="09:00" max="18:00" step="900" class="form-input mt-1 block w-full" required autofocus>
                        @error('time_start')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-4">
                        <p>Een tijdsblok is altijd één uur.</p>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Aanmaken
                        </button>
                        <a href="{{ route('timeblock.index') }}" class="ml-4 text-sm text-gray-600 underline">Annuleren</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
