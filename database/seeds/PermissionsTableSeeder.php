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

        //Create basic app permissions
        Permission::create(['guard_name' => 'web', 'name' => 'view backend']);
        Permission::create(['guard_name' => 'web', 'name' => 'view own profile']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit own profile']);

        Permission::create(['guard_name' => 'web', 'name' => 'view analytics']);

        Permission::create(['guard_name' => 'web', 'name' => 'browse pages']);
        Permission::create(['guard_name' => 'web', 'name' => 'read pages']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit pages']);
        Permission::create(['guard_name' => 'web', 'name' => 'add pages']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete pages']);
        Permission::create(['guard_name' => 'web', 'name' => 'browse own pages']);
        Permission::create(['guard_name' => 'web', 'name' => 'read own pages']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit own pages']);
        Permission::create(['guard_name' => 'web', 'name' => 'add own pages']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete own pages']);

        Permission::create(['guard_name' => 'web', 'name' => 'undelete pages']);
        Permission::create(['guard_name' => 'web', 'name' => 'publish pages']);

        Permission::create(['guard_name' => 'web', 'name' => 'browse posts']);
        Permission::create(['guard_name' => 'web', 'name' => 'read posts']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit posts']);
        Permission::create(['guard_name' => 'web', 'name' => 'add posts']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete posts']);
        Permission::create(['guard_name' => 'web', 'name' => 'browse own posts']);
        Permission::create(['guard_name' => 'web', 'name' => 'read own posts']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit own posts']);
        Permission::create(['guard_name' => 'web', 'name' => 'add own posts']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete own posts']);
        Permission::create(['guard_name' => 'web', 'name' => 'undelete posts']);
        Permission::create(['guard_name' => 'web', 'name' => 'publish posts']);

        Permission::create(['guard_name' => 'web', 'name' => 'manage api settings']);
        Permission::create(['guard_name' => 'web', 'name' => 'browse api tokens']);
        Permission::create(['guard_name' => 'web', 'name' => 'read api tokens']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit api tokens']);
        Permission::create(['guard_name' => 'web', 'name' => 'add api tokens']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete api tokens']);
        Permission::create(['guard_name' => 'web', 'name' => 'browse api clients']);
        Permission::create(['guard_name' => 'web', 'name' => 'read api clients']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit api clients']);
        Permission::create(['guard_name' => 'web', 'name' => 'add api clients']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete api clients']);

        Permission::create(['guard_name' => 'web', 'name' => 'read text fields']);
        Permission::create(['guard_name' => 'web', 'name' => 'write text fields']);
        Permission::create(['guard_name' => 'web', 'name' => 'read richtext fields']);
        Permission::create(['guard_name' => 'web', 'name' => 'write richtext fields']);
        Permission::create(['guard_name' => 'web', 'name' => 'read code fields']);
        Permission::create(['guard_name' => 'web', 'name' => 'write code fields']);

        Permission::create(['guard_name' => 'web', 'name' => 'browse packages']);
        Permission::create(['guard_name' => 'web', 'name' => 'read packages']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit packages']);
        Permission::create(['guard_name' => 'web', 'name' => 'add packages']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete packages']);

        Permission::create(['guard_name' => 'web', 'name' => 'browse settings']);
        Permission::create(['guard_name' => 'web', 'name' => 'read settings']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit settings']);
        Permission::create(['guard_name' => 'web', 'name' => 'add settings']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete settings']);

        Permission::create(['guard_name' => 'web', 'name' => 'browse users']);
        Permission::create(['guard_name' => 'web', 'name' => 'read users']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit users']);
        Permission::create(['guard_name' => 'web', 'name' => 'add users']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete users']);

        //Assign permissions to roles

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

        //Executive
        $role = Role::where('name', '=', 'analyst')->first();
        $role->givePermissionTo('view backend');
        $role->givePermissionTo('view analytics');

        //Admin
        $role = Role::where('name', '=', 'admin')->first();
        $role->givePermissionTo('view backend');
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
