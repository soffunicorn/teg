<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Log;
class Record extends Model
{
    use HasFactory;
    protected $table = "records";

    public function actions()
    {
        return $this->belongsTo(Log::class);
    }

}
