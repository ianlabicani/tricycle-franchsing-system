<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'application_no',
        'queue_number',
        'franchise_type',
        'purpose',
        'status',
        'remarks',
        'date_submitted',
        'date_approved',
        'reviewed_at',
        'scheduled_at',
        'inspected_at',
        'payment_verified_at',
        'rejected_at',
        'released_at',
        'completed_at',
        'expiration_date',
        'renewal_reminder_sent_at',
        'reviewed_by',
        'approved_by',
        'rejected_by',
        'released_by',
    ];

    public function casts(): array
    {
        return [
            'date_submitted' => 'datetime',
            'date_approved' => 'datetime',
            'reviewed_at' => 'datetime',
            'scheduled_at' => 'datetime',
            'inspected_at' => 'datetime',
            'payment_verified_at' => 'datetime',
            'rejected_at' => 'datetime',
            'released_at' => 'datetime',
            'completed_at' => 'datetime',
            'expiration_date' => 'date',
            'renewal_reminder_sent_at' => 'date',
        ];
    }

    protected static function booted()
    {
        static::creating(function ($application) {
            $latest = self::max('id') + 1;
            $application->application_no = 'APP-'.now()->year.'-'.str_pad($latest, 4, '0', STR_PAD_LEFT);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user who reviewed the application.
     */
    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Get the user who approved the application.
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the user who rejected the application.
     */
    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    /**
     * Get the user who released the documents.
     */
    public function releasedBy()
    {
        return $this->belongsTo(User::class, 'released_by');
    }

    /**
     * Get the inspections for the application.
     */
    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    /**
     * Get the latest inspection for the application.
     */
    public function latestInspection()
    {
        return $this->hasOne(Inspection::class)->latestOfMany();
    }

    /**
     * Get the schedules for the application.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get the latest schedule for the application.
     */
    public function latestSchedule()
    {
        return $this->hasOne(Schedule::class)->latestOfMany();
    }

    /**
     * Check if application is renewable (expiring soon or expired).
     */
    public function isRenewable(): bool
    {
        return $this->expiration_date &&
               $this->expiration_date->isPast() ||
               $this->expiration_date->diffInDays(now()) <= 30;
    }

    /**
     * Get status label for display.
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'draft' => 'Draft',
            'pending_review' => 'Pending Review',
            'incomplete' => 'Incomplete',
            'for_scheduling' => 'For Scheduling',
            'inspection_scheduled' => 'Inspection Scheduled',
            'inspection_pending' => 'Inspection Pending',
            'inspection_failed' => 'Inspection Failed',
            'for_treasury' => 'For Treasury',
            'for_approval' => 'For Approval',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'released' => 'Released',
            'completed' => 'Completed',
            'for_renewal' => 'For Renewal',
            default => ucfirst($this->status),
        };
    }

    /**
     * Get status color for UI.
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'draft' => 'gray',
            'pending_review' => 'yellow',
            'incomplete' => 'orange',
            'for_scheduling', 'inspection_scheduled', 'inspection_pending' => 'blue',
            'inspection_failed', 'rejected' => 'red',
            'for_treasury', 'for_approval' => 'indigo',
            'approved', 'released', 'completed' => 'green',
            'for_renewal' => 'purple',
            default => 'gray',
        };
    }
}
