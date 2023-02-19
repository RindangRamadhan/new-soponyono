<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Customer extends Model
{
    use HasFactory, AuditableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'up3_id', 'ulp_id', 'id_pel', 'name', 'gardu',
    ];


    public function Uid()
    {
        return $this->hasOne('App\Models\Uid', 'id', 'uid_id');
    }

    public function Ulp()
    {
        return $this->hasOne('App\Models\Ulp', 'id', 'ulp_id');
    }

    public function Up3()
    {
        return $this->hasOne('App\Models\Up3', 'id', 'up3_id');
    }
}
