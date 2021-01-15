<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "departments";
    use HasFactory;
    protected $fillable = [
        'name',
        'telephone',
        'email',
        'schedule_from',
        'schedule_to',
        'status',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_departments', 'id_departament','id_user');
    }
}
