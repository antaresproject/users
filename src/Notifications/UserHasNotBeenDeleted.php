<?php

namespace Antares\Users\Notifications;

use Antares\Notifications\Model\Template;

class UserHasNotBeenDeleted extends AbstractUserNotification {

    /**
     * @return Template
     */
    protected static function notificationMessage() {
        $subject    = 'User has not been deleted';
        $view       = 'antares/users::notifications.system.user_not_deleted';

        return (new Template(['admin', 'reseller'], $subject, $view))->setSeverity('high');
    }

}
