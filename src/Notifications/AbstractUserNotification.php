<?php

namespace Antares\Users\Notifications;

use Antares\Model\User;
use Antares\Notifications\Collections\TemplatesCollection;
use Antares\Notifications\Contracts\NotificationEditable;
use Antares\Notifications\Messages\NotificationMessage;
use Antares\Notifications\Model\Template;
use Illuminate\Notifications\Notification;

abstract class AbstractUserNotification extends Notification implements NotificationEditable {

    /**
     * @var User
     */
    protected $user;

    /**
     * @var string
     */
    protected static $templateName = 'notification';

    /**
     * AbstractUserNotification constructor.
     * @param User $user
     */
    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $notifiable->isAny(['reseller', 'admin', 'super-administrator']) ? ['notification'] : [];
    }

    /**
     * @return TemplatesCollection
     */
    public static function templates() : TemplatesCollection {
        return TemplatesCollection::make()
            ->define('notification', static::notificationMessage());
    }

    /**
     * @return Template
     */
    abstract protected static function notificationMessage();

    /**
     * Get the alert representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NotificationMessage
     */
    public function toNotification($notifiable)
    {
        return (new NotificationMessage())
            ->template('notification')
            ->subjectData(['user' => $this->user])
            ->viewData(['user' => $this->user]);
    }

}