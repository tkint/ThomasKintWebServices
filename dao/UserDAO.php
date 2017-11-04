<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 02/08/2017
 * Time: 22:10
 */

namespace dao;

use PDO;
use model\User;

/**
 * Class UserDAO
 * @package dao
 */
class UserDAO
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * BookDAO constructor.
     */
    public function __construct()
    {
        $this->pdo = Connection::getInstance()->getPdo();
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        $users = array();
        $req = $this->pdo->prepare(
            'SELECT id_user, email, password, pseudo, firstname, lastname, role
                      FROM user'
        );
        $req->execute();

        $o = null;
        while ($o = $req->fetchObject(User::class)) {
            $users[] = $o;
        }

        $req->closeCursor();

        return $users;
    }

    /**
     * @param $id_user
     * @return User
     */
    public function getUserByIdUser($id_user)
    {
        $user = new User();

        $req = $this->pdo->prepare(
            'SELECT id_user, email, password, pseudo, firstname, lastname, role
                      FROM user 
                      WHERE id_user = :id_user'
        );
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $req->execute();

        $o = null;
        if (($o = $req->fetchObject(User::class)) !== false) {
            $user = $o;
        }

        $req->closeCursor();

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function createUser(User $user)
    {
        $req = $this->pdo->prepare(
            'INSERT INTO user (email, password, pseudo, firstname, lastname, role) 
                      VALUES (:email, :password, :pseudo, :firstname, :lastname, :role)'
        );
        $req->bindParam(':email', $user->email, PDO::PARAM_STR);
        $req->bindParam(':password', $user->password, PDO::PARAM_STR);
        $req->bindParam(':pseudo', $user->pseudo, PDO::PARAM_STR);
        $req->bindParam(':firstname', $user->firstname, PDO::PARAM_STR);
        $req->bindParam(':lastname', $user->lastname, PDO::PARAM_STR);
        $req->bindParam(':role', $user->role, PDO::PARAM_STR);
        $req->execute();

        return $user;
    }

    public function updateUser(User $user)
    {
        if ($user->id_user != null) {
            $req = $this->pdo->prepare(
                'UPDATE user SET 
                          email = :email,
						  password = :password,
                          pseudo = :pseudo,
						  firstname = :firstname,
						  lastname = :lastname,
						  role = :role
                          WHERE id_user = :id_user'
            );
            $req->bindParam(':id_user', $user->id_user, PDO::PARAM_INT);
            $req->bindParam(':email', $user->email, PDO::PARAM_STR);
            $req->bindParam(':password', $user->password, PDO::PARAM_STR);
            $req->bindParam(':pseudo', $user->pseudo, PDO::PARAM_STR);
            $req->bindParam(':firstname', $user->firstname, PDO::PARAM_STR);
            $req->bindParam(':lastname', $user->lastname, PDO::PARAM_STR);
            $req->bindParam(':role', $user->role, PDO::PARAM_STR);
            $req->execute();
        }
        return $user;
    }

    public function deleteUser($id_user)
    {
        $req = $this->pdo->prepare(
            'DELETE FROM user 
                      WHERE id_user = :id_user'
        );
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        return $req->execute();
    }
}