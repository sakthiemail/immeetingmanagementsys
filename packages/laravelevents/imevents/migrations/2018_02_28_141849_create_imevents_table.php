<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImeventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imevents', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->integer('type')->unsigned()->default('0');
            $table->string('subject');
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->text('location')->nullable();
            $table->tinyInteger('billable')->default('0');
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('active')->default('1');
            $table->text('reason')->nullable();
            $table->foreign("user_id")->references('id')->on('users');
            $table->foreign("updated_by")->references('id')->on('users');
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
        Schema::drop("imevents");
    }
}
