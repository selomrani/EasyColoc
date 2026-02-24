<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'admin_global'], // Platform level
            ['name' => 'user'],         // Platform level
            ['name' => 'owner'],        // Colocation level (Pivot)
            ['name' => 'member'],       // Colocation level (Pivot)
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role); 
        }
    }
}