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
                $concat = explode('.', $key);
                if (count($concat) > 0) {
                    $group = $concat[0];
                }

                $setting = \App\Setting::where('key', $key)->first();

                if ($setting == null) {
                    $setting = new \App\Setting();
                }
                $setting->display_name = $key;
                $setting->details = $key;
                $setting->type = "text";
                $setting->status = "PUBLISHED";
                $setting->key = $key;
                $setting->group = $group;
                $setting->schema = json_encode($json);
                $setting->save();
                if (
                    $group != null &&
                    $concat[1] == 'settings_description' &&
                    isset($setting->schema()->defaults->value)
                ) {
                    $value = $setting->schema()->defaults->value;
                    $setting->value = $value;
                    $setting->save();
                }

                if (
                    isset($setting->schema()->defaults->value) &&
                    !isset($setting->value)
                ) {
                    $setting->value = $setting->schema()->defaults->value;
                    $setting->save();
                }
            }
        }
    }
}
