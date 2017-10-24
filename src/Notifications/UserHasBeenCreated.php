<?php

namespace Antares\Users\Notifications;

use Antares\Notifications\Model\Template;

class UserHasBeenCreated extends AbstractUserNotification {

    /**
     * @return Template
     */
    protected static function notificationMessage() {
        $subject    = 'User has been created';
        $view       = 'antares/users::notifications.system.user_created';

        return new Template(['admin', 'reseller'], $subject, $view);
    }

}
