<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'display_name' => 'Administrator',
                'created_at' => '2017-10-12 04:36:24',
                'updated_at' => '2017-10-12 04:36:24',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'user',
                'display_name' => 'Normal User',
                'created_at' => '2017-10-12 04:36:24',
                'updated_at' => '2017-10-12 04:36:24',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'writer',
                'display_name' => 'Writer',
                'created_at' => '2017-10-12 21:17:38',
                'updated_at' => '2017-10-12 21:17:47',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'developer',
                'display_name' => 'Developer',
                'created_at' => '2017-10-13 02:37:36',
                'updated_at' => '2017-10-13 02:37:44',
            ),
        ));
        
        
    }
}