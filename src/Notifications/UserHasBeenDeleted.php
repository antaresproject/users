<?php

namespace Antares\Users\Notifications;

use Antares\Notifications\Model\Template;

class UserHasBeenDeleted extends AbstractUserNotification {

    /**
     * @return Template
     */
    protected static function notificationMessage() {
        $subject    = 'User has been deleted';
        $view       = 'antares/users::notifications.system.user_deleted';

        return new Template(['admin', 'reseller'], $subject, $view);
    }

}
