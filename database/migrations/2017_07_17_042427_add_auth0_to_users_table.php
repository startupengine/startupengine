<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuth0ToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('auth0id', 244);
            $table->string('picture', 244)->nullable();
            $table->string('picture_large', 244)->nullable();
            $table->string('gender', 244)->nullable();
            $table->string('given_name', 244)->nullable();
            $table->string('family_name', 244)->nullable();
            $table->string('locale', 244)->nullable();
        });
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
