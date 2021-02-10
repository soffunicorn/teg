<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->string('title', 250);
            $table->string('slug', 250);
            $table->string('description', 3000)->nullable();
            $table->timestamps();
        });

        //Insertar los datos de actions que habrán originalmente
        DB::table('actions')->insert([
            [
                'title' => 'Log in',
                'slug' => 'log-in',
                'description' => 'Inicio sesión',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Log out',
                'slug' => 'log-out',
                'description' => 'Cerro sesión',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Nuevo departamento',
                'slug' => 'new-department',
                'description' => 'Creado un nuevo departamento',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Editado departamento',
                'slug' => 'edit-department',
                'description' => 'Editado el departamento',
            ],
        ]);
        DB::table('actions')->insert([
            [
                'title' => 'Editado departamento',
                'slug' => 'update-department',
                'description' => 'Editado el departamento',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Borrado el departamento',
                'slug' => 'delete-department',
                'description' => 'Borrado el departamento',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Nueva incidencia',
                'slug' => 'new-incident',
                'description' => 'Creada  nueva incidencia',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Editada  la Incidencia',
                'slug' => 'edit-incident',
                'description' => 'Editada la incidencia',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Actualizada la Incidencia',
                'slug' => 'update-incident',
                'description' => 'Editada la incidencia',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Incidencia Borrada',
                'slug' => 'delete-incident',
                'description' => 'Borrada la incidencia',
            ],
        ]);


        DB::table('actions')->insert([
            [
                'title' => 'Creado un usuario',
                'slug' => 'new-user',
                'description' => 'Creado un nuevo usuario',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Editado un Usuario',
                'slug' => 'edit-user',
                'description' => 'Editado un usuario',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Actualizado el Usuario',
                'slug' => 'update-user',
                'description' => 'El usuario ha sido actualizado',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Usuario Borrada',
                'slug' => 'delete-user',
                'description' => 'El usuario ha sido borrado',
            ],
        ]);

          DB::table('actions')->insert([
            [
                'title' => 'Creado una compañia',
                'slug' => 'new-company',
                'description' => 'Creado una nueva compañia',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Editando una Compañia',
                'slug' => 'edit-company',
                'description' => 'La ha compañia se ha editado',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Compañia Actualizada',
                'slug' => 'update-company',
                'description' => 'La ha compañia se ha actualizado',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Compañia Borrada',
                'slug' => 'delete-company',
                'description' => 'La compañia ha sido borrado',
            ],
        ]);
     DB::table('actions')->insert([
            [
                'title' => 'Creado un Local',
                'slug' => 'new-local',
                'description' => 'Un local ha sido creado',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Editado un Local',
                'slug' => 'edit-local',
                'description' => 'El local se ha editado',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Local Actualizada',
                'slug' => 'update-local',
                'description' => 'El local se ha actualizado',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Local Borrado',
                'slug' => 'delete-local',
                'description' => 'El local ha sido borrado',
            ],
        ]);
        DB::table('actions')->insert([
            [
                'title' => 'Creado un Comentario',
                'slug' => 'new-comment',
                'description' => 'Un comentario ha sido creado',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Editado un Comentario',
                'slug' => 'edit-comment',
                'description' => 'El comentario se ha editado',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Comentario Actualizada',
                'slug' => 'update-comment',
                'description' => 'El comentario se ha actualizado',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Comentario Borrado',
                'slug' => 'delete-comment',
                'description' => 'El Comentario ha sido borrado',
            ],
        ]);

        DB::table('actions')->insert([
            [
                'title' => 'Creado un Reporte',
                'slug' => 'new-report',
                'description' => 'Un Reporte ha sido creado',
            ],
        ]);
        DB::table('actions')->insert([
            [
                'title' => 'Descargado un Reporte',
                'slug' => 'upload-report',
                'description' => 'Un Reporte ha sido Descargado',
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
        Schema::dropIfExists('actions');
    }
}
