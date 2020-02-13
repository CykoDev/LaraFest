<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventables', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->unsignedBigInteger('event_id')->unsigned()->index();
            $table->unsignedBigInteger('eventable_id')->index();
            $table->string('eventable_type');
            $table->unsignedBigInteger('user_id')->unsigned()->index();
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
        Schema::table('eventables', function (Blueprint $table) {
            //
        });
    }
}
