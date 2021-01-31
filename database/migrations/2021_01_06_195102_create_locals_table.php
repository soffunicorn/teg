<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locals', function (Blueprint $table) {
            $table->id();
            $table->string('n_local');
            $table->timestamps();


            //Index
            $table->unsignedBigInteger('id_state')->unsigned()
                ->index()
                ->nullable();

            //Foreign key
            $table->foreign('id_state')
                ->references('id')
                ->on('states');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locals');
    }
}
