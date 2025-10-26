<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class RenewalReminderNotification extends Notification
{

    public $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Franchise Renewal Reminder',
            'message' => 'Your franchise for application #' . $this->application->application_no . ' will expire on ' . $this->application->expiration_date->format('F d, Y') . '. Please renew to avoid interruption.',
            'application_id' => $this->application->id,
            'expiration_date' => $this->application->expiration_date,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }
}
