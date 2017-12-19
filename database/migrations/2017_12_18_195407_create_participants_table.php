<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lottery_id')->nullable();
            $table->string('email');
            $table->timestamps();

            $table->foreign('lottery_id')->references('id')->on('lotteries');
        });
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedInteger('participant_id')->nullable();
            $table->foreign('participant_id')->references('id')->on('participants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('participant_id');
        });
    }
}
