<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropVoyagerPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permission_groups');


        if (Schema::hasColumn('permissions', 'permission_group_id')) ;
        {
            Schema::table('permissions', function (Blueprint $table) {
                $table->dropColumn(['permission_group_id']);
            });
        }

        if (Schema::hasColumn('permissions', 'key')) ;
        {
            Schema::table('permissions', function (Blueprint $table) {
                $table->dropColumn(['key']);
            });
        }

        if (Schema::hasColumn('permissions', 'table_name')) ;
        {
            Schema::table('permissions', function (Blueprint $table) {
                $table->dropColumn(['table_name']);
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

    }
}