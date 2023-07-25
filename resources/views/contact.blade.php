<x-app-layout>
<div class="flex flex-col md:flex-row justify-center">
        <div class="flex-grow mt-16 mx-4 md:mx-0 max-w-sm">
            <div class="bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none border border-black p-6">
                <div>
                    <h2 class="font-bold">Contact</h2>
                    <p>
                        Wilt u een afspraak maken? Heeft u behoefte aan professioneel advies? Of ben je benieuwd naar onze
                        prijzen? Voor deze en vele andere vragen kunt u contact opnemen met ons.
                        Whatsapp, bel of mail ons gerust.
                    </p>
                </div>
                <div class="mt-8">
                    <h2 class="font-bold">Openingstijden</h2>
                    <p>
                        Maandag: 09:00 - 17:00<br>
                        Dinsdag: 09:00 - 17:00<br>
                        Woensdag: 09:00 - 17:00<br>
                        Donderdag: 09:00 - 17:00<br>
                        Vrijdag: 09:00 - 17:00<br>
                        Zaterdag: 09:00 - 17:00<br>
                        Zondag: Gesloten
                    </p>
                </div>
            </div>
        </div>
        <div class="flex-grow mt-16 mx-4 md:ml-16 max-w-sm">
            <div class="bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none border border-black p-6">
                <form action="{{ route('sendmail') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <label for="name" class="text-gray-700 dark:text-white font-semibold">Naam</label>
                        <input type="text" id="name" name="name"
                            class="border border-black dark:border-black rounded-md shadow-sm p-2 focus:outline-none focus:border-[#3B608C]-500 focus:ring focus:ring-[#3B608C]-500 focus:ring-opacity-50">

                        <label for="email" class="text-gray-700 dark:text-white font-semibold">Email</label>
                        <input type="email" id="email" name="email"
                            class="border border-black dark:border-black rounded-md shadow-sm p-2 focus:outline-none focus:border-[#3B608C]-500 focus:ring focus:ring-[#3B608C]-500 focus:ring-opacity-50">

                        <label for="message" class="text-gray-700 dark:text-white font-semibold">Bericht</label>
                        <textarea id="message" name="message" rows="4"
                            class="border border-black dark:border-black rounded-md shadow-sm p-2 focus:outline-none focus:border-[#3B608C]-500 focus:ring focus:ring-[#3B608C]-500 focus:ring-opacity-50"></textarea>
                    </div>
                    <div class="mt-6">
                        <button type="submit"
                            class="py-2 px-4 bg-[#3B608C] hover:bg-blue-400 text-white font-semibold rounded-md shadow-md hover:shadow-lg transition-colors duration-300">
                            Verstuur bericht
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
