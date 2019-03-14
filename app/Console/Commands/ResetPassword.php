<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ResetPassword {email} {show?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset a user\'s passowrd.';

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
        $show = $this->argument('show');
        $password = $this->argument('password');
        $user = \App\User::where('email', '=', $email)->firstOrFail();
        if ($password == null) {
            $password = Hash::make(Str::random(13));
        }
        $user->password = bcrypt($password);
        $user->save();
        if ($show) {
            echo("New password: $password \n");
        } else {
            echo "Password reset. \n";
        }
    }
}
