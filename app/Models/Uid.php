<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\Auditable\AuditableTrait;

class Uid extends Model
{
    use HasFactory, AuditableTrait, SoftDeletes;

    protected $fillable = [
        'name', 'phone_number', 'address', 'latitude', 'longitude',
    ];
}
