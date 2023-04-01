<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Yajra\Auditable\AuditableTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, AuditableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uid_id', 'up3_id', 'ulp_id', 'user_name', 'rbm_code', 'name', 'phone', 'type', 'photo', 'position', 'password','status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
