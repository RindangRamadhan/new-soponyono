<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Up3 extends Model
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        'id', 'uid_id', 'name', 'phone_number', 'address', 'latitude', 'longitude',
    ];
}
