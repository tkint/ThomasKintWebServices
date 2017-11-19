<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 27/07/2017
 * Time: 04:03
 */

namespace service;

use dao\UserDAO;
use error\Error;
use error\UserErrors;
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
        $param = WebServices::getParam(0);
        if (isset($body) && !is_null($body)) {
            $user = User::fromJSON($body);
            if ($param == 'signin') {
                if (self::isValidSignin($user)) {
                    $data = $userdao->getUserByEmailPassword($user->email, $user->password);
                    if ($data->id_user == null) {
                        $data = new Error(UserErrors::class, UserErrors::DOES_NOT_EXIST);
                    }
                } else {
                    $data = new Error(UserErrors::class, UserErrors::NOT_VALID);
                }
            } else if ($param == 'signup') {
                if (self::isValidSignup($user)) {
                    $u = $userdao->getUserByEmailPassword($user->email, $user->password);
                    if (isset($u->id_user) && !is_null($u->id_user)) {
                        $data = new Error(UserErrors::class, UserErrors::ALREADY_EXISTS);
                    } else {
                        $user->setRole('User');
                        $data = $userdao->createUser($user);
                    }
                } else {
                    $data = new Error(UserErrors::class, UserErrors::NOT_VALID);
                }
            }
        }

        return $data;
    }

    /**
     * Update a specified user from the json object passed in body request
     *
     * @return User|null
     */
    public
    static function doPut()
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

    private static function isValidSignin($user)
    {
        return !is_null($user)
            && isset($user->email) && !is_null($user->email)
            && isset($user->password) && !is_null($user->password);
    }

    private static function isValidSignup($user)
    {
        return self::isValidSignin($user)
            && isset($user->pseudo) && !is_null($user->pseudo)
            && isset($user->firstname) && !is_null($user->firstname)
            && isset($user->lastname) && !is_null($user->lastname);
    }
}