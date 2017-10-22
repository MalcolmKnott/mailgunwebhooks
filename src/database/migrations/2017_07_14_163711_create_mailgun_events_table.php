<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailgunEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailgun_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->string('message_id')->nullable();
            $table->string('event')->nullable();
            $table->string('recipient')->nullable();
            $table->string('subject')->nullable();
            $table->string('domain')->nullable();
            $table->text('custom_variables')->nullable();
            $table->text('message_headers')->nullable();

            $table->string('code')->nullable();
            $table->string('error')->nullable();
            $table->string('notification')->nullable();
            $table->string('mailing_list')->nullable();

            $table->string('reason')->nullable();
            $table->string('description')->nullable();

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
        Schema::dropIfExists('mailgun_events');
    }
}
