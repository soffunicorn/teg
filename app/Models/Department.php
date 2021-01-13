<?php

namespace App\Models;

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
        'schedule_to',
        'schedule_from',
        'status',
        'description',
    ];
}
