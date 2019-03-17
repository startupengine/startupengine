<?php

use Illuminate\Database\Seeder;
use App\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */

    public function run()
    {
        Role::firstOrCreate([
            'name' => 'admin',
            'display_name' => 'Super Admin'
        ]);
        Role::firstOrCreate([
            'name' => 'executive',
            'display_name' => 'Executive'
        ]);
        Role::firstOrCreate([
            'name' => 'staff',
            'display_name' => 'Staff User'
        ]);
        Role::firstOrCreate(['name' => 'writer', 'display_name' => 'Writer']);
        Role::firstOrCreate(['name' => 'editor', 'display_name' => 'Editor']);
        Role::firstOrCreate([
            'name' => 'developer',
            'display_name' => 'Developer'
        ]);
        Role::firstOrCreate(['name' => 'analyst', 'display_name' => 'Analyst']);
        Role::firstOrCreate([
            'name' => 'user',
            'display_name' => 'Regular User'
        ]);
        Role::firstOrCreate([
            'name' => 'marketer',
            'display_name' => 'Marketer'
        ]);
    }
}
