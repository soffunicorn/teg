<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\companyLocal;

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
        'id_state',
        'schedule_from',
        'schedule_to',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_company', 'id_company', 'id_user');
    }

    public function locals()
    {
        return $this->belongsToMany(local::class, 'company_locals', 'id_local', 'id_company');
    }


}
