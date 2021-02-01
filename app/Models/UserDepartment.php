<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDepartment extends Model
{
    protected  $table = "user_company";
    use HasFactory;

    //Relaciones
    public function Departments()
    {
        return $this->belongsToMany(Department::class, 'users_departments', 'id_user', 'id_department');
    }
}
