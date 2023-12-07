<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';

    const STATUS_LOCKED = 0;
    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'p_category_id', 'p_unit_id', 'p_user_id', 'p_code', 'p_name', 'p_images', 'p_entry_price', 'p_retail_price', 'p_cost_price', 'p_total_number', 'p_description', 'p_content', 'p_status', 'created_at', 'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'p_category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'p_user_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'p_unit_id', 'id');
    }
}
