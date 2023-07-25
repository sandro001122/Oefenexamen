<?php

namespace Database\Seeders;
use App\Models\Timeblock;
use Illuminate\Database\Seeder;

class TimeblockSeeder extends Seeder
{
    public function run(): void
    {
        Timeblock::create([
            'start_time' => '9:00:00',
            'end_time' => '9:59:00',
        ]);

        Timeblock::create([
            'start_time' => '10:00:00',
            'end_time' => '10:59:00',
        ]);

        Timeblock::create([
            'start_time' => '11:00:00',
            'end_time' => '11:59:00',
        ]);

        Timeblock::create([
            'start_time' => '12:00:00',
            'end_time' => '12:59:00',
        ]);

        Timeblock::create([
            'start_time' => '13:00:00',
            'end_time' => '13:59:00',
        ]);

        Timeblock::create([
            'start_time' => '14:00:00',
            'end_time' => '14:59:00',
        ]);

        Timeblock::create([
            'start_time' => '15:00:00',
            'end_time' => '15:59:00',
        ]);
    }
}
