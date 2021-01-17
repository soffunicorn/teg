<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected  $table = 'companies';
    use HasFactory;

    protected $fillable = [
        'name',
        'business_reason',
        'telephone',
        'slug',
        'email',
        'status',
        'schedule_from',
        'schedule_to',
        'description',
    ];

}
