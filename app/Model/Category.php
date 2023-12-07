<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'category';

    const STATUS_LOCKED = 0;
    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'c_parent_id', 'c_supplier_id', 'c_name', 'c_code', 'c_active', 'created_at', 'updated_at',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'c_supplier_id', 'id');
    }
}
