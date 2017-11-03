<?php

namespace Antares\Users\Notifications;

use Antares\Notifications\Collections\TemplatesCollection;
use Antares\Notifications\Model\Template;
use Antares\Users\Events\UserUpdated;

class UserHasBeenUpdated extends AbstractUserNotification {

    /**
     * @return TemplatesCollection
     */
    public static function templates() : TemplatesCollection {
        return TemplatesCollection::make('User Updated', UserUpdated::class)
            ->define('notification', static::notificationMessage());
    }

    /**
     * @return Template
     */
    protected static function notificationMessage() {
        $subject    = 'User has been updated';
        $view       = 'antares/users::notifications.system.user_updated';

        return (new Template(['notification'], $subject, $view))->setRecipients(['admins']);
    }

}
