<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $table = 'supplier';

    const STATUS_LOCKED = 0;
    const STATUS_ACTIVE = 1;

    protected $fillable = [
        's_name', 's_code', 's_email', 's_phone', 's_fax', 's_website', 's_logo', 's_status', 'created_at', 'updated_at',
    ];
}
