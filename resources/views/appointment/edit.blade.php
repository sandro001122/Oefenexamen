<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-400 leading-tight">
            {{ __('Wijziging maken') }}
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

            <form action="{{ route('appointment.update', ['appointment' => $appointment->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Naam:</label>
                    <input type="text" id="name" name="name" value="{{ $appointment->customer_name }}"
                           class="form-input mt-1 block w-full" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" value="{{ $appointment->customer_email }}"
                           class="form-input mt-1 block w-full" required>
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700">Telefoon nummer:</label>
                    <input type="text" id="phone" placeholder="+31 xxxxxxxxx of vul in xxxxxxxxxx" name="phone"
                           value="{{ $appointment->customer_telephone_number }}" class="form-input mt-1 block w-full"
                           pattern="^(?:\+31|0)6\d{8}$" required>
                </div>

                <div class="mb-4">
                    <label for="date" class="block text-gray-700">Datum:</label>
                    <input type="date" id="date" name="date" value="{{ $appointment->date->format('Y-m-d') }}"
                           min="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}"
                           class="form-input mt-1 block w-full" required
                oninput="checkDayOfWeek(this)">
            </div>

                <div class="mb-4">
                    <label for="timeblock" class="block text-gray-700">Tijd:</label>
                    <select id="timeblock" name="timeblock" class="form-select mt-1 block w-full" required>
                        @foreach ($timeblocks as $timeblock)
                            <option
                                value="{{ $timeblock->id }}" {{ $timeblock->id == $appointment->timeblock_id ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::parse($timeblock->start_time)->format('H:i') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="stylist" class="block text-gray-700">Kapster:</label>
                    <select id="stylist" name="stylist" class="form-select mt-1 block w-full" required>
                        @foreach ($stylists as $stylist)
                            <option
                                value="{{ $stylist->id }}" {{ $stylist->id == $appointment->user_id ? 'selected' : '' }}>
                                {{ $stylist->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="treatment" class="block text-gray-700">Behandeling:</label>
                    <select id="treatment" name="treatment" class="form-select mt-1 block w-full" required>
                        @foreach ($treatments as $treatment)
                            <option
                                value="{{ $treatment->id }}" {{ $treatment->id == $appointment->treatment_id ? 'selected' : '' }}>
                                {{ $treatment->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="appointment_id" value="{{ $appointment->id ?? '' }}">

                <div class="flex justify-between">
                    <button type="submit" formaction="{{ route('appointment.cancel', ['appointment' => $appointment->id]) }}"
                                class="py-2 px-4 bg-purple-700 hover:bg-purple-800 text-white font-semibold rounded-md shadow-md hover:shadow-lg transition-colors duration-300">
                            Afspraak annuleren
                        </button>

                    <button type="submit"
                            class="py-2 px-4 bg-[#3B608C] hover:bg-blue-800 text-white font-semibold rounded-md shadow-md hover:shadow-lg transition-colors duration-300">
                        Afspraak wijzigen
                    </button>

            </div>

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
