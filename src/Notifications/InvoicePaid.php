<?php

namespace Antares\Users\Notifications;

use Antares\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Bus\Queueable;

class InvoicePaid extends Notification
{

    use Queueable;

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
                        ->severity('high')
                        ->category('default')
                        ->subject('antares/users::notifications.invoice_paid_subject', ['username' => $notifiable->fullname])
                        ->view('antares/foundation::users.notification.test_message');
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
                        ->severity('high')
                        ->category('default')
                        ->subject('antares/users::notifications.invoice_paid_subject', ['username' => $notifiable->fullname])
                        ->view('antares/foundation::users.notification.test_message');
    }

}
