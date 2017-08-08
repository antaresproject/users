<?php

namespace Antares\Users\Notifications;

use Antares\Notifications\Messages\NotificationMessage;
use Antares\Notifications\Messages\MailMessage;
use Antares\Notifications\Messages\SmsMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Bus\Queueable;

class InvoicePaid extends Notification implements ShouldQueue
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
        return [\Antares\Notifications\Channels\MailChannel::class];
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
     * Get the sms representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SmsMessage
     */
    public function toSms($notifiable)
    {
        return (new SmsMessage)
                        ->severity('high')
                        ->category('default')
                        ->subject('This is a sample sms message')
                        ->content('Your SMS message content')
                        ->from('15554443333');
    }

    /**
     * Get the alert representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\AlertMessage
     */
    public function toAlert($notifiable)
    {
        return (new NotificationMessage)
                        ->severity('high')
                        ->category('default')
                        ->type(['admin', 'reseller'])
                        ->subject('antares/users::notifications.invoice_paid_subject', ['username' => $notifiable->fullname])
                        ->view('antares/foundation::users.notification.test_alert_message');
    }

    /**
     * Get the alert representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\AlertMessage
     */
    public function toNotification($notifiable)
    {
        return (new NotificationMessage)
                        ->severity('medium')
                        ->category('default')
                        ->type(['admin', 'reseller'])
                        ->subject('antares/users::notifications.invoice_paid_subject', ['username' => $notifiable->fullname])
                        ->view('antares/foundation::users.notification.test_alert_message');
    }

}
