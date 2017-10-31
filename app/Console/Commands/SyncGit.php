<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncGit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncGit';

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
        $path = \Config::get('view.paths')[0].'/theme';
        exec('rm -rf '.escapeshellarg($path));
        if(config('app.template_git_username') !== null && config('app.template_git_password') !== null) {
            exec("git clone https://" . config('app.template_git_username') . ":" . config('app.template_git_password') . "@github.com/" . config('app.template_git_username') . "/" . config('app.template_git_repository') . ".git resources/views/theme");
        }
        else {
            exec("git clone https://github.com/" . config('app.template_git_username') . "/" . config('app.template_git_repository') . ".git resources/views/theme");
        }
    }
}
