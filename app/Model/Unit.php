<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $table = 'units';

    protected $fillable = [
        'u_code', 'u_name', 'created_at', 'updated_at',
    ];
}
