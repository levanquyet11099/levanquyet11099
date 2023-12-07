<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductWarehousing extends Model
{
    //
    protected $table = 'product_warehousing';

    protected $fillable = [
        'pw_product_id', 'pw_warehousing_id', 'pw_supplier_id', 'pw_total_number', 'pw_manufacturing_date', 'pw_expiry_date', 'pw_active_price', 'pw_custom_price', 'pw_total_price', 'pw_note', 'created_at', 'updated_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'pw_product_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'pw_supplier_id', 'id');
    }
}
