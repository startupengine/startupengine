<?php

namespace App\Console\Commands;

use Caffeinated\Modules\Facades\Module;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SyncModules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncModules';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Record any installed modules to the database.';

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
        $modules = Module::all();
        foreach ($modules as $module) {
            $current = \App\Module::where(
                'slug',
                '=',
                $module['slug']
            )->first();
            if ($current == null) {
                $newmodule = new \App\Module();
                $newmodule->slug = $module['slug'];
                $newmodule->save();
            }
        }
    }
}
