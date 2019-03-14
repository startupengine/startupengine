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
        Role::create(['name' => 'admin', 'display_name' => 'Super Admin']);
        Role::create(['name' => 'executive', 'display_name' => 'Executive']);
        Role::create(['name' => 'staff', 'display_name' => 'Staff User']);
        Role::create(['name' => 'writer', 'display_name' => 'Writer']);
        Role::create(['name' => 'editor', 'display_name' => 'Editor']);
        Role::create(['name' => 'developer', 'display_name' => 'Developer']);
        Role::create(['name' => 'analyst', 'display_name' => 'Analyst']);
        Role::create(['name' => 'user', 'display_name' => 'Regular User']);
    }
}