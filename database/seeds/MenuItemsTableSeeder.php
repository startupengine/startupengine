<?php

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu_items')->delete();
        
        \DB::table('menu_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'menu_id' => 1,
                'title' => 'Dashboard',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-boat',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 1,
                'created_at' => '2017-10-12 04:36:24',
                'updated_at' => '2017-10-12 04:36:24',
                'route' => 'voyager.dashboard',
                'parameters' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'menu_id' => 1,
                'title' => 'Media',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-images',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 7,
                'created_at' => '2017-10-12 04:36:24',
                'updated_at' => '2017-10-14 02:26:39',
                'route' => 'voyager.media.index',
                'parameters' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'menu_id' => 1,
                'title' => 'Posts',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-news',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 6,
                'created_at' => '2017-10-12 04:36:24',
                'updated_at' => '2017-10-14 02:26:39',
                'route' => 'voyager.posts.index',
                'parameters' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'menu_id' => 1,
                'title' => 'Users',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-person',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 2,
                'created_at' => '2017-10-12 04:36:24',
                'updated_at' => '2017-10-14 02:26:27',
                'route' => 'voyager.users.index',
                'parameters' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'menu_id' => 1,
                'title' => 'Categories',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-categories',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 4,
                'created_at' => '2017-10-12 04:36:24',
                'updated_at' => '2017-10-14 02:26:35',
                'route' => 'voyager.categories.index',
                'parameters' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'menu_id' => 1,
                'title' => 'Pages',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-file-text',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 5,
                'created_at' => '2017-10-12 04:36:24',
                'updated_at' => '2017-10-14 02:26:39',
                'route' => 'voyager.pages.index',
                'parameters' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'menu_id' => 1,
                'title' => 'Roles',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-lock',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 3,
                'created_at' => '2017-10-12 04:36:24',
                'updated_at' => '2017-10-14 02:26:27',
                'route' => 'voyager.roles.index',
                'parameters' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'menu_id' => 1,
                'title' => 'Menu Builder',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-list',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 11,
                'created_at' => '2017-10-12 04:36:24',
                'updated_at' => '2017-10-14 02:27:04',
                'route' => 'voyager.menus.index',
                'parameters' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'menu_id' => 1,
                'title' => 'Database',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-data',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 8,
                'created_at' => '2017-10-12 04:36:24',
                'updated_at' => '2017-10-14 02:27:04',
                'route' => 'voyager.database.index',
                'parameters' => NULL,
            ),
            9 => 
            array (
                'id' => 11,
                'menu_id' => 1,
                'title' => 'Compass',
                'url' => '/admin/compass',
                'target' => '_self',
                'icon_class' => 'voyager-compass',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 9,
                'created_at' => '2017-10-12 04:36:24',
                'updated_at' => '2017-10-14 02:27:04',
                'route' => NULL,
                'parameters' => NULL,
            ),
            10 => 
            array (
                'id' => 12,
                'menu_id' => 1,
                'title' => 'Hooks',
                'url' => '/admin/hooks',
                'target' => '_self',
                'icon_class' => 'voyager-hook',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 10,
                'created_at' => '2017-10-12 04:36:24',
                'updated_at' => '2017-10-14 02:27:04',
                'route' => NULL,
                'parameters' => NULL,
            ),
            11 => 
            array (
                'id' => 13,
                'menu_id' => 1,
                'title' => 'Settings',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-settings',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 12,
                'created_at' => '2017-10-12 04:36:24',
                'updated_at' => '2017-10-14 02:26:27',
                'route' => 'voyager.settings.index',
                'parameters' => NULL,
            ),
            12 => 
            array (
                'id' => 17,
                'menu_id' => 2,
                'title' => 'Features',
                'url' => '/',
                'target' => '_self',
                'icon_class' => NULL,
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 1,
                'created_at' => '2017-10-12 23:54:32',
                'updated_at' => '2017-10-14 23:34:32',
                'route' => NULL,
                'parameters' => '',
            ),
            13 => 
            array (
                'id' => 18,
                'menu_id' => 2,
                'title' => 'Support',
                'url' => '/forums',
                'target' => '_self',
                'icon_class' => NULL,
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 4,
                'created_at' => '2017-10-13 18:58:01',
                'updated_at' => '2017-10-15 03:35:56',
                'route' => NULL,
                'parameters' => '',
            ),
            14 => 
            array (
                'id' => 19,
                'menu_id' => 2,
                'title' => 'Help',
                'url' => '/help',
                'target' => '_self',
                'icon_class' => NULL,
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 3,
                'created_at' => '2017-10-14 20:34:35',
                'updated_at' => '2017-10-15 01:57:01',
                'route' => NULL,
                'parameters' => '',
            ),
            15 => 
            array (
                'id' => 20,
                'menu_id' => 2,
                'title' => 'Articles',
                'url' => '/articles',
                'target' => '_self',
                'icon_class' => NULL,
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 2,
                'created_at' => '2017-10-15 01:56:45',
                'updated_at' => '2017-10-15 01:57:45',
                'route' => NULL,
                'parameters' => '',
            ),
        ));
        
        
    }
}