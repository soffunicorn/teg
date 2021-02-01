<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Company extends Model
{
    protected $table = "user_company";
    use HasFactory;

    //Relaciones
    public function Companies()
    {
        return $this->belongsToMany(Companies::class, 'user_company', 'id_user', 'id_company');
    }


}
