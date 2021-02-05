<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateIn extends Model
{
    use HasFactory;
    protected $table = "incidents_state";

    protected $fillable = [
        'state',
        'slug',
    ];
}
