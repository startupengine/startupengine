<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNlpResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nlp_results', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('source_id')->nullable();
            $table->text('source_model')->nullable();
            $table->text('url')->nullable();
            $table->text('service')->nullable();
            $table->text('source_text')->nullable();
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
        Schema::dropIfExists('nlp_results');
    }
}
