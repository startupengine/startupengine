<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPostNullableFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $platform = \DB::getDoctrineSchemaManager()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');

        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'excerpt')) {
                $table
                    ->text('excerpt')
                    ->nullable()
                    ->change();
            }
            if (Schema::hasColumn('posts', 'meta_description')) {
                $table
                    ->text('meta_description')
                    ->nullable()
                    ->change();
            }
            if (Schema::hasColumn('posts', 'meta_keywords')) {
                $table
                    ->text('meta_keywords')
                    ->nullable()
                    ->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'excerpt')) {
                $table->text('excerpt')->change();
            }
            if (Schema::hasColumn('posts', 'meta_description')) {
                $table->text('meta_description')->change();
            }
            if (Schema::hasColumn('posts', 'meta_keywords')) {
                $table->text('meta_keywords')->change();
            }
        });
    }
}
