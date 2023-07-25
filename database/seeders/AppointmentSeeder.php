<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\TimeBlock;
use App\Models\User;
use App\Models\Treatment;
use Faker\Factory as Faker;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('nl_NL'); // Set locale to Dutch
        $timeBlockIds = TimeBlock::pluck('id'); // Retrieve the valid Time Block IDs
        $userIds = User::pluck('id'); // Retrieve the valid User IDs
        $treatmentIds = Treatment::pluck('id'); // Retrieve the valid Treatment IDs

        for ($i = 1; $i <= 20; $i++) {
            $date = $faker->dateTimeBetween('2023-07-08', '2023-09-08')->format('Y-m-d');
            $timeBlockId = $timeBlockIds->random();
            $userId = $userIds->random();

            // Ensure the same time block is not assigned to the same user on the same date
            $existingAppointment = Appointment::where('date', $date)
                ->where('user_id', $userId)
                ->where('timeblock_id', $timeBlockId)
                ->first();

            if ($existingAppointment) {
                // If appointment with the same time block already exists, skip this iteration
                continue;
            }

            $appointment = new Appointment();
            $appointment->customer_name = $faker->name;
            $appointment->customer_telephone_number = $faker->phoneNumber;
            $appointment->customer_email = $faker->email;
            $appointment->date = $date;
            $appointment->timeblock_id = $timeBlockId;
            $appointment->user_id = $userId;
            $appointment->treatment_id = $treatmentIds->random();
            $appointment->canceled = 0;
            $appointment->save();
        }

        
        $specificAppointment = new Appointment();
        $specificAppointment->customer_name = 'Henk van Reenen';
        $specificAppointment->customer_telephone_number = '0683451524';
        $specificAppointment->customer_email = 'HenkvanReenen@gmail.com';
        $specificAppointment->date = '2023-08-15';
        $specificAppointment->timeblock_id = 2;
        $specificAppointment->user_id = 2;
        $specificAppointment->treatment_id = 2;
        $specificAppointment->canceled = 0;
        
        $specificAppointment->save();
    }
}
