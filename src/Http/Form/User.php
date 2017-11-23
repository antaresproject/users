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

namespace Antares\Users\Http\Form;

use Antares\Events\Form\Form;
use Illuminate\Contracts\Container\Container;
use Antares\Contracts\Html\Form\Presenter;
use Antares\Contracts\Html\Form\Fieldset;
use Antares\Html\Form\Grid as HtmlGrid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Antares\Html\Form\ClientScript;
use Antares\Html\Form\FormBuilder;

class User extends FormBuilder implements Presenter
{

    /**
     * form validation rules
     *
     * @var array
     */
    protected $rules = [
        'email'     => ['required', 'email'],
        'firstname' => ['required'],
        'lastname'  => ['required'],
    ];

    /**
     * Construct
     * 
     * @param Model $model
     */
    public function __construct(Model $model)
    {

        parent::__construct(app(HtmlGrid::class), app(ClientScript::class), app(Container::class));
        Event::fire('antares.forms', 'users.register');
        Event::fire(new Form('users.register'));

        $this->grid->name('User form');
        $this->grid->resource($this, 'antares/foundation::users', $model);
        $this->grid->hidden('id');
        $this->fieldset();
        $rules          = $this->rules;
        $rules['email'] = array_merge($rules['email'], ['unique:tbl_users' . (($model->exists) ? ',id,' . $model->id : '' )]);
        $this->grid->rules($rules);
    }

    /**
     * Form fieldset
     * 
     * @return Fieldset
     */
    protected function fieldset()
    {
        return $this->grid->fieldset('user-fieldset', function (Fieldset $fieldset) {
                    $fieldset->legend(trans('antares/users::messages.fieldsets.user_details'));

                    $this->controls($fieldset);

                    $this->buttons($fieldset);
                });
    }

    /**
     * Attaches controls to fieldset
     * 
     * @param Fieldset $fieldset
     */
    protected function controls($fieldset)
    {
        $fieldset->control('input:text', 'email')
                ->label(trans('antares/foundation::label.users.email'))
                ->help('E-mail address which will be used to login.');

        $fieldset->control('input:text', 'firstname')
                ->label(trans('antares/foundation::label.users.firstname'))
                ->help('Firstname field is required.');

        $fieldset->control('input:text', 'lastname')
                ->label(trans('antares/foundation::label.users.lastname'))
                ->help('Lastname field is required.');


        $fieldset->control('input:password', 'password')
                ->label(trans('antares/foundation::label.users.password'))
                ->help('Password should contain min. 5 characters.');

        $fieldset->control('input:password', 'confirm_password')
                ->label(trans('antares/users::messages.confirm_password'))
                ->help('Password should same as value in password field.');
    }

    /**
     * Assignes buttons to fieldsets
     * 
     * @param Fieldset $fieldset
     */
    protected function buttons($fieldset)
    {
        $fieldset->control('button', 'cancel')
                ->field(function() {
                    $previous = url()->previous();
                    $url      = $previous == url()->current() ? handles('antares/foundation::/') : $previous;
                    return app('html')->link($url, trans('antares/foundation::label.cancel'), ['class' => 'btn btn--md btn--default mdl-button mdl-js-button']);
                });

        $fieldset->control('button', 'button')
                ->attributes(['type' => 'submit', 'class' => 'btn btn--md btn--primary mdl-button mdl-js-button mdl-js-ripple-effect'])
                ->value(trans('antares/foundation::label.save_changes'));
    }

}
