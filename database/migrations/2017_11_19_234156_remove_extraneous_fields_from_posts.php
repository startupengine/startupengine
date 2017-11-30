<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveExtraneousFieldsFromPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('posts', 'body')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('body');
            });
        }
        if (Schema::hasColumn('posts', 'image')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
        if (Schema::hasColumn('posts', 'seo_title')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('seo_title');
            });
        }
        if (Schema::hasColumn('posts', 'excerpt')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('excerpt');
            });
        }
        if (Schema::hasColumn('posts', 'meta_description')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('meta_description');
            });
        }
        if (Schema::hasColumn('posts', 'meta_keywords')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('meta_keywords');
            });
        }
        if (Schema::hasColumn('posts', 'featured')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('featured');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
