<?php

use Illuminate\Database\Seeder;

class PostTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . '/schemas/post_types';

        $files = scandir($path);

        foreach ($files as $file) {
            if (strpos($file, '.json') !== false) {
                $postType = new \App\PostType();
                $json = json_decode(file_get_contents($path . '/' . $file));
                $postType->json = file_get_contents($path . '/' . $file);
                $postType->title = ucwords($json->lang->en->singular);
                $postType->slug = $json->lang->en->singular;
                $postType->enabled = true;
                $postType->save();
            }
        }
    }
}
