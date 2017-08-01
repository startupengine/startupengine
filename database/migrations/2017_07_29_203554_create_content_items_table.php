<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_items', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('rawtext')->nullable();
            $table->text('space');
            $table->text('uid');
            $table->text('version');
            $table->text('title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('content')->nullable();
            $table->longText('watson_analysis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_items', function (Blueprint $table) {
            Schema::drop('content_items');
        });
    }
}