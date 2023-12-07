<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Permission extends Model
{
    //
    protected $table = 'permissions';
    protected $fillable = ['name', 'display_name', 'description', 'group_permission_id', 'created_at', 'updated_at'];

    public function groups()
    {
        return $this->belongsTo(GroupPermission::class,'group_permission_id','id');
    }
}
