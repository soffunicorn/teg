<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            //Index
            $table->unsignedBigInteger('id_log')->unsigned()
                ->index()
                ->nullable();
            $table->unsignedBigInteger('id_incident')->unsigned()
                ->index()
                ->nullable();

            //Foreign key
            $table->foreign('id_log')
                ->references('id')
                ->on('logs');
            $table->foreign('id_incident')
                ->references('id')
                ->on('incidents');


        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
