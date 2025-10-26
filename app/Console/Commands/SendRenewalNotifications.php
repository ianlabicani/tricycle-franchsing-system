<?php

namespace App\Console\Commands;

use App\Models\Application;
use App\Notifications\RenewalReminderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendRenewalNotifications extends Command
{
    protected $signature = 'applications:send-renewal-notifications';

    protected $description = 'Send in-app renewal notifications and update status for expiring applications';

    public function handle()
    {
        $now = now();
        $oneMonthFromNow = $now->copy()->addMonth()->startOfDay();

        $this->info("Current time: {$now}");
        $this->info("One month from now: {$oneMonthFromNow}");

        // 1. Send in-app notification 1 month before expiration (or within renewal window)
        // Only send to those who haven't been notified yet
        $appsForReminder = Application::whereNotNull('expiration_date')
            ->whereNull('renewal_reminder_sent_at')
            ->where('status', '!=', 'archived')
            ->where('status', '!=', 'for_renewal')
            ->whereDate('expiration_date', '<=', $oneMonthFromNow)
            ->whereDate('expiration_date', '>', $now)
            ->get();

        $this->info('Found '.$appsForReminder->count().' apps for reminder notification');

        foreach ($appsForReminder as $app) {
            $user = $app->user;
            if ($user) {
                $user->notify(new RenewalReminderNotification($app));
                $app->renewal_reminder_sent_at = $now;
                $app->save();
                $this->info("Sent renewal reminder to user #{$user->id} for application #{$app->id}");
            }
        }

        // 2. Set status to 'for_renewal' for ALL applications within renewal window (regardless of reminder status)
        $renewalApps = Application::whereNotNull('expiration_date')
            ->where('status', '!=', 'for_renewal')
            ->where('status', '!=', 'archived')
            ->where('status', '!=', 'rejected')
            ->where(function ($query) use ($now, $oneMonthFromNow) {
                $query->whereDate('expiration_date', '<=', $oneMonthFromNow)
                    ->whereDate('expiration_date', '>=', $now);
            })
            ->get();

        $this->info('Found '.$renewalApps->count().' apps for renewal status update');

        foreach ($renewalApps as $app) {
            $oldStatus = $app->status;
            $app->status = 'for_renewal';
            $app->save();
            $this->info("Set application #{$app->id} status from '{$oldStatus}' to 'for_renewal' (expiry: {$app->expiration_date})");
        }

        $this->info('Renewal notification and status update process complete.');
    }
}
