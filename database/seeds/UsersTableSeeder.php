<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $pass = 'password';

        if (User::count() == 0) {
            //Admin user
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'status' => 'ACTIVE',
                'password' => 'password',
                'remember_token' => Str::random(60)
            ]);
            $user->assignRole('admin');
            $user->assignRole('staff');
            $user->assignRole('executive');
            $user->assignRole('analyst');
            $user->assignRole('writer');
            $user->assignRole('developer');
            $user->assignRole('editor');
            $user->assignRole('user');

            //Regular user
            $user = User::create([
                'name' => 'Kevin Flynn',
                'email' => 'user@example.com',
                'password' => 'password',
                'remember_token' => Str::random(60)
            ]);
            $user->assignRole('user');
            $user->assignRole('staff');

            //Writer
            $user = User::create([
                'name' => 'Aaron Sorkin',
                'email' => 'writer@example.com',
                'password' => 'password',
                'remember_token' => Str::random(60)
            ]);
            $user->assignRole('writer');
            $user->assignRole('staff');

            //Editor
            $user = User::create([
                'name' => 'Ira Glass',
                'email' => 'editor@example.com',
                'password' => 'password',
                'remember_token' => Str::random(60)
            ]);
            $user->assignRole('editor');
            $user->assignRole('staff');

            //Developer
            $user = User::create([
                'name' => 'Linus Torvalds',
                'email' => 'developer@example.com',
                'password' => 'password',
                'remember_token' => Str::random(60)
            ]);
            $user->assignRole('developer');
            $user->assignRole('staff');

            //Executive
            $user = User::create([
                'name' => 'Steve Jobs',
                'email' => 'executive@example.com',
                'password' => 'password',
                'remember_token' => Str::random(60)
            ]);
            $user->assignRole('executive');
            $user->assignRole('staff');

            //Analyst
            $user = User::create([
                'name' => 'Nate Silver',
                'email' => 'analyst@example.com',
                'password' => 'password',
                'remember_token' => Str::random(60)
            ]);
            $user->assignRole('analyst');
            $user->assignRole('staff');
        }
    }
}
