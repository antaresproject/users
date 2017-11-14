<?php

namespace Antares\Users\Notifications;

use Antares\Notifications\Collections\TemplatesCollection;
use Antares\Notifications\Model\Template;
use Antares\Users\Events\UserDeleted;

class UserHasBeenDeleted extends AbstractUserNotification {

    /**
     * @return TemplatesCollection
     */
    public static function templates() : TemplatesCollection {
        return TemplatesCollection::make('User Deleted', UserDeleted::class)
            ->define('notification', static::notificationMessage());
    }

    /**
     * @return Template
     */
    protected static function notificationMessage() {
        $subject    = 'User has been deleted';
        $view       = 'antares/users::notifications.system.user_deleted';

        return (new Template(['notification'], $subject, $view))->setRecipients(['admin']);
    }

}
