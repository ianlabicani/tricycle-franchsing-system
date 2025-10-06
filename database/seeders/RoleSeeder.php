<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'driver'],
            ['name' => 'inspector'],
            ['name' => 'treasury_staff'],
            ['name' => 'SB_staff'],
            ['name' => 'priest'],
            ['name' => 'super_admin'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
