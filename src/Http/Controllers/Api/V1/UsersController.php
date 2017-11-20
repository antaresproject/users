<?php

namespace Antares\Users\Http\Controllers\Api\V1;

use Antares\Users\Http\Controllers\UsersController as BaseController;

class UsersController extends BaseController
{

    /**
     * @api {get} /api/v1/users/index List of users
     * @apiName Index
     * @apiGroup Users
     * @apiVersion 0.1.0
     * @apiHeader {String} Authorization Authorization type.
     * @apiHeader {String} Content-Type Request content type
     * @apiHeader {String} Accept Accepted content type.
     * @apiHeaderExample {json} Header-Example:
     *     {
     *       "Authorization": "Basic bHVrYXN6LmNpcnV0QGdtYWlsLmNvbTpteXN6a2E="
     *       "Content-Type": "application/json",
     *       "Accept": "application/vnd.antares.v1+json"
     *     }
     *
     *
     * @apiSuccessExample {json} Success-Response:
     * {"current_page":1,"data":[{"id":2,"firstname":"Corrine","lastname":"Ernser","email":"0chaim.konopelski@gmail.com","created_at":"2017-11-16 11:57:02","status":1,"fullname":"Corrine Ernser","roles":[{"id":3,"parent_id":2,"area":"users","name":"member","full_name":"Member","description":"","created_at":"2017-11-16 11:56:31","updated_at":"2017-11-16 11:56:31","deleted_at":null,"pivot":{"user_id":2,"role_id":3,"created_at":"2017-11-16 11:57:02","updated_at":"2017-11-16 11:57:02"}}]},{"id":3,"firstname":"Etha","lastname":"Stoltenberg","email":"1chester84@hotmail.com","created_at":"2017-11-16 11:57:02","status":1,"fullname":"Etha Stoltenberg","roles":[{"id":3,"parent_id":2,"area":"users","name":"member","full_name":"Member","description":"","created_at":"2017-11-16 11:56:31","updated_at":"2017-11-16 11:56:31","deleted_at":null,"pivot":{"user_id":3,"role_id":3,"created_at":"2017-11-16 11:57:02","updated_at":"2017-11-16 11:57:02"}}]},{"id":4,"firstname":"Kayla","lastname":"Harris","email":"2alphonso93@yahoo.com","created_at":"2017-11-16 11:57:02","status":1,"fullname":"Kayla Harris","roles":[{"id":3,"parent_id":2,"area":"users","name":"member","full_name":"Member","description":"","created_at":"2017-11-16 11:56:31","updated_at":"2017-11-16 11:56:31","deleted_at":null,"pivot":{"user_id":4,"role_id":3,"created_at":"2017-11-16 11:57:02","updated_at":"2017-11-16 11:57:02"}}]},{"id":5,"firstname":"Nicola","lastname":"Hintz","email":"3cale30@bosco.com","created_at":"2017-11-16 11:57:03","status":1,"fullname":"Nicola Hintz","roles":[{"id":3,"parent_id":2,"area":"users","name":"member","full_name":"Member","description":"","created_at":"2017-11-16 11:56:31","updated_at":"2017-11-16 11:56:31","deleted_at":null,"pivot":{"user_id":5,"role_id":3,"created_at":"2017-11-16 11:57:03","updated_at":"2017-11-16 11:57:03"}}]},{"id":6,"firstname":"Annie","lastname":"Bayer","email":"4hartmann.geo@yahoo.com","created_at":"2017-11-16 11:57:03","status":1,"fullname":"Annie Bayer","roles":[{"id":3,"parent_id":2,"area":"users","name":"member","full_name":"Member","description":"","created_at":"2017-11-16 11:56:31","updated_at":"2017-11-16 11:56:31","deleted_at":null,"pivot":{"user_id":6,"role_id":3,"created_at":"2017-11-16 11:57:03","updated_at":"2017-11-16 11:57:03"}}]},{"id":7,"firstname":"Genevieve","lastname":"Dietrich","email":"5alf97@kohler.biz","created_at":"2017-11-16 11:57:03","status":1,"fullname":"Genevieve Dietrich","roles":[{"id":3,"parent_id":2,"area":"users","name":"member","full_name":"Member","description":"","created_at":"2017-11-16 11:56:31","updated_at":"2017-11-16 11:56:31","deleted_at":null,"pivot":{"user_id":7,"role_id":3,"created_at":"2017-11-16 11:57:03","updated_at":"2017-11-16 11:57:03"}}]},{"id":8,"firstname":"Jefferey","lastname":"Blanda","email":"6jany22@heidenreich.com","created_at":"2017-11-16 11:57:03","status":1,"fullname":"Jefferey Blanda","roles":[{"id":3,"parent_id":2,"area":"users","name":"member","full_name":"Member","description":"","created_at":"2017-11-16 11:56:31","updated_at":"2017-11-16 11:56:31","deleted_at":null,"pivot":{"user_id":8,"role_id":3,"created_at":"2017-11-16 11:57:03","updated_at":"2017-11-16 11:57:03"}}]},{"id":9,"firstname":"Helen","lastname":"Dare","email":"7hayden.cronin@hotmail.com","created_at":"2017-11-16 11:57:03","status":1,"fullname":"Helen Dare","roles":[{"id":3,"parent_id":2,"area":"users","name":"member","full_name":"Member","description":"","created_at":"2017-11-16 11:56:31","updated_at":"2017-11-16 11:56:31","deleted_at":null,"pivot":{"user_id":9,"role_id":3,"created_at":"2017-11-16 11:57:03","updated_at":"2017-11-16 11:57:03"}}]},{"id":10,"firstname":"Maybelle","lastname":"Kutch","email":"8conroy.bennie@yahoo.com","created_at":"2017-11-16 11:57:03","status":1,"fullname":"Maybelle Kutch","roles":[{"id":3,"parent_id":2,"area":"users","name":"member","full_name":"Member","description":"","created_at":"2017-11-16 11:56:31","updated_at":"2017-11-16 11:56:31","deleted_at":null,"pivot":{"user_id":10,"role_id":3,"created_at":"2017-11-16 11:57:03","updated_at":"2017-11-16 11:57:03"}}]},{"id":11,"firstname":"Alphonso","lastname":"Conroy","email":"9darwin84@stark.com","created_at":"2017-11-16 11:57:03","status":1,"fullname":"Alphonso Conroy","roles":[{"id":3,"parent_id":2,"area":"users","name":"member","full_name":"Member","description":"","created_at":"2017-11-16 11:56:31","updated_at":"2017-11-16 11:56:31","deleted_at":null,"pivot":{"user_id":11,"role_id":3,"created_at":"2017-11-16 11:57:03","updated_at":"2017-11-16 11:57:03"}}]}],"first_page_url":"http:\/\/51.254.36.218\/api\/v1\/users\/index?page=1","from":1,"last_page":2,"last_page_url":"http:\/\/51.254.36.218\/api\/v1\/users\/index?page=2","next_page_url":"http:\/\/51.254.36.218\/api\/v1\/users\/index?page=2","path":"http:\/\/51.254.36.218\/api\/v1\/users\/index","per_page":10,"prev_page_url":null,"to":10,"total":20}
     * @apiSuccess {String} result List brands
     * @return array
     */
    public function index()
    {
        return parent::index();
    }

}
