<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {

        //Home
        $page = Page::firstOrNew([
            'slug' => 'hello-world',
        ]);
        if (!$page->exists) {
            $page->fill([
                'author_id' => 0,
                'title'     => 'Startup Engine',
                'slug'     => 'home',
                'excerpt'   => 'Startup Engine is an API-based CMS for startups.',
                'body'      => null,
                'image'            => null,
                'meta_description' => 'Startup Engine is an API-based CMS for startups.',
                'meta_keywords'    => 'startup, cms, api, laravel',
                'status'           => 'ACTIVE',
            ])->save();
        }

        //Articles
        $page = Page::firstOrNew([
            'slug' => 'articles',
        ]);
        if (!$page->exists) {
            $page->fill([
                'author_id' => 0,
                'title'     => 'The Launchpad',
                'slug'     => 'articles',
                'excerpt'   => 'A blog about starting up and taking off.',
                'body'      => null,
                'image'            => null,
                'meta_description' => 'A blog about starting up and taking off.',
                'meta_keywords'    => 'startup, cms, api, content marketing, lean, metrics, analytics',
                'status'           => 'ACTIVE',
            ])->save();
        }

        //Search
        $page = Page::firstOrNew([
            'slug' => 'search',
        ]);
        if (!$page->exists) {
            $page->fill([
                'author_id' => 0,
                'title'     => 'Search',
                'slug'     => 'search',
                'excerpt'   => 'Startup Engine is an API-based CMS for startups.',
                'body'      => null,
                'image'            => null,
                'meta_description' => 'Startup Engine is an API-based CMS for startups.',
                'meta_keywords'    => 'startup, cms, api, laravel',
                'status'           => 'ACTIVE',
            ])->save();
        }

        //Search
        $page = Page::firstOrNew([
            'slug' => 'help',
        ]);
        if (!$page->exists) {
            $page->fill([
                'author_id' => 0,
                'title'     => 'Help & Documentation',
                'slug'     => 'help',
                'excerpt'   => 'Get answers to FAQs about Startup Engine.',
                'body'      => null,
                'image'            => null,
                'meta_description' => 'Get answers to FAQs about Startup Engine.',
                'meta_keywords'    => 'startup engine, help, documentation, install',
                'status'           => 'ACTIVE',
            ])->save();
        }

        //Browse
        $page = Page::firstOrNew([
            'slug' => 'browse',
        ]);
        if (!$page->exists) {
            $page->fill([
                'author_id' => 0,
                'title'     => 'Browse by category',
                'slug'     => 'browse',
                'excerpt'   => 'Browse content by category.',
                'body'      => null,
                'image'            => null,
                'meta_description' => 'Browse content by category.',
                'meta_keywords'    => 'startup engine, help, documentation, blog, articles',
                'status'           => 'ACTIVE',
            ])->save();
        }

    }
}
