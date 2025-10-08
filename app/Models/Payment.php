<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'application_id',
        'payment_no',
        'payment_items',
        'total_amount',
        'status',
        'notes',
        'paid_at',
        'verified_at',
        'cancelled_at',
        'created_by',
        'verified_by',
        'cancelled_by',
    ];

    protected $casts = [
        'payment_items' => 'array',
        'total_amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'verified_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($payment) {
            $latest = self::max('id') + 1;
            $payment->payment_no = 'PAY-'.now()->year.'-'.str_pad($latest, 4, '0', STR_PAD_LEFT);
        });
    }

    /**
     * Get the application that owns the payment.
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    /**
     * Get the user who created the payment record.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who verified the payment.
     */
    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Get the user who cancelled the payment.
     */
    public function cancelledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }
}
