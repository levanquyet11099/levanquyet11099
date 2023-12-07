<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Model\Role;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // trạng thái tài khoản bị khóa
    const STATUS_LOCKED = 0;
    // trạng thái tài khoản hoạt động
    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'account', 'password', 'full_name', 'email', 'phone', 'avatar', 'status', 'remember_token', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userRole()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

}
