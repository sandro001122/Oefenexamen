<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-400 leading-tight">
            {{ __('Overzicht Tijdblokken') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-8 py-8">
        <div class="py-6 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto bg-white rounded-md shadow-md overflow-hidden p-8">
                <div class="py-4 px-6">
                    <div class="container mx-auto px-4">
                        <a href="{{ route('appointment.create') }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Afspraak maken</a>
                        <table class="min-w-full divide-y divide-gray-200 mt-6">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Datum
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tijd
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Klant naam
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Edit Knop
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Annuleer Knop
                                </th>
                            </tr>
                            </thead>
                            <tbody id="timeblocks" class="bg-white divide-y divide-gray-200">
                            @if($appointments->isNotEmpty())
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $appointment->date->format('d-m-Y') }}</td>
                                        <td class="border px-4 py-2">{{ $appointment->timeblock->start_time->format('H:i') }}</td>
                                        <td class="border px-4 py-2">{{ $appointment->customer_name }}</td>
                                        <td class="border px-4 py-2">
                                            <form action="{{ route('appointment.edit', $appointment->id) }}" method="GET">
                                                @csrf
                                                <button type="submit"
                                                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                                    Aanpassen
                                                </button>
                                            </form>
                                        </td>
                                        <td class="border px-4 py-2">
                                        <form action="{{ route('appointment.cancel', $appointment->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je de afspraak wilt annuleren?');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded">
                                                Annuleren
                                            </button>
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-4 py-2">Geen afspraak gevonden</td>
                                    <td class="px-4 py-2">Geen tijd gevonden</td>
                                    <td class="px-4 py-2">Geen klant gevonden</td>
                                    <td class="px-4 py-2">N.V.T</td>
                                    <td class="px-4 py-2">N.V.T</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
