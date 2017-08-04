<?php

namespace Antares\Users\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Bus\Queueable;

class InvoicePaid extends Notification
{

    use Queueable;

    /**
     * Notification severity
     *
     * @var String
     */
    public $severity = 'high';

    /**
     * Notification category
     *
     * @var String
     */
    public $category = 'default';

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                        ->subject('Notification Subject')
                        ->view('antares/foundation::users.notification.test_message', ['application_name' => 'Antares']);
    }

}
