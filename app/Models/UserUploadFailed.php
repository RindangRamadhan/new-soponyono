<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserUploadFailed extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid_id', 'up3_id', 'ulp_id', 'user_name', 'rbm_code', 'name', 'phone', 'type', 'photo', 'position', 'role', 'reason',
    ];
}
