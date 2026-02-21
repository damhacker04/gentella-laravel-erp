<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class XenditPayment extends Model
{
    protected $fillable = [
        'sales_invoice_id',
        'xendit_invoice_id',
        'external_id',
        'amount',
        'status',
        'payment_method',
        'payment_channel',
        'invoice_url',
        'paid_at',
        'xendit_response',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'paid_at' => 'datetime',
            'xendit_response' => 'array',
        ];
    }

    public function salesInvoice(): BelongsTo
    {
        return $this->belongsTo(SalesInvoice::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class , 'created_by');
    }
}
