<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailgunTrackingEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailgun_tracking_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mailgun_event_id')->unsigned()->index()->nullable();
            $table->string('message_id')->nullable();
            $table->string('event')->nullable();
            $table->string('recipient')->nullable();
            $table->string('domain')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->string('device_type')->nullable();
            $table->string('client_name')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('client_os')->nullable();
            $table->string('client_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailgun_tracking_events');
    }
}
