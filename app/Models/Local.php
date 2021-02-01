<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\companyLocal;
use App\Models\Company;

class Local extends Model
{
    use HasFactory;
    protected $table = "locals";

    protected $fillable = [
        'n_local',
        'id_state',
    ];
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_locals', 'id_local', 'id_company');
    }


}
