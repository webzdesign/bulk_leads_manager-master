<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UploadLead extends Notification
{
    use Queueable;
    private $notifyData;

    /**
     * Create a new notification instance.
     */
    public function __construct($notifyData)
    {
        $this->notifyData = $notifyData;
    }
    
    

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
   public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'thread' => $this->notifyData['data'],
            'user' => $notifiable,
            'type' => $this->notifyData['type']
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
