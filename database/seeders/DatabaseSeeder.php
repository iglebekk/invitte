<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Anders',
            'email' => 'anders@tolvtemann.no',
            'password' => Hash::make('password'),
            'supadm' => 1
        ]);
    }
}
