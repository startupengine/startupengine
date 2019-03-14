<?php

use Illuminate\Database\Seeder;

class PreferencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        //Create default user preferences
        $files = scandir(storage_path('database/seeds/preferences'));
        foreach($files as $file) {
            if (strpos($file, '.json') !== false) {
                $location = storage_path('database/seeds/preferences/').$file;
                $contents = file_get_contents($location);
                $json = json_decode($contents);
                if($json != null) {
                    $preference = new \App\PreferenceSchema();
                    $preference->name = $json->slug;
                    $preference->description = $json->description;
                    $preference->key = $json->key;
                    $preference->json = json_encode($json);
                    $preference->save();
                }
                else {

                }
            }
        }

    }
}
