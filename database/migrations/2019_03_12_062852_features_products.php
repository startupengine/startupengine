<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FeaturesProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_product', function (Blueprint $table) {
            $table->integer('feature_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->unique(['feature_id', 'product_id']);
            $table
                ->foreign('feature_id')
                ->references('id')
                ->on('features')
                ->onUpdate('cascade');
            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature_product');
    }
}
