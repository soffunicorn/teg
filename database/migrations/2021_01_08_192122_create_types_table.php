<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('slug');
            $table->timestamps();
        });

        DB::table('types')->insert([
            [
                'tipo' => 'Supervisor',
                'slug' => 'boss',
            ],
        ]);
        DB::table('types')->insert([
            [
                'tipo' => 'Trabajador',
                'slug' => 'worker',
            ],
        ]);

        /********************************/
         /*   Para user rol locales                 */

        DB::table('types')->insert([
            [
                'tipo' => 'Dueño',
                'slug' => 'owner',

            ],
        ]);
        DB::table('types')->insert([
            [
                'tipo' => 'Supervisor Local',
                'slug' => 'boss_local',

            ],
        ]);
        DB::table('types')->insert([
            [
                'tipo' => 'Trabajador Local',
                'slug' => 'worker_local',

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
        Schema::dropIfExists('types');
    }
}
