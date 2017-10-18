<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('posts')->delete();
        
        \DB::table('posts')->insert(array (
            0 => 
            array (
                'id' => 6,
                'author_id' => 1,
                'category_id' => 3,
                'title' => 'Generating revenue from comments',
                'seo_title' => NULL,
                'excerpt' => NULL,
                'body' => '<p style="text-align: center;">This post demonstrates how easy it is to enable third-party comments.</p>',
                'splash_class' => 'bg-dark',
                'image' => 'posts/October2017/glenn-carstens-peters-203007.jpg',
                'slug' => 'generating-revenue-from-comments',
                'meta_description' => 'This is a description...',
                'meta_keywords' => NULL,
                'status' => 'PUBLISHED',
                'comments_enabled' => '1',
                'featured' => 0,
                'created_at' => '2017-10-12 22:07:56',
                'updated_at' => '2017-10-16 12:34:57',
                'css' => NULL,
                'background_image' => NULL,
            ),
            1 => 
            array (
                'id' => 8,
                'author_id' => 1,
                'category_id' => 6,
                'title' => 'Post with video',
                'seo_title' => NULL,
                'excerpt' => NULL,
            'body' => '<p>StartupEngine features a rich text editor (courtesy of <a href="https://laravelvoyager.com/" target="_blank" rel="noopener noreferrer">Laravel Voyager</a>), which makes posting media from external sources such as Youtube and Giphy a snap.</p>
<p style="text-align: center;"><iframe title="Star Wars: The Force Awakens Official Teaser" src="https://www.youtube.com/embed/erLk59H86ww?wmode=opaque&amp;theme=dark" width="560" height="400" frameborder="0" allowfullscreen="">
</iframe></p>',
                'splash_class' => 'bg-black',
                'image' => 'posts/October2017/jakob-owens-1982341.jpg',
                'slug' => 'post-with-video-2',
                'meta_description' => 'This is a multi-line, very long description with many words, and it makes this post larger than the others...',
                'meta_keywords' => NULL,
                'status' => 'PUBLISHED',
                'comments_enabled' => '0',
                'featured' => 0,
                'created_at' => '2017-10-12 19:10:04',
                'updated_at' => '2017-10-17 07:12:31',
                'css' => NULL,
                'background_image' => NULL,
            ),
            2 => 
            array (
                'id' => 9,
                'author_id' => 1,
                'category_id' => 3,
                'title' => 'Integrating Analytics',
                'seo_title' => NULL,
                'excerpt' => NULL,
            'body' => '<p>StartupEngine features a rich text editor (courtesy of <a href="https://laravelvoyager.com/" target="_blank" rel="noopener noreferrer">Laravel Voyager</a>), which makes posting media from external sources such as Youtube and Giphy a snap.</p>
<p style="text-align: center;"><iframe title="Star Wars: The Force Awakens Official Teaser" src="https://www.youtube.com/embed/erLk59H86ww?wmode=opaque&amp;theme=dark" width="560" height="400" frameborder="0" allowfullscreen="">
</iframe></p>',
                'splash_class' => 'bg-black',
                'image' => 'posts/October2017/ilya-pavlov-874381.jpg',
                'slug' => 'integrating-analytics',
                'meta_description' => 'This is a multi-line, very long description with many words, and it makes this post larger than the others...',
                'meta_keywords' => NULL,
                'status' => 'PUBLISHED',
                'comments_enabled' => '0',
                'featured' => 0,
                'created_at' => '2017-10-12 19:10:04',
                'updated_at' => '2017-10-16 12:34:35',
                'css' => NULL,
                'background_image' => NULL,
            ),
        ));
        
        
    }
}