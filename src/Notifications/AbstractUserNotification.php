<?php

namespace Antares\Users\Notifications;

use Antares\Model\User;
use Antares\Notifications\AbstractNotification;
use Antares\Notifications\Contracts\NotificationEditable;
use Antares\Notifications\Messages\NotificationMessage;
use Antares\Notifications\Model\Template;

abstract class AbstractUserNotification extends AbstractNotification implements NotificationEditable {

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