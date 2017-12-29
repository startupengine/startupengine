<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalyticEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analytic_events', function (Blueprint $table) {
            // Standard event data
            $table->increments('id');
            $table->json('instance')->nullable();
            $table->text('event_type')->nullable();
            $table->text('base_path')->nullable();
            $table->text('decoded_path')->nullable();
            $table->text('query_string')->nullable();
            $table->text('request_uri')->nullable();
            $table->text('scheme')->nullable();
            $table->text('scheme_and_host')->nullable();
            $table->text('full_url')->nullable();
            $table->longText('content')->nullable();
            $table->text('script_name')->nullable();
            $table->text('fingerprint')->nullable();
            $table->json('json')->nullable();
            $table->json('attributes')->nullable();
            $table->json('encodings')->nullable();
            $table->json('input')->nullable();
            $table->json('segments')->nullable();
            $table->json('server')->nullable();
            $table->json('headers')->nullable();
            $table->json('cookies')->nullable();
            $table->json('languages')->nullable();
            $table->json('session')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            // User/Session identifiers
            $table->text('user_email')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('user_name')->nullable();
            $table->text('user_agent')->nullable();
            $table->text('session_id')->nullable();
            $table->text('client_ip')->nullable();
            $table->json('client_ips')->nullable();
            $table->text('client_locale')->nullable();

            // Custom event data
            $table->json('event_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analytic_events');
    }
}
