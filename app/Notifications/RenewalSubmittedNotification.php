<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class RenewalSubmittedNotification extends Notification
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
            'title' => 'Renewal Application Submitted',
            'message' => 'Your franchise renewal application #'.$this->application->application_no.' has been submitted successfully. Your application is now under review.',
            'application_id' => $this->application->id,
            'application_no' => $this->application->application_no,
            'status' => 'pending_review',
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }
}
