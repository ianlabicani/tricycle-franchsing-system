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

        // 1. Send in-app notification 1 month before expiration
        $appsForReminder = Application::whereNotNull('expiration_date')
            ->whereNull('renewal_reminder_sent_at')
            ->whereDate('expiration_date', $oneMonthFromNow)
            ->get();

        foreach ($appsForReminder as $app) {
            $user = $app->user;
            if ($user) {
                $user->notify(new RenewalReminderNotification($app));
                $app->renewal_reminder_sent_at = $now;
                $app->save();
                $this->info("Sent renewal reminder to user #{$user->id} for application #{$app->id}");
            }
        }

        // 2. Set status to 'for_renewal' if expired
        $expiredApps = Application::whereNotNull('expiration_date')
            ->where('status', '!=', 'for_renewal')
            ->whereDate('expiration_date', '<=', $now)
            ->get();

        foreach ($expiredApps as $app) {
            $app->status = 'for_renewal';
            $app->save();
            $this->info("Set application #{$app->id} status to for_renewal");
        }

        $this->info('Renewal notification and status update process complete.');
    }
}
