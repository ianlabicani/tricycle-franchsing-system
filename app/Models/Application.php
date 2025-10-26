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
        // Personal Information
        'first_name',
        'middle_name',
        'last_name',
        'full_name',
        'date_of_birth',
        'contact_number',
        'email',
        'address',
        // Vehicle Information
        'plate_number',
        'engine_number',
        'chassis_number',
        'year_model',
        'make',
        // Route Information
        'route',
        'operating_hours',
        // Application Details
        'purpose',
        'status',
        'remarks',
        'date_submitted',
        'date_approved',
        'date_completed',
        // Lifecycle Tracking
        'reviewed_at',
        'scheduled_at',
        'inspected_at',
        'payment_verified_at',
        'rejected_at',
        'released_at',
        'completed_at',
        'expiration_date',
        'renewal_reminder_sent_at',
        'archived_at',
        'reviewed_by',
        'approved_by',
        'rejected_by',
        'released_by',
    ];



    public function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'date_submitted' => 'datetime',
            'date_approved' => 'datetime',
            'date_completed' => 'datetime',
            'reviewed_at' => 'datetime',
            'scheduled_at' => 'datetime',
            'inspected_at' => 'datetime',
            'payment_verified_at' => 'datetime',
            'rejected_at' => 'datetime',
            'released_at' => 'datetime',
            'completed_at' => 'datetime',
            'expiration_date' => 'datetime',
            'renewal_reminder_sent_at' => 'datetime',
            'archived_at' => 'datetime',
        ];
    }

    /**
     * Check if a user has an active application.
     * "Active" means not completed, released, rejected, or archived.
     */
    public static function userHasActive($userId): bool
    {
        return self::where('user_id', $userId)
            ->whereNotIn('status', ['completed', 'released', 'rejected', 'archived'])
            ->exists();
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
     * Get the payments for the application.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the latest payment for the application.
     */
    public function latestPayment()
    {
        return $this->hasOne(Payment::class)->latestOfMany();
    }

    /**
     * Get the documents for the application.
     */
    public function documents()
    {
        return $this->hasMany(ApplicationDocument::class);
    }

    /**
     * Get pending documents for the application.
     */
    public function pendingDocuments()
    {
        return $this->documents()->where('status', 'pending');
    }

    /**
     * Get approved documents for the application.
     */
    public function approvedDocuments()
    {
        return $this->documents()->where('status', 'approved');
    }

    /**
     * Get rejected documents for the application.
     */
    public function rejectedDocuments()
    {
        return $this->documents()->where('status', 'rejected');
    }

    /**
     * Check if all documents have been approved.
     */
    public function allDocumentsApproved(): bool
    {
        // If no documents, return false
        if ($this->documents()->count() === 0) {
            return false;
        }

        // Check if all documents are approved (no pending or rejected documents)
        return $this->documents()
            ->whereIn('status', ['pending', 'rejected'])
            ->doesntExist();
    }

    /**
     * Check if application has any rejected documents.
     */
    public function hasRejectedDocuments(): bool
    {
        return $this->rejectedDocuments()->exists();
    }

    /**
     * Check if application is renewable (expiring soon or expired).
     */
    public function isRenewable(): bool
    {
        if (! $this->expiration_date) {
            return false;
        }

        return $this->expiration_date->isPast() ||
               $this->expiration_date->diffInDays(now()) <= 30;
    }

    /**
     * Get status label for display.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
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
        return match ($this->status) {
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
