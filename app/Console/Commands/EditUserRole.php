<?php

namespace App\Console\Commands;

use App\Role;
use Illuminate\Console\Command;

class EditUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:EditUserRole {email} {roles} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->argument('email');
        $roles = $this->argument('roles');
        $roles = explode(',', $roles);
        $user = \App\User::where('email', '=', $email)->firstOrFail();
        $user->syncRoles($roles);
        echo "\n$user->email now has the following roles:\n";
        foreach ($roles as $role) {
            $roleRecord = Role::where("name", "=", $role)->first();
            echo $roleRecord->display_name . "\n";
        }
    }
}
