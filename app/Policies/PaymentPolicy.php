<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;

class PaymentPolicy
{
    /**
     * Determine whether the user can view the payment.
     */
    public function view(User $user, Payment $payment): bool
    {
        // SB staff can view any payment
        if ($user->hasRole('SB_staff')) {
            return true;
        }

        // Driver can only view their own application's payment
        if ($user->hasRole('driver')) {
            return $payment->application->user_id === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can create payments.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('SB_staff');
    }

    /**
     * Determine whether the user can update the payment.
     */
    public function update(User $user, Payment $payment): bool
    {
        return $user->hasRole('SB_staff');
    }

    /**
     * Determine whether the user can delete the payment.
     */
    public function delete(User $user, Payment $payment): bool
    {
        return $user->hasRole('SB_staff') && $payment->status === 'pending';
    }
}
