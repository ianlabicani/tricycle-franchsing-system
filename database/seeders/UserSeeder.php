<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priest = User::create([
            'name' => 'Priest',
            'email' => 'priest@mail.com',
            'password' => Hash::make('password'),
        ]);

        $secretary = User::create([
            'name' => 'Secretary',
            'email' => 'secretary@mail.com',
            'password' => Hash::make('password'),
        ]);

        $priest->roles()->attach(Role::where('name', 'priest')->first());
        $secretary->roles()->attach(Role::where('name', 'secretary')->first());
    }
}
