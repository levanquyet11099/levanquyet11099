<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Warehousing extends Model
{
    protected $table = 'warehousing';
    //
    protected $fillable = [
        'pw_user_id', 'w_code', 'w_name', 'w_note', 'w_type', 'created_at', 'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'pw_user_id', 'id');
    }

    public function warehousingProduct() {
        return $this->hasMany(ProductWarehousing::class, 'pw_warehousing_id', 'id');
    }
}
