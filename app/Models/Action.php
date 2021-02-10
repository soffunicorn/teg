<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Log;


class Action extends Model
{
    use HasFactory;
    protected $table = "actions";

    public function logs()
    {
        return $this->hasMany(Log::class);
    }



}
