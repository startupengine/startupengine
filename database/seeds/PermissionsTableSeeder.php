<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create core app permissions

        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'view backend'
        ]);

        //Users
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'view own profile'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'edit own profile'
        ]);

        //Analytics
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'view analytics'
        ]);

        //Pages
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'browse pages'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read pages'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'edit pages'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'add pages'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'delete pages'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'browse own pages'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read own pages'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'edit own pages'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'add own pages'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'delete own pages'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'undelete pages'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'publish pages'
        ]);

        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'browse posts'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read posts'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'edit posts'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'add posts'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'delete posts'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'browse own posts'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read own posts'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'edit own posts'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'add own posts'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'delete own posts'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'undelete posts'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'publish posts'
        ]);

        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'manage api settings'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'browse api tokens'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read api tokens'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'edit api tokens'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'add api tokens'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'delete api tokens'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'browse api clients'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read api clients'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'edit api clients'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'add api clients'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'delete api clients'
        ]);

        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read text fields'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'write text fields'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read richtext fields'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'write richtext fields'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read code fields'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'write code fields'
        ]);

        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'browse packages'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read packages'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'edit packages'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'add packages'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'delete packages'
        ]);

        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'browse settings'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read settings'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'edit settings'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'add settings'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'delete settings'
        ]);

        //Users
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'browse users'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read users'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'edit users'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'add users'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'delete users'
        ]);

        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'browse roles'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read roles'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'edit roles'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'add roles'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'delete roles'
        ]);

        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'browse content types'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read content types'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'edit content types'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'add content types'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'delete content types'
        ]);

        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'browse permissions'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read permissions'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'edit permissions'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'add permissions'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'delete permissions'
        ]);

        //Promos
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'browse promos'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'read promos'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'edit promos'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'add promos'
        ]);
        Permission::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'delete promos'
        ]);

        ////////////////////////////////
        //Assign permissions to roles//
        //////////////////////////////

        //Users
        $role = Role::where('name', '=', 'user')->first();
        $role->givePermissionTo('view own profile');
        $role->givePermissionTo('edit own profile');

        //Staff
        $role = Role::where('name', '=', 'staff')->first();
        $role->givePermissionTo('view backend');
        $role->givePermissionTo('view own profile');
        $role->givePermissionTo('edit own profile');

        //Executive
        $role = Role::where('name', '=', 'executive')->first();
        $role->givePermissionTo('view backend');
        $role->givePermissionTo('view analytics');

        //Analyst
        $role = Role::where('name', '=', 'analyst')->first();
        $role->givePermissionTo('view backend');
        $role->givePermissionTo('view analytics');

        //Marketer
        $role = Role::where('name', '=', 'marketer')->first();
        $role->givePermissionTo('view backend');
        $role->givePermissionTo('browse promos');
        $role->givePermissionTo('read promos');
        $role->givePermissionTo('edit promos');
        $role->givePermissionTo('add promos');
        $role->givePermissionTo('delete promos');

        //Admin
        $role = Role::where('name', '=', 'admin')->first();
        $role->givePermissionTo('view backend');
        $role->givePermissionTo('browse users');
        $role->givePermissionTo('browse pages');
        $role->givePermissionTo('read pages');
        $role->givePermissionTo('edit pages');
        $role->givePermissionTo('add pages');
        $role->givePermissionTo('delete pages');

        $role->givePermissionTo('browse posts');
        $role->givePermissionTo('read posts');
        $role->givePermissionTo('edit posts');
        $role->givePermissionTo('add posts');
        $role->givePermissionTo('delete posts');

        $role->givePermissionTo('browse packages');
        $role->givePermissionTo('read packages');
        $role->givePermissionTo('edit packages');
        $role->givePermissionTo('add packages');
        $role->givePermissionTo('delete packages');

        $role->givePermissionTo('browse users');
        $role->givePermissionTo('read users');
        $role->givePermissionTo('edit users');
        $role->givePermissionTo('add users');
        $role->givePermissionTo('delete users');

        $role->givePermissionTo('browse settings');
        $role->givePermissionTo('read settings');
        $role->givePermissionTo('edit settings');
        $role->givePermissionTo('add settings');
        $role->givePermissionTo('delete settings');

        $role->givePermissionTo('manage api settings');

        $role->givePermissionTo('browse api tokens');
        $role->givePermissionTo('read api tokens');
        $role->givePermissionTo('edit api tokens');
        $role->givePermissionTo('add api tokens');
        $role->givePermissionTo('delete api tokens');

        $role->givePermissionTo('browse api clients');
        $role->givePermissionTo('read api clients');
        $role->givePermissionTo('edit api clients');
        $role->givePermissionTo('add api clients');
        $role->givePermissionTo('delete api clients');

        $role->givePermissionTo('browse roles');
        $role->givePermissionTo('read roles');
        $role->givePermissionTo('edit roles');
        $role->givePermissionTo('add roles');
        $role->givePermissionTo('delete roles');

        $role->givePermissionTo('browse permissions');
        $role->givePermissionTo('read permissions');
        $role->givePermissionTo('edit permissions');
        $role->givePermissionTo('add permissions');
        $role->givePermissionTo('delete permissions');

        $role->givePermissionTo('browse content types');
        $role->givePermissionTo('read content types');
        $role->givePermissionTo('edit content types');
        $role->givePermissionTo('add content types');
        $role->givePermissionTo('delete content types');

        $role->givePermissionTo('browse promos');
        $role->givePermissionTo('read promos');
        $role->givePermissionTo('edit promos');
        $role->givePermissionTo('add promos');
        $role->givePermissionTo('delete promos');

        //Editors
        $role = Role::where('name', '=', 'editor')->first();

        $role->givePermissionTo('view backend');

        $role->givePermissionTo('read text fields');
        $role->givePermissionTo('write text fields');

        $role->givePermissionTo('read richtext fields');
        $role->givePermissionTo('write richtext fields');

        $role->givePermissionTo('publish pages');
        $role->givePermissionTo('publish posts');

        $role->givePermissionTo('browse pages');
        $role->givePermissionTo('read pages');
        $role->givePermissionTo('edit pages');
        $role->givePermissionTo('delete pages');
        $role->givePermissionTo('undelete pages');

        $role->givePermissionTo('browse posts');
        $role->givePermissionTo('read posts');
        $role->givePermissionTo('edit posts');
        $role->givePermissionTo('delete posts');
        $role->givePermissionTo('undelete posts');

        //Writers
        $role = Role::where('name', '=', 'writer')->first();

        $role->givePermissionTo('view backend');

        $role->givePermissionTo('read text fields');
        $role->givePermissionTo('write text fields');

        $role->givePermissionTo('read richtext fields');
        $role->givePermissionTo('write richtext fields');

        $role->givePermissionTo('browse own pages');
        $role->givePermissionTo('read own pages');
        $role->givePermissionTo('edit own pages');
        $role->givePermissionTo('add pages');
        $role->givePermissionTo('delete own pages');

        $role->givePermissionTo('browse own posts');
        $role->givePermissionTo('read own posts');
        $role->givePermissionTo('edit own posts');
        $role->givePermissionTo('add posts');
        $role->givePermissionTo('delete own posts');

        //Developers
        $role = Role::where('name', '=', 'developer')->first();

        $role->givePermissionTo('view backend');

        $role->givePermissionTo('read code fields');
        $role->givePermissionTo('write code fields');

        $role->givePermissionTo('browse pages');
        $role->givePermissionTo('read pages');
        $role->givePermissionTo('edit pages');

        $role->givePermissionTo('browse posts');
        $role->givePermissionTo('read posts');
        $role->givePermissionTo('edit posts');
    }
}
