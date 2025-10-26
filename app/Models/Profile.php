<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'contact_number',
        'address',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    /**
     * Get the user that owns this profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the full name of the user.
     */
    public function getFullNameAttribute(): string
    {
        $name = $this->first_name;

        if ($this->middle_name) {
            $name .= ' ' . $this->middle_name;
        }

        $name .= ' ' . $this->last_name;

        return $name;
    }
}
