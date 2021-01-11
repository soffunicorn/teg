<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_departments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //Index
            $table->unsignedBigInteger('id_departament')->unsigned()
                ->index()
                ->nullable();
            $table->unsignedBigInteger('id_user')->unsigned()
                ->index()
                ->nullable();

            //Foreign key
            $table->foreign('id_departament')
                ->references('id')
                ->on('departments');

            $table->foreign('id_user')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users__departments');
    }
}
