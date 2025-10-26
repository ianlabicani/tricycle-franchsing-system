<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;

class ApplicationPolicy
{
    /**
     * Determine if the given application can be viewed by the user.
     */
    public function view(User $user, Application $application)
    {
        // Only the owner (driver) can view their own application
        return $user->id === $application->user_id;
    }

    /**
     * Determine if the given application can be updated by the user.
     */
    public function update(User $user, Application $application)
    {
        return $user->id === $application->user_id;
    }

    /**
     * Determine if the given application can be deleted by the user.
     */
    public function delete(User $user, Application $application)
    {
        return $user->id === $application->user_id;
    }
}
