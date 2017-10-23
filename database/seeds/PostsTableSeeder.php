<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $post = $this->findPost('intro');
        if (!$post->exists) {
            $post->fill([
                'title'            => 'Introducing Startup Engine',
                'category_id' => 1,
                'author_id'        => 0,
                'seo_title'        => null,
                'excerpt'          => 'This is a test post.',
                'body'             => '<p>This is the body of the post.</p>',
                'image'            => null,
                'slug'             => 'intro',
                'meta_description' => 'Startup Engine is a CMS designed for startups.',
                'meta_keywords'    => 'startup, cms, headless, api, theme, php, laravel',
                'status'           => 'PUBLISHED',
                'featured'         => 0,
            ])->save();
        }

        $post = $this->findPost('deploying');
        if (!$post->exists) {
            $post->fill([
                'title'            => 'How to deploy Startup Engine to Heroku',
                'category_id' => 2,
                'author_id'        => 0,
                'seo_title'        => null,
                'excerpt'          => 'This is a test post.',
                'body'             => '<p>This is the body of the post.</p>',
                'image'            => null,
                'slug'             => 'deploying',
                'meta_description' => 'Deploying Startup Engine to the cloud is easy.',
                'meta_keywords'    => 'startup, cms, headless, api, theme, php, laravel, heroku',
                'status'           => 'PUBLISHED',
                'featured'         => 0,
            ])->save();
        }

        $post = $this->findPost('pricing');
        if (!$post->exists) {
            $post->fill([
                'title'            => 'What does Startup Engine cost?',
                'category_id' => 3,
                'author_id'        => 0,
                'seo_title'        => null,
                'excerpt'          => 'This is a test post.',
                'body'             => '<p>This is the body of the post.</p>',
                'image'            => null,
                'slug'             => 'pricing',
                'meta_description' => 'Startup Engine is 100% free and open-source.',
                'meta_keywords'    => 'startup, cms, open-source, pricing',
                'status'           => 'PUBLISHED',
                'featured'         => 0,
            ])->save();
        }

        $post = $this->findPost('contributing');
        if (!$post->exists) {
            $post->fill([
                'title'            => 'How to contribute to Startup Engine',
                'category_id' => 4,
                'author_id'        => 0,
                'seo_title'        => null,
                'excerpt'          => 'This is a test post.',
                'body'             => '<p>This is the body of the post.</p>',
                'image'            => null,
                'slug'             => 'contributing',
                'meta_description' => 'Contribute to Startup Engine on Github.',
                'meta_keywords'    => 'startup engine, pen-source, contribute, github',
                'status'           => 'PUBLISHED',
                'featured'         => 0,
            ])->save();
        }

    }

    /**
     * [post description].
     *
     * @param [type] $slug [description]
     *
     * @return [type] [description]
     */
    protected function findPost($slug)
    {
        return Post::firstOrNew(['slug' => $slug]);
    }
}
