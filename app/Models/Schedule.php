<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    protected $fillable = [
        'application_id',
        'scheduled_by',
        'schedule_date',
        'queue_number',
        'status',
        'remarks',
    ];

    protected $casts = [
        'schedule_date' => 'datetime',
    ];

    /**
     * Get the application that owns the schedule.
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    /**
     * Get the user who scheduled this.
     */
    public function scheduledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'scheduled_by');
    }

    /**
     * Generate next queue number for a given date.
     */
    public static function generateQueueNumber($date): string
    {
        $dateStr = \Carbon\Carbon::parse($date)->format('Ymd');
        $count = self::whereDate('schedule_date', $date)->count() + 1;
        return $dateStr . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
    }
}
