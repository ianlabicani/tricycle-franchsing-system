<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'application_no',
        'franchise_type',
        'purpose',
        'status',
        'remarks',
        'date_submitted',
        'date_approved',
    ];

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
}
