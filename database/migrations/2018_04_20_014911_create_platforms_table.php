<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platforms', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->text('app_id')->nullable();
            $table->text('app_id_name')->nullable();
            $table->text('app_id_description')->nullable();
            $table->text('public_key')->nullable();
            $table->text('public_key_name')->nullable();
            $table->text('public_key_description')->nullable();
            $table->text('private_key')->nullable();
            $table->text('private_key_description')->nullable();
            $table->text('private_key_name')->nullable();
            $table->text('consumer_key')->nullable();
            $table->text('consumer_key_description')->nullable();
            $table->text('consumer_key_name')->nullable();
            $table->text('access_key')->nullable();
            $table->text('access_key_description')->nullable();
            $table->text('access_key_name')->nullable();
            $table->enum('status', ['PUBLISHED', 'PENDING', 'APPROVED', 'UNPUBLISHED'])->default('UNPUBLISHED')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('platforms');
    }
}
