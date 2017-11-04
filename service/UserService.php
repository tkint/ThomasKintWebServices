<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 27/07/2017
 * Time: 04:03
 */

namespace service;

use dao\UserDAO;
use model\User;
use WebServices;

/**
 * Class UserService
 *
 * Web services served with the /user url.
 * Implements methods coming from Service abstract class which define GET, POST, PUT and DELETE http methods
 *
 * @package service
 */
class UserService extends Service
{
    /**
     * Get one specified user or all of them if id not specified in url
     *
     * @return array|User|null
     */
    public static function doGet()
    {
        $data = null;
        $userdao = new UserDAO();
        $param = WebServices::getParam(0);
        if (isset($param) && !is_null($param)) {
            $data = $userdao->getUserByIdUser($param);
        } else {
            $data = $userdao->getUsers();
        }

        return $data;
    }

    /**
     * Create a user from the json object passed in body request
     *
     * @return User|null
     */
    public static function doPost()
    {
        $data = null;
        $userdao = new UserDAO();
        $body = WebServices::getBody();
        if (isset($body) && !is_null($body)) {
            $user = User::fromJSON($body);

            $data = $userdao->createUser($user);
        }

        return $data;
    }

    /**
     * Update a specified user from the json object passed in body request
     *
     * @return User|null
     */
    public static function doPut()
    {
        $data = null;
        $userdao = new UserDAO();
        $body = WebServices::getBody();
        if (isset($body) && !is_null($body)) {
            $user = User::fromJSON($body);

            $data = $userdao->updateUser($user);
        }

        return $data;
    }

    /**
     * Delete a specified user
     *
     * @return bool|null
     */
    public static function doDelete()
    {
        $data = null;
        $userdao = new UserDAO();
        $param = WebServices::getParam(0);
        if (isset($param) && !is_null($param)) {
            $data = $userdao->deleteUser($param);
        }

        return $data;
    }
}