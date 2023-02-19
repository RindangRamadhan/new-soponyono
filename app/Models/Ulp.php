<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Ulp extends Model
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        'id', 'up3_id', 'name', 'phone_number', 'address', 'latitude', 'longitude',
    ];
}
