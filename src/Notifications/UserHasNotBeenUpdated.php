<?php

namespace Antares\Users\Notifications;

use Antares\Notifications\Collections\TemplatesCollection;
use Antares\Notifications\Model\Template;
use Antares\Users\Events\UserNotUpdated;

class UserHasNotBeenUpdated extends AbstractUserNotification {

    /**
     * @return TemplatesCollection
     */
    public static function templates() : TemplatesCollection {
        return TemplatesCollection::make('User Not Updated', UserNotUpdated::class)
            ->define('notification', static::notificationMessage());
    }

    /**
     * @return Template
     */
    protected static function notificationMessage() {
        $subject    = 'User has not been updated';
        $view       = 'antares/users::notifications.system.user_not_updated';

        return (new Template(['notification'], $subject, $view))->setSeverity('high')->setRecipients(['admin']);
    }

}
