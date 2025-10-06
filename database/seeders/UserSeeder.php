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
        // Create Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
        ]);
        $superAdmin->roles()->attach(Role::where('name', 'super_admin')->first());

        // Create Priest
        $priest = User::create([
            'name' => 'Father John Doe',
            'email' => 'priest@mail.com',
            'password' => Hash::make('password'),
        ]);
        $priest->roles()->attach(Role::where('name', 'priest')->first());

        // Create Treasury Staff
        $treasuryStaff = User::create([
            'name' => 'Treasury Staff',
            'email' => 'treasury@mail.com',
            'password' => Hash::make('password'),
        ]);
        $treasuryStaff->roles()->attach(Role::where('name', 'treasury_staff')->first());

        // Create SB Staff
        $sbStaff = User::create([
            'name' => 'SB Staff',
            'email' => 'sb_staff@mail.com',
            'password' => Hash::make('password'),
        ]);
        $sbStaff->roles()->attach(Role::where('name', 'SB_staff')->first());

        // Create Inspector
        $inspector = User::create([
            'name' => 'Inspector',
            'email' => 'inspector@mail.com',
            'password' => Hash::make('password'),
        ]);
        $inspector->roles()->attach(Role::where('name', 'inspector')->first());

        // Create Driver
        $driver = User::create([
            'name' => 'Juan Dela Cruz',
            'email' => 'driver@mail.com',
            'password' => Hash::make('password'),
        ]);
        $driver->roles()->attach(Role::where('name', 'driver')->first());

        // Create additional drivers for testing
        $driver2 = User::create([
            'name' => 'Pedro Santos',
            'email' => 'driver2@mail.com',
            'password' => Hash::make('password'),
        ]);
        $driver2->roles()->attach(Role::where('name', 'driver')->first());

        $driver3 = User::create([
            'name' => 'Maria Garcia',
            'email' => 'driver3@mail.com',
            'password' => Hash::make('password'),
        ]);
        $driver3->roles()->attach(Role::where('name', 'driver')->first());
    }
}
