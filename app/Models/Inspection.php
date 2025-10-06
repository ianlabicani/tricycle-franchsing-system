<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inspection extends Model
{
    protected $fillable = [
        'application_id',
        'scheduled_date',
        'scheduled_time',
        'inspector_name',
        'location',
        'status',
        'result',
        'notes',
        'remarks',
        'cancellation_reason',
        'completed_at',
        'cancelled_at',
        'scheduled_by',
        'completed_by',
        'cancelled_by',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'scheduled_time' => 'datetime:H:i',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    /**
     * Get the application that owns the inspection.
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    /**
     * Get the user who scheduled the inspection.
     */
    public function scheduledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'scheduled_by');
    }

    /**
     * Get the user who completed the inspection.
     */
    public function completedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'completed_by');
    }

    /**
     * Get the user who cancelled the inspection.
     */
    public function cancelledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }
}
