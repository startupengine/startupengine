<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncSettings';

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
        $settings = \App\Setting::all();
        foreach ($settings as $setting) {
            $setting->delete();
        }
        $files = scandir(storage_path() . '/schemas/settings');
        foreach ($files as $file) {
            if (strpos($file, '.json')) {
                $json = json_decode(
                    file_get_contents(
                        storage_path() . '/schemas/settings/' . $file
                    )
                );

                $key = str_replace('.json', '', $file);

                $setting = \App\Setting::where('key', $key)->first();

                if ($setting == null) {
                    $setting = new \App\Setting();
                }
                $setting->display_name = $key;
                $setting->details = $key;
                $setting->type = "text";
                $setting->status = "PUBLISHED";
                $setting->key = $file;
                $setting->json = json_encode($json);

                $setting->save();
            }
        }
    }
}
