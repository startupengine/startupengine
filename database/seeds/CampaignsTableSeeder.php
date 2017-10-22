<?php

use Illuminate\Database\Seeder;

class CampaignsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('campaigns')->delete();
        
        \DB::table('campaigns')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Launch',
                'meta_description' => 'Our first campaign',
                'slug' => 'launch',
                'created_at' => '2017-10-22 01:59:16',
                'updated_at' => '2017-10-22 01:59:16',
            ),
        ));
        
        
    }
}