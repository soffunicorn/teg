<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('business_reason'); //razon social
            $table->string('rif');
            $table->string('slug'); //
            $table->string('telephone');
            $table->string('email');

            $table->time('schedule_from');
            $table->time('schedule_to');
            $table->string('description', 3000)->nullable();
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
        Schema::dropIfExists('companies');
    }
}
