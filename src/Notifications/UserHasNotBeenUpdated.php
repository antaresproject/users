<?php

namespace Antares\Users\Notifications;

use Antares\Notifications\Model\Template;

class UserHasNotBeenUpdated extends AbstractUserNotification {

    /**
     * @return Template
     */
    protected static function notificationMessage() {
        $subject    = 'User has not been updated';
        $view       = 'antares/users::notifications.system.user_not_updated';

        return (new Template(['admin', 'reseller'], $subject, $view))->setSeverity('high');
    }

}
