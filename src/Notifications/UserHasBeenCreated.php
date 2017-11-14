<?php

namespace Antares\Users\Notifications;

use Antares\Notifications\Collections\TemplatesCollection;
use Antares\Notifications\Model\Template;
use Antares\Users\Events\UserCreated;

class UserHasBeenCreated extends AbstractUserNotification {

    /**
     * @return TemplatesCollection
     */
    public static function templates() : TemplatesCollection {
        return TemplatesCollection::make('User Created', UserCreated::class)
            ->define('notification', static::notificationMessage());
    }

    /**
     * @return Template
     */
    protected static function notificationMessage() {
        $subject    = 'User has been created';
        $view       = 'antares/users::notifications.system.user_created';

        return (new Template(['notification'], $subject, $view))->setRecipients(['admin']);
    }

}
