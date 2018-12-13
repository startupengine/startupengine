<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->text('description')->nullable();
        });
        Schema::table('packages', function (Blueprint $table) {
            $table->decimal('version')->nullable();
        });
        Schema::table('packages', function (Blueprint $table) {
            $table->json('json')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('version');
            $table->dropColumn('json');
        });
    }
}
