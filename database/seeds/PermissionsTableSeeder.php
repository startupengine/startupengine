<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'browse_admin',
                'table_name' => NULL,
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'browse_database',
                'table_name' => NULL,
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'browse_media',
                'table_name' => NULL,
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'browse_compass',
                'table_name' => NULL,
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'browse_menus',
                'table_name' => 'menus',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'read_menus',
                'table_name' => 'menus',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'edit_menus',
                'table_name' => 'menus',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'add_menus',
                'table_name' => 'menus',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'delete_menus',
                'table_name' => 'menus',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'browse_roles',
                'table_name' => 'roles',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'read_roles',
                'table_name' => 'roles',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'edit_roles',
                'table_name' => 'roles',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'add_roles',
                'table_name' => 'roles',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'key' => 'delete_roles',
                'table_name' => 'roles',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'key' => 'browse_users',
                'table_name' => 'users',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'key' => 'read_users',
                'table_name' => 'users',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'key' => 'edit_users',
                'table_name' => 'users',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'key' => 'add_users',
                'table_name' => 'users',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'key' => 'delete_users',
                'table_name' => 'users',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'key' => 'browse_posts',
                'table_name' => 'posts',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'key' => 'read_posts',
                'table_name' => 'posts',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'key' => 'edit_posts',
                'table_name' => 'posts',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'key' => 'add_posts',
                'table_name' => 'posts',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'key' => 'delete_posts',
                'table_name' => 'posts',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'key' => 'browse_categories',
                'table_name' => 'categories',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'key' => 'read_categories',
                'table_name' => 'categories',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'key' => 'edit_categories',
                'table_name' => 'categories',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'key' => 'add_categories',
                'table_name' => 'categories',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'key' => 'delete_categories',
                'table_name' => 'categories',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'key' => 'browse_settings',
                'table_name' => 'settings',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'key' => 'read_settings',
                'table_name' => 'settings',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'key' => 'edit_settings',
                'table_name' => 'settings',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'key' => 'add_settings',
                'table_name' => 'settings',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'key' => 'delete_settings',
                'table_name' => 'settings',
                'created_at' => '2017-10-22 02:31:10',
                'updated_at' => '2017-10-22 02:31:10',
                'permission_group_id' => NULL,
            ),
        ));
        
        
    }
}