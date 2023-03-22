<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class ManagerUlp extends Model
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        'id', 'ulp_id', 'user_id', 'location',
    ];
    
    public function Ulp()
    {
        return $this->hasOne('App\Models\Ulp', 'id', 'ulp_id');
    }

    public function User()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
