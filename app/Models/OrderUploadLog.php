<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Order extends Model
{
    use HasFactory, AuditableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid','created_by','created_at','updated_by','updated_at','log',
    ];


    public function UserCreate()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function UserUpdate()
    {
        return $this->hasOne('App\Models\User', 'id', 'updated_by');
    }

}
