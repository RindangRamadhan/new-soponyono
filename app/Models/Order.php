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
        'customer_id', 'user_id', 'uid_id', 'up3_id', 'ulp_id', 'phone_number', 'tarif', 'power', 'class', 'substation', 'bill', 'address', 'photos', 'status', 'billing_status', 'created_by', 'uuid', 'latitude', 'longitude',
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
