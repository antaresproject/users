<?php

namespace Antares\Users\Notifications;

use Antares\Notifications\Model\Template;

class UserHasBeenUpdated extends AbstractUserNotification {

    /**
     * @return Template
     */
    protected static function notificationMessage() {
        $subject    = 'User has been updated';
        $view       = 'antares/users::notifications.system.user_updated';

        return new Template(['admin', 'reseller'], $subject, $view);
    }

}
