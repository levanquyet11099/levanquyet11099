<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class Role extends EntrustRole
{
    //
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'display_name', 'description','created_at','updated_at'
    ];
    /*
     * The roles that belong to the roles.
     */
    public function permissionRole()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }

    public function users()
    {
        return $this->belongsToMany(Config::get('auth.providers.users.model'),Config::get('entrust.role_user_table'),Config::get('entrust.role_foreign_key'),Config::get('entrust.user_foreign_key'));

    }

}
