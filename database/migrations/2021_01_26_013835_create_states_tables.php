<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->string('string');
            $table->timestamps();
        });

        DB::table('roles')->insert([
            [
                'state' => 'Por hacer',
                'slug' => 'todo',
            ],
        ]);
        DB::table('roles')->insert([
            [
                'state' => 'En proceso',
                'slug' => 'process',
            ],
        ]);
        DB::table('roles')->insert([
            [
                'state' => 'Hecho',
                'slug' => 'done',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states_tables');
    }
}
