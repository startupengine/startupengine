<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('author_id');
			$table->integer('category_id')->nullable();
			$table->string('title');
			$table->string('seo_title')->nullable();
			$table->text('excerpt', 65535)->nullable();
			$table->text('body', 65535);
			$table->string('splash_class')->nullable();
			$table->string('image')->nullable();
			$table->string('slug')->unique();
			$table->text('meta_description', 65535)->nullable();
			$table->text('meta_keywords', 65535)->nullable();
			$table->enum('status', array('PUBLISHED','DRAFT','PENDING'))->default('DRAFT');
			$table->binary('comments_enabled', 65535)->nullable();
			$table->boolean('featured')->default(0);
			$table->timestamps();
			$table->text('css')->nullable();
			$table->string('background_image')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
