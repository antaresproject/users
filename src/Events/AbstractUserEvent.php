<?php

namespace Antares\Users\Events;

use Antares\Model\User;

abstract class AbstractUserEvent {

    /**
     * @var User
     */
    public $user;

    /**
     * AbstractUserEvent constructor.
     * @param User $user
     */
    public function __construct(User $user) {
        $this->user = $user;
    }

}