<?php

namespace Database\Seeders;
use App\Models\Treatment;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    public function run(): void
    {
        Treatment::create([
            'name' => 'Kinderen knippen < 18',
            'price' => '20',
        ]);

        Treatment::create([
            'name' => 'Vrouwen knippen volwassen',
            'price' => '30',
        ]);

        Treatment::create([
            'name' => 'Vrouwen knippen en wassen volwassen',
            'price' => '35',
        ]);

        Treatment::create([
            'name' => 'Vrouwen knippen en kleuren volwassen',
            'price' => '40',
        ]);

        Treatment::create([
            'name' => 'Vrouwen knippen en krullen volwassen',
            'price' => '35',
        ]);

        Treatment::create([
            'name' => 'Uitdunnen',
            'price' => '15',
        ]);
    }
}
