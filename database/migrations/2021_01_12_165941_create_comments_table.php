<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('content', 3000);
            $table->timestamps();
           //Indexes
            $table->unsignedBigInteger('id_user')->unsigned()
                ->index()
                ->nullable();

            $table->unsignedBigInteger('id_incident')->unsigned()
                ->index()
                ->nullable();

            //Foreign key

            $table->foreign('id_user')
                ->references('id')
                ->on('users');

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
        Schema::dropIfExists('comments');
    }
}
