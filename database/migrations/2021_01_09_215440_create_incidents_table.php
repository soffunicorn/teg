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
        Schema::create('incidents_state', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('descripcion');
            $table->string('slug');
            $table->timestamps();
        });



        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description', 3000);
            $table->string('slug');
            $table->string('priority');
            $table->dateTime('deathline')->nullable();
            $table->timestamps();

            //Index
            $table->unsignedBigInteger('id_departament')->unsigned()
                ->index()
                ->nullable();
            $table->unsignedBigInteger('id_local')->unsigned()
                ->index()
                ->nullable();
            $table->unsignedBigInteger('id_responsable')->unsigned()
                ->index()
                ->nullable();
            $table->unsignedBigInteger('id_state')->unsigned()
                ->index()
                ->nullable();
            //Foreign key
        $table->foreign('id_departament')
                ->references('id')
                ->on('departments');

        $table->foreign('id_local')
                ->references('id')
                ->on('locals');

        $table->foreign('id_responsable')
                ->references('id')
                ->on('users');

        $table->foreign('id_state')
                ->references('id')
                ->on('incidents_state');
        });



        DB::table('incidents_state')->insert([
            [
                'name'        => 'Por hacer',
                'slug'        => 'porhacer',
                'descripcion' => 'Actividad enviada en proceso de espera',
                'created_at'  =>  new DateTime,
                'updated_at'  =>  new DateTime
            ],
            [
                'name'        => 'En proceso',
                'slug'        => 'enproceso',
                'descripcion' => 'Actividad en proceso',
                'descripcion' => 'Consumidor',
                'created_at'  =>  new DateTime,
                'updated_at'  =>  new DateTime
            ],
            [
                'name'        => 'Finalizada',
                'slug'        => 'finalizada',
                'descripcion' => 'Actividad Finalizada',
                'created_at'  =>  new DateTime,
                'updated_at'  =>  new DateTime
            ],
            [
                'name'        => 'Borrada',
                'slug'        => 'delete',
                'descripcion' => 'Incidente Borrado',
                'created_at'  =>  new DateTime,
                'updated_at'  =>  new DateTime
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
        Schema::dropIfExists('incidents');
    }
}
