<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Action;
use App\Models\Record;

class Log extends Model
{
    use HasFactory;
    protected $table = "logs";


    public function actions()
    {
        return $this->belongsTo(Action::class);
    }

    public function  records(){
        return $this->hasMany(Record::class);
    }


}
