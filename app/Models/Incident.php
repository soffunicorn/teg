<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $table = 'incidents';

    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'slug',
        'priority',
    ];
}
