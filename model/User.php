<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 02/08/2017
 * Time: 22:10
 */

namespace model;


/**
 * Class User
 * @package model
 */
class User
{
    /**
     * @var
     */
    public $id_user;

    /**
     * @var
     */
    public $email;

    /**
     * @var
     */
    public $password;

    /**
     * @var
     */
    public $pseudo;

    /**
     * @var
     */
    public $firstname;

    /**
     * @var
     */
    public $lastname;

    /**
     * @var
     */
    public $role;

    /**
     * @return mixed
     */
    public function getIduser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIduser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function toJSON()
    {
        return json_encode($this);
    }

    /**
     * @param $json
     * @return array|User
     */
    public static function fromJSON($json)
    {
        $object = json_decode($json, true);
        if (sizeof($object) > 1 && !(isset($object['id_user']) && !is_null($object['id_user']))) {
            $users = array();
            foreach ($object as $o) {
                $users[] = self::fromArray($o);
            }
            return $users;
        }
        return self::fromArray($object);
    }

    /**
     * @param $array
     * @return User
     */
    public static function fromArray($array)
    {
        $user = new User();
        foreach ($array as $key => $value) {
            if (property_exists(get_class($user), $key) && !is_null($value)) {
                $user->$key = $value;
            }
        }
        return $user;
    }
}