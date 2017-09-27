<?php

namespace Antares\Users\Listeners;

use Antares\Model\User;
use Antares\Users\Notifications\UserHasBeenCreated;
use Antares\Users\Notifications\UserHasBeenDeleted;
use Antares\Users\Notifications\UserHasBeenUpdated;
use Antares\Users\Notifications\UserHasNotBeenCreated;
use Antares\Users\Notifications\UserHasNotBeenDeleted;
use Antares\Users\Notifications\UserHasNotBeenUpdated;
use Illuminate\Events\Dispatcher;
use Antares\Notifications\Facade\Notification;

class NotificationsSubscriber
{

    /**
     * @var User[]
     */
    protected $admins;

    /**
     * NotificationsSubscriber constructor.
     */
    public function __construct() {
        $this->admins = User::administrators()->get();
    }

    public function hasBeenCreated(array $data) {
        Notification::send($this->admins, new UserHasBeenCreated($data['user']));
    }

    public function hasNotBeenCreated(array $data) {
        Notification::send($this->admins, new UserHasNotBeenCreated($data['user']));
    }

    public function hasBeenUpdated(array $data) {
        Notification::send($this->admins, new UserHasBeenUpdated($data['user']));
    }

    public function hasNotBeenUpdated(array $data) {
        Notification::send($this->admins, new UserHasNotBeenUpdated($data['user']));
    }

    public function hasBeenDeleted(array $data) {
        Notification::send($this->admins, new UserHasBeenDeleted($data['user']));
    }

    public function hasNotBeenDeleted(array $data) {
        Notification::send($this->admins, new UserHasNotBeenDeleted($data['user']));
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param  Dispatcher  $events
     */
    public function subscribe(Dispatcher $events) {
        $events->listen('notification.user_has_been_created', self::class . '@hasBeenCreated');
        $events->listen('notification.user_has_not_been_created', self::class . '@hasNotBeenCreated');

        $events->listen('notification.user_has_been_updated', self::class . '@hasBeenUpdated');
        $events->listen('notification.user_has_not_been_updated', self::class . '@hasNotBeenUpdated');

        $events->listen('notification.user_has_been_deleted', self::class . '@hasBeenDeleted');
        $events->listen('notification.user_has_not_been_deleted', self::class . '@hasNotBeenDeleted');
    }

}