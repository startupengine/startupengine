<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('text')->nullable();
            $table->text('image')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('platform_id')->nullable();
            $table->timestamp('published_at')->nullable();
            $table
                ->enum('status', [
                    'PUBLISHED',
                    'PENDING',
                    'APPROVED',
                    'UNPUBLISHED'
                ])
                ->default('UNPUBLISHED')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_posts');
    }
}
