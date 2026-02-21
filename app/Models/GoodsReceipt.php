<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'purchase_order_id', 'warehouse_id', 'received_at', 'notes', 'status', 'created_by',
    ];

    protected $casts = [
        'received_at' => 'date',
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function items()
    {
        return $this->hasMany(GoodsReceiptItem::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class , 'created_by');
    }
}
