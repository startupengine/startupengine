<?php

use Illuminate\Database\Seeder;

class DataTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_types')->delete();
        
        \DB::table('data_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'posts',
                'slug' => 'posts',
                'display_name_singular' => 'Post',
                'display_name_plural' => 'Posts',
                'icon' => 'voyager-news',
                'model_name' => 'TCG\\Voyager\\Models\\Post',
                'description' => '',
                'generate_permissions' => true,
                'created_at' => '2017-10-22 02:25:04',
                'updated_at' => '2017-10-22 02:25:04',
                'server_side' => 0,
                'controller' => '',
                'policy_name' => 'TCG\\Voyager\\Policies\\PostPolicy',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'users',
                'slug' => 'users',
                'display_name_singular' => 'User',
                'display_name_plural' => 'Users',
                'icon' => 'voyager-person',
                'model_name' => 'TCG\\Voyager\\Models\\User',
                'description' => '',
                'generate_permissions' => true,
                'created_at' => '2017-10-22 02:25:04',
                'updated_at' => '2017-10-22 02:25:04',
                'server_side' => 0,
                'controller' => '',
                'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'categories',
                'slug' => 'categories',
                'display_name_singular' => 'Category',
                'display_name_plural' => 'Categories',
                'icon' => 'voyager-categories',
                'model_name' => 'TCG\\Voyager\\Models\\Category',
                'description' => '',
                'generate_permissions' => true,
                'created_at' => '2017-10-22 02:25:04',
                'updated_at' => '2017-10-22 02:25:04',
                'server_side' => 0,
                'controller' => '',
                'policy_name' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'menus',
                'slug' => 'menus',
                'display_name_singular' => 'Menu',
                'display_name_plural' => 'Menus',
                'icon' => 'voyager-list',
                'model_name' => 'TCG\\Voyager\\Models\\Menu',
                'description' => '',
                'generate_permissions' => true,
                'created_at' => '2017-10-22 02:25:04',
                'updated_at' => '2017-10-22 02:25:04',
                'server_side' => 0,
                'controller' => '',
                'policy_name' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'roles',
                'slug' => 'roles',
                'display_name_singular' => 'Role',
                'display_name_plural' => 'Roles',
                'icon' => 'voyager-lock',
                'model_name' => 'TCG\\Voyager\\Models\\Role',
                'description' => '',
                'generate_permissions' => true,
                'created_at' => '2017-10-22 02:25:04',
                'updated_at' => '2017-10-22 02:25:04',
                'server_side' => 0,
                'controller' => '',
                'policy_name' => NULL,
            ),
        ));
        
        
    }
}