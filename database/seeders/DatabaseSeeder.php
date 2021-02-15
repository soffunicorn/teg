<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $password = "1234";
        $type = Type::where('slug', 'boss')->first();
        $rol = Rol::where('slug', 'admin')->first();
        $slug = str_shuffle("user" . 'admin' . date("Ymd") . uniqid());
        $user = new User();
        $user->name = 'Administrador';
        $user->lastname = 'Sambil';
        $user->email = 'admin@sambil.com';
        $user->slug = $slug;
        $user->password = bcrypt($password);
        $user->id_rol = $rol->id;
        $user->id_type = $type->id;
        $user->save();



    }
}
