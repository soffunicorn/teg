<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            //Index
            $table->unsignedBigInteger('id_user')->unsigned()
                ->index()
                ->nullable();
            $table->unsignedBigInteger('id_action')->unsigned()
                ->index()
                ->nullable();

            //Foreign key
            $table->foreign('id_user')
                ->references('id')
                ->on('users');

            $table->foreign('id_action')
                ->references('id')
                ->on('actions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
