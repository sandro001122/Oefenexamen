<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-400 leading-tight">
            {{ __('Afspraak maken') }}
        </h2>
    </x-slot>
    <div class="flex justify-center items-center mt-5">
        <div class="bg-white p-8 rounded-lg shadow-lg w-2/3 md:w-2/3 lg:w-1/3">
            @if (session('success'))
                <div class="bg-green-200 text-green-800 px-4 py-2 mb-4 rounded">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="bg-red-200 text-red-800 px-4 py-2 mb-4 rounded">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('appointment.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Naam:</label>
                    <input type="text" name="name" id="name" class="form-input mt-1 block w-full" value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email:</label>
                    <input type="email" name="email" id="email" class="form-input mt-1 block w-full" value="{{ old('email') }}" required>
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700">Telefoon nummer:</label>
                    <input type="text" placeholder="+31 xxxxxxxxx of vul in xxxxxxxxxx" name="phone" id="phone" class="form-input mt-1 block w-full" pattern="^(?:\+31|0)6\d{8}$" value="{{ old('phone') }}" required>
                </div>

                <div class="mb-4">
                    <label for="date" class="block text-gray-700">Datum:</label>
                    <input type="date" name="date" id="date" class="form-input mt-1 block w-full" min="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}" value="{{ old('date') }}" required
                    oninput="checkDayOfWeek(this)">
                </div>


                <div class="mb-4">
                <label for="timeblock" class="block text-gray-700">Tijd:</label>
                <select name="timeblock" id="timeblock" class="form-select mt-1 block w-full" required>
                    @foreach ($timeblocks as $timeblock)
                        <option value="{{ $timeblock->id }}" {{ $timeblock->id == old('timeblock') ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::parse($timeblock->start_time)->format('H:i') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="stylist" class="block text-gray-700">Kapster:</label>
                <select name="stylist" id="stylist" class="form-select mt-1 block w-full" required>
                    @foreach ($stylists as $stylist)
                        <option value="{{ $stylist->id }}" {{ $stylist->id == old('stylist') ? 'selected' : '' }}>
                            {{ $stylist->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="treatment" class="block text-gray-700">Behandeling:</label>
                <select name="treatment" id="treatment" class="form-select mt-1 block w-full" required>
                    @foreach ($treatments as $treatment)
                        <option value="{{ $treatment->id }}" {{ $treatment->id == old('treatment') ? 'selected' : '' }}>
                            {{ $treatment->name }}
                        </option>
                    @endforeach
                </select>
            </div>


                <button type="submit" class="py-2 px-4 bg-[#3B608C] hover:bg-blue-800 text-white font-semibold rounded-md shadow-md hover:shadow-lg transition-colors duration-300">Afspraak aanmaken</button>
            </form>
        </div>
    </div>
    <script>
    function checkDayOfWeek(input) {
        var selectedDate = new Date(input.value);
        var dayOfWeek = selectedDate.getDay();
        var isSunday = (dayOfWeek === 0); // Sunday is represented by 0

        if (isSunday) {
            input.setCustomValidity("De winkel is op zondag gesloten. Selecteer een andere datum.");
        } else {
            input.setCustomValidity("");
        }
    }
</script>
</x-app-layout>
