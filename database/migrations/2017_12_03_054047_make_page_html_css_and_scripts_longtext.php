<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakePageHtmlCssAndScriptsLongtext extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::table('pages', function (Blueprint $table) {
            $table->longText('html')->nullable()->default(null)->change();
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->longText('css')->nullable()->default(null)->change();
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->longText('scripts')->nullable()->default(null)->change();
        });
        */

        /*
        Manual SQL, because Doctrine currently has a bug about renaming columns on tables with JSON columns
        see: https://github.com/laravel/framework/issues/1186#issuecomment-96634565
        DB::statement('ALTER TABLE pages CHANGE html css scripts LONGTEXT;');
        */

        DB::statement('ALTER TABLE pages ALTER COLUMN html TYPE TEXT;');
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
