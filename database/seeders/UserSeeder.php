<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

        // Create a user
        $eigenaar = User::create([
            'name' => 'Henrieke van Gaardingen',
            'email' => 'henrieke@jehaarzitgoed.nl',
            'password' => Hash::make('Kapperszaak123!'),
            'telephone_number' => '0621340645'
        ]);

        // Assign the role to the user
        $eigenaar->assignRole('Eigenaar');

        // Create a user
        $kapper = User::create([
            'name' => 'Connie van de berg ',
            'email' => 'connie@jehaarzitgoed.nl',
            'password' => Hash::make('KapperConnie#1998'),
            'telephone_number' => '0657483526'
        ]);

        $kapper->assignRole('Kapper');
    }
}
