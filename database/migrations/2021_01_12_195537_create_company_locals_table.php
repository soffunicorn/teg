<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyLocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_locals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //Index
            $table->unsignedBigInteger('id_company')->unsigned()
                ->index()
                ->nullable();
            $table->unsignedBigInteger('id_local')->unsigned()
                ->index()
                ->nullable();

            //Foreign key
            $table->foreign('id_company')
                ->references('id')
                ->on('companies');

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
        Schema::dropIfExists('company_locals');
    }
}
