<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTables extends Migration
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
            $table->string('slug');
            $table->timestamps();
        });

        DB::table('states')->insert([
            [
                'state' => 'Por hacer',
                'slug' => 'todo',
            ],
        ]);
        DB::table('states')->insert([
            [
                'state' => 'En proceso',
                'slug' => 'process',
            ],
        ]);

        DB::table('states')->insert([
            [
                'state' => 'Hecho',
                'slug' => 'done',
            ],
        ]);
        DB::table('states')->insert([
            [
                'state' => 'Disponible',
                'slug' => 'available',
            ],
        ]);
        DB::table('states')->insert([
            [
                'state' => 'No disponible',
                'slug' => 'unavailable',
            ],
        ]);
        DB::table('states')->insert([
            [
                'state' => 'Ocupado',
                'slug' => 'busy',
            ],
        ]);
        DB::table('states')->insert([
            [
                'state' => 'Deshabilitado',
                'slug' => 'disabled',
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
