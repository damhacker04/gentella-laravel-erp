<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryOrderItem extends Model
{
    protected $fillable = [
        'delivery_order_id', 'product_id', 'qty_ordered', 'qty_delivered',
    ];

    protected $casts = [
        'qty_ordered' => 'integer',
        'qty_delivered' => 'integer',
    ];

    public function deliveryOrder()
    {
        return $this->belongsTo(DeliveryOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
