<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_locals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //Index
            $table->unsignedBigInteger('id_local')->unsigned()
                ->index()
                ->nullable();
            $table->unsignedBigInteger('id_user')->unsigned()
                ->index()
                ->nullable();

            //Foreign key
            $table->foreign('id_local')
                ->references('id')
                ->on('locals');

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
        Schema::dropIfExists('user__locals');
    }
}
