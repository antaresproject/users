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

namespace Antares\Users;

use Antares\Foundation\Support\Providers\ModuleServiceProvider;
use Antares\Model\User;
use Antares\Notifications\Helpers\NotificationsEventHelper;
use Antares\Users\Events\AbstractUserEvent;
use Antares\Users\Events\UserCreated;
use Antares\Users\Events\UserDeleted;
use Antares\Users\Events\UserNotCreated;
use Antares\Users\Events\UserNotDeleted;
use Antares\Users\Events\UserNotUpdated;
use Antares\Users\Events\UserUpdated;
use Antares\Users\Http\Handlers\UsersActivityPlaceholder;
use Antares\Users\Http\Handlers\UserViewBreadcrumbMenu;
use Antares\Users\Http\Handlers\UsersBreadcrumbMenu;
use Antares\Contracts\Auth\Command\ThrottlesLogins;
use Antares\Users\Auth\BasicThrottle;
use Antares\Foundation\MenuComposer;
use Antares\Users\Http\Middleware\CaptureUserActivityMiddleware;
use Antares\Users\Listeners\NotificationsSubscriber;
use Antares\Users\Memory\Avatar;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;

class UsersServiceProvider extends ModuleServiceProvider
{

    /**
     * The application or extension namespace.
     *
     * @var string|null
     */
    protected $namespace = 'Antares\Users\Http\Controllers';

    /**
     * The application or extension group namespace.
     *
     * @var string|null
     */
    protected $routeGroup = 'antares/users';

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->registerThrottlesLogins();
        $this->app->singleton(Avatar::class, function () {
            return new Avatar();
        });


    }

    /**
     * Register the service provider for foundation.
     *
     * @return void
     */
    protected function registerThrottlesLogins()
    {
        $config    = $this->app->make('config')->get('antares/foundation::throttle', []);
        $throttles = isset($config['resolver']) ? $config['resolver'] : BasicThrottle::class;
        $this->app->bind(ThrottlesLogins::class, $throttles);
        BasicThrottle::setConfig($config);
    }

    /**
     * @param Router $router
     * @return void
     */
    protected function registerUsersActivity(Router $router)
    {
        Event::listen('antares.ready: admin', UsersActivityPlaceholder::class);
        $router->pushMiddlewareToGroup('web', CaptureUserActivityMiddleware::class);
    }

    /**
     * Users service boot
     */
    public function boot()
    {
        parent::boot();

        $router = $this->app->make(Router::class);

        if (!$this->app->routesAreCached()) {
            require __DIR__ . "/frontend.php";
        }

        MenuComposer::getInstance()->compose(UsersBreadcrumbMenu::class);
        $this->attachMenu([UserViewBreadcrumbMenu::class]);
        $this->registerUsersActivity($router);
    }

    /**
     * Boot after all extensions booted.
     */
    public function booted() {
        $this->setupNotifications();
    }

    /**
     * Setup notification for module.
     */
    protected function setupNotifications() {
        $adminRecipient = function() {
            return User::administrators()->get();
        };

        $clientRecipient = function(AbstractUserEvent $event) {
            return $event->user;
        };

        NotificationsEventHelper::make()
            ->event(UserCreated::class, 'Users', 'When user is created')
                ->addAdminRecipient($adminRecipient)
                ->addClientRecipient($clientRecipient)
                ->register()
            ->event(UserUpdated::class, 'Users', 'When user is updated')
                ->addAdminRecipient($adminRecipient)
                ->addClientRecipient($clientRecipient)
                ->register()
            ->event(UserDeleted::class, 'Users', 'When user is deleted')
                ->addAdminRecipient($adminRecipient)
                ->addClientRecipient($clientRecipient)
                ->register()
            ->event(UserNotCreated::class, 'Users', 'When user not created')
                ->addAdminRecipient($adminRecipient)
                ->register()
            ->event(UserNotUpdated::class, 'Users', 'When user not updated')
                ->addAdminRecipient($adminRecipient)
                ->register()
            ->event(UserNotDeleted::class, 'Users', 'When user not deleted')
                ->addAdminRecipient($adminRecipient)
                ->register();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Avatar::class, NotificationsSubscriber::class];
    }

}
