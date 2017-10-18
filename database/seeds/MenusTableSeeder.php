<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'created_at' => '2017-10-12 04:36:24',
                'updated_at' => '2017-10-12 18:04:03',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'site',
                'created_at' => '2017-10-12 18:02:17',
                'updated_at' => '2017-10-12 18:04:14',
            ),
        ));
        
        
    }
}