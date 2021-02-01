<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class companyLocal extends Model
{
    use HasFactory;
    protected $table = "company_locals";

    public function locals()
    {
        return $this->belongsToMany(local::class, 'company_locals', 'id_local', 'id_company');
    }


}
