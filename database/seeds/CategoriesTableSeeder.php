<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => NULL,
                'order' => 2,
                'name' => 'Blog Posts',
                'slug' => 'blog',
                'created_at' => '2017-10-12 04:36:54',
                'updated_at' => '2017-10-14 21:14:57',
                'description' => NULL,
                'status' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => NULL,
                'order' => 3,
                'name' => 'Announcements',
                'slug' => 'announcements',
                'created_at' => '2017-10-12 04:36:54',
                'updated_at' => '2017-10-14 21:15:04',
                'description' => NULL,
                'status' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => NULL,
                'order' => 1,
                'name' => 'Features',
                'slug' => 'features',
                'created_at' => '2017-10-13 00:34:44',
                'updated_at' => '2017-10-14 21:10:10',
                'description' => 'Discover the features of StartupEngine.',
                'status' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'parent_id' => NULL,
                'order' => 6,
                'name' => 'Documentation',
                'slug' => 'documentation',
                'created_at' => '2017-10-14 07:01:59',
                'updated_at' => '2017-10-14 21:15:26',
                'description' => 'Technical information about the content API.',
                'status' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'parent_id' => NULL,
                'order' => 5,
                'name' => 'Tutorials',
                'slug' => 'tutorials',
                'created_at' => '2017-10-14 07:02:10',
                'updated_at' => '2017-10-17 08:04:46',
                'description' => 'Learn the tricks of the trade to bootstrap your marketing.',
                'status' => 'published',
            ),
            5 => 
            array (
                'id' => 7,
                'parent_id' => NULL,
                'order' => 4,
                'name' => 'Getting Started',
                'slug' => 'getting-started',
                'created_at' => '2017-10-14 07:02:33',
                'updated_at' => '2017-10-14 21:15:11',
                'description' => NULL,
                'status' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'parent_id' => NULL,
                'order' => 1,
                'name' => 'Frequently Asked Questions',
                'slug' => 'frequently-asked-questions',
                'created_at' => '2017-10-16 11:35:56',
                'updated_at' => '2017-10-16 11:35:56',
                'description' => 'What does Startup Engine do? How does it work? What does it cost?
',
                'status' => NULL,
            ),
        ));
        
        
    }
}