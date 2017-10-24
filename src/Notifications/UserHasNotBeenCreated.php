<?php

namespace Antares\Users\Notifications;

use Antares\Notifications\Model\Template;

class UserHasNotBeenCreated extends AbstractUserNotification {

    /**
     * @return Template
     */
    protected static function notificationMessage() {
        $subject    = 'User has not been created';
        $view       = 'antares/users::notifications.system.user_not_created';

        return (new Template(['admin', 'reseller'], $subject, $view))->setSeverity('high');
    }

}
