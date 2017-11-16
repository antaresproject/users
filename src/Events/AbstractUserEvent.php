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

namespace Antares\Users\Events;

use Antares\Model\User;

abstract class AbstractUserEvent {

    /**
     * User instance.
     *
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