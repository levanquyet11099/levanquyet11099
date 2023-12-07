<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    //
    protected $table = 'password_resets';

    protected $fillable = [
        'email', 'token', 'time_reset', 'created_at'
    ];
}
