<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('rol');
            $table->string('slug');
            $table->timestamps();
        });

        DB::table('roles')->insert([
            [
                'rol' => 'Super Administrador',
                'slug' => 'super_admin',
            ],
        ]);
        DB::table('roles')->insert([
            [
                'rol' => 'Administrador',
                'slug' => 'admin',
            ],
        ]);
        DB::table('roles')->insert([
            [
                'rol' => 'Locatario',

                'slug' => 'local',
            ],
        ]);
        DB::table('roles')->insert([
            [
                'rol' => 'Resposable',
                'slug' => 'responsable',
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
        Schema::dropIfExists('rol');
    }
}
