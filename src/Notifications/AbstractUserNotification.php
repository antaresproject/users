<?php

/**
 * Part of the Antares package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Antares Core
 * @version    0.9.2
 * @author     Antares Team
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017, Antares
 * @link       http://antaresproject.io
 */

namespace Antares\Users\Notifications;

use Antares\Model\User;
use Antares\Notifications\AbstractNotification;
use Antares\Notifications\Contracts\NotificationEditable;
use Antares\Notifications\Messages\NotificationMessage;
use Antares\Notifications\Model\Template;

abstract class AbstractUserNotification extends AbstractNotification implements NotificationEditable {

    /**
     * User instance.
     *
     * @var User
     */
    protected $user;

    /**
     * AbstractUserNotification constructor.
     * @param User $user
     */
    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Returns template for notification.
     *
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
            ->subjectData(['user' => $this->user])
            ->viewData(['user' => $this->user]);
    }

}