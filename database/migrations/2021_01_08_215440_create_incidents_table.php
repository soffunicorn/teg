<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description', 3000);
            $table->string('slug');
            $table->string('priority');
            $table->dateTime('deathline');
            $table->timestamps();
            //Index
            $table->unsignedBigInteger('id_departament')->unsigned()
                ->index()
                ->nullable();
            $table->unsignedBigInteger('id_local')->unsigned()
                ->index()
                ->nullable();

            //Foreign key
            $table->foreign('id_departament')
                ->references('id')
                ->on('departments');

            $table->foreign('id_local')
                ->references('id')
                ->on('locals');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidents');
    }
}
