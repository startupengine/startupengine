<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNlpEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nlp_entities', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('nlp_result_id')->nullable();
            $table->text('type')->nullable();
            $table->text('key')->nullable();
            $table->decimal('value')->nullable();
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
        Schema::dropIfExists('nlp_entities');
    }
}
