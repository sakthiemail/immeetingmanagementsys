<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemaindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remainders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('imevent_id')->unsigned();
            $table->string('interval')->nullable();
            $table->datetime('remainder_sent')->nullable();
            $table->foreign("imevent_id")->references('id')->on('imevents');
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
        Schema::dropIfExists('remainders');
    }
}
