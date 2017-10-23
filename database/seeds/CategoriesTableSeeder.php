<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::firstOrNew([
            'slug' => 'articles',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => 'Articles',
                'status'       => 'PUBLISHED',
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug' => 'tutorials',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => 'Tutorials',
                'status'       => 'PUBLISHED',
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug' => 'frequently-asked-questions',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => 'Frequently Asked Questions',
                'status'       => 'PUBLISHED',
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug' => 'documentation',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => 'Documentation',
                'status'       => 'PUBLISHED',
            ])->save();
        }
    }
}
