<?php

/**
 * Part of the Antares package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Antares Core
 * @version    0.9.2
 * @author     Antares Team
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017, Antares
 * @link       http://antaresproject.io
 */

namespace Antares\Users\Notifications;

use Antares\Notifications\Collections\TemplatesCollection;
use Antares\Notifications\Model\Template;
use Antares\Users\Events\UserCreated;

class UserHasBeenCreated extends AbstractUserNotification {

    /**
     * Returns collection of defined templates.
     *
     * @return TemplatesCollection
     */
    public static function templates() : TemplatesCollection {
        return TemplatesCollection::make('User Created', UserCreated::class)
            ->define(static::notificationMessage());
    }

    /**
     * Returns template for notification.
     *
     * @return Template
     */
    protected static function notificationMessage() {
        $subject    = 'User has been created';
        $view       = 'antares/users::notifications.system.user_created';

        return (new Template(['notification'], $subject, $view))->setRecipients(['admin']);
    }

}
